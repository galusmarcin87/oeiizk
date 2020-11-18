<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\ChangePasswordForm;
use app\models\ForgotPasswordForm;
use app\models\ResetPasswordForm;
use app\models\RegisterForm;
use app\models\mgcms\db\User;
use app\components\mgcms\MgHelpers;
use app\components\mgcms\OeiizkHelpers;
use \app\models\db\NewsletterEmail;
use app\models\db\Training;
use app\models\db\TrainingSearch;
use yii\helpers\Html;
use app\models\db\TrainingTemplate;

class SiteController extends \app\components\mgcms\MgCmsController
{

  /**
   * @inheritdoc
   */
  public function behaviors()
  {
    return [
        'access' => [
            'class' => AccessControl::className(),
            'only' => ['logout'],
            'rules' => [
                [
                    'actions' => ['logout'],
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ],
        ],
        'verbs' => [
            'class' => VerbFilter::className(),
            'actions' => [
            ],
        ],
    ];
  }

  /**
   * @inheritdoc
   */
  public function actions()
  {
    return [
        'error' => [
            'class' => 'yii\web\ErrorAction',
        ],
        'captcha' => [
            'class' => 'yii\captcha\CaptchaAction',
            'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
        ],
    ];
  }

  /**
   * Displays homepage.
   *
   * @return string
   */
  public function actionIndex($orderName = false)
  {

    $modelLogin = new LoginForm();
    if ($modelLogin->load(Yii::$app->request->post()) && $modelLogin->login()) {
      $this->afterLogin();
    }

    $queryParams = Yii::$app->request->queryParams;
    if (!isset($queryParams['TrainingSearch']['orderName'])) {
      $queryParams['TrainingSearch']['orderName'] = $orderName;
      Yii::$app->request->setQueryParams($queryParams);
    }
    $searchModel = new TrainingSearch();

    $searchModel->notTypes = [TrainingTemplate::TYPE_KONFERENCJA, TrainingTemplate::TYPE_SIECI_WSPOLPRACY];

    if (isset(Yii::$app->session['profiledIds'])) {
      $searchModel->notIdsIn = Yii::$app->session['profiledIds'];
    }

    $dataProvider = $searchModel->searchFront(Yii::$app->request->queryParams);


    return $this->render('index',
            [
                'modelLogin' => $modelLogin,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider
    ]);
  }

  private function afterLogin()
  {
    $user = $this->getUserModel();

    if (sizeof($user->roles) > 0) {
      return $this->redirect(['logout']);
    }
    if ($user->created_by && sizeof($user->userPasswords) <= 1) {
      \app\components\mgcms\MgHelpers::setFlashSuccess('Musisz zmienić hasło.');
      Yii::$app->session['changePasswordUser'] = $user;
      OeiizkHelpers::sendReactivationMail();
      return $this->redirect(['/site/change-password', 'firstLogin' => true]);
    }

    if (isset(Yii::$app->session['trainingToRegister'])) {
      $hash = MgHelpers::encrypt(Yii::$app->session['trainingToRegister']);
      unset(Yii::$app->session['trainingToRegister']);
      return $this->redirect(['/training/sign-in', 'hash' => $hash]);
    }
//    return $this->goBack();
  }

  private function newsletterSave($post)
  {
    if (!empty($post['newsletter-email'])) {
      $email = $post['newsletter-email'];
      $emailValidator = new \yii\validators\EmailValidator();
      if (!$emailValidator->validate($email)) {
        MgHelpers::setFlashError('Nieprawidłowy email');
      } else {
        $user = User::find()->andWhere(['or', ['username' => $email], ['email' => $email]])->one();
        if ($user) {
          MgHelpers::setFlashInfo('Możliwe jest zapisanie do newslettera tylko po zalogowaniu na to konto.');
        } else {
          $newsletterEmail = new NewsletterEmail;
          $newsletterEmail->email = $email;
          $newsletterEmail->save();
          Yii::$app->mailer->compose('newsletterAdd', ['email' => $email])
              ->setTo($email)
              ->setFrom([MgHelpers::getSetting('email') => MgHelpers::getSetting('email newsletter nazwa')])
              ->setSubject('POS OEIiZK - Dodanie do newslettera')
              ->send();
          MgHelpers::setFlashSuccess('Mail z linkiem aktywacyjnym został wysłany.');
        }
      }
    }
  }

  public function actionSaveToNewsletter()
  {
    $user = MgHelpers::getUserModel();
    if (!$user) {
      $this->throw404();
    }
    $user->is_newsletter = 1;
    $user->save();
    $newsletterAgreement = \app\models\db\Agreement::getNewsletterAgreement();
    if ($newsletterAgreement) {
      try {
        $agreementUserModel = new \app\models\db\UserAgreement;
        $agreementUserModel->user_id = $user->id;
        $agreementUserModel->agreement_id = $newsletterAgreement->id;
        $agreementUserModel->save();
      } catch (Exception $e) {
        
      }
    }

    MgHelpers::setFlashSuccess('Pomyślnie subskrybowano newsletter.');
    return $this->back();
  }

  public function actionUnsaveFromNewsletter()
  {
    $user = MgHelpers::getUserModel();
    if (!$user) {
      $this->throw404();
    }
    $user->is_newsletter = 0;
    $user->save();
    foreach ($user->userAgreements as $uAgreement) {
      if (strtolower($uAgreement->agreement->name) == 'newsletter') {
        $uAgreement->delete();
      }
    }
    MgHelpers::setFlashSuccess('Pomyślnie wypisano z newslettera.');
    return $this->back();
  }

  public function actionSubscribeNewsletter($hash)
  {
    $email = MgHelpers::decrypt($hash);
    if (!$email) {
      $this->throw404();
    }

    if (!NewsletterEmail::findOne(['email' => $email])) {
      $newsletterEmail = new NewsletterEmail;
      $newsletterEmail->email = $email;
      $newsletterEmail->save();
    }

    MgHelpers::setFlashSuccess('Pomyślnie subskrybowano newsletter.');
    return $this->redirect('/');
  }

  public function actionUnsubscribeNewsletter($hash)
  {
    $email = MgHelpers::decrypt($hash);
    if (!$email) {
      $this->throw404();
    }
    NewsletterEmail::deleteAll(['email' => $email]);


    MgHelpers::setFlashSuccess('Pomyślnie wyłączono subskrypcję newslettera.');
    return $this->redirect('/');
  }

  /**
   * Login action.
   *
   * @return Response|string
   */
  public function actionLogin()
  {
    if (!Yii::$app->user->isGuest) {
      return $this->goHome();
    }
    $model = new LoginForm();
    if ($model->load(Yii::$app->request->post()) && $model->login()) {
      $this->afterLogin();
    }
    $modelRegister = new RegisterForm();
    if ($modelRegister->load(Yii::$app->request->post()) && $modelRegister->register()) {
      return $this->refresh();
    }
    return $this->render('login', [
            'model' => $model,
            'modelRegister' => $modelRegister
    ]);
  }

  /**
   * Logout action.
   *
   * @return Response
   */
  public function actionLogout()
  {
    Yii::$app->user->logout();

    return $this->goHome();
  }

  /**
   * Displays contact page.
   *
   * @return Response|string
   */
  public function actionContact()
  {
    $model = new ContactForm();
    if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
      MgHelpers::setFlashSuccess('Mail został wysłany.');

      return $this->refresh();
    }
    return $this->render('contact', [
            'model' => $model,
    ]);
  }

  /**
   * Displays about page.
   *
   * @return string
   */
  public function actionAbout()
  {
    return $this->render('about');
  }

  public function actionChangePassword($firstLogin = false)
  {
    if (isset(Yii::$app->session['changePasswordUser'])) {
      $user = Yii::$app->session['changePasswordUser'];
    } elseif ($this->getUserModel()) {
      $user = $this->getUserModel();
    }
    $model = new ChangePasswordForm($user);
    if ($firstLogin) {
      $model->scenario = 'firstLogin';
    }

    if ($model->load(Yii::$app->request->post()) && $model->changePassword()) {
      if (isset(Yii::$app->session['changePasswordUser'])) {
        unset(Yii::$app->session['changePasswordUser']);
      }
      MgHelpers::setFlashSuccess('Hasło zostało zmienione.');
      return $this->goBack();
    }
    return $this->render('changePassword', [
            'model' => $model
    ]);
  }

  public function actionForgotPassword()
  {
    $model = new ForgotPasswordForm();
    if ($model->load(Yii::$app->request->post()) && $model->sendMail()) {
      \app\components\mgcms\MgHelpers::setFlashSuccess('Mail został wysłany.');
      return $this->goBack();
    }
    return $this->render('forgotPassword', [
            'model' => $model
    ]);
  }

  public function actionForgotPasswordChange($hash)
  {
    $email = \app\components\mgcms\MgHelpers::decrypt($hash);
    if (!$email) {
      $this->throw404();
    }
    $user = User::find()->where(['or', ['username' => $email], ['email' => $email]])->one();
    if (!$user) {
      $this->throw404();
    }
    
    if(in_array($user->status, [User::STATUS_TEMPORARY_USER,User::STATUS_INACTIVE])){
      $this->throw404();
    }

    $model = new ResetPasswordForm($user);
    if ($model->load(Yii::$app->request->post()) && $model->changePassword()) {
      return $this->goBack();
    }
    return $this->render('resetPassword', [
            'model' => $model
    ]);
  }

  public function actionActivate($hash)
  {

    $id = MgHelpers::decrypt($hash);
    if (!$id) {
      $this->throw404();
    }

    $user = User::findOne($id);
    if (!$user) {
      $this->throw404();
    }

    $user->status = User::STATUS_ACTIVE;
    $user->date_email_confirmation = date('Y-m-d H:i:s');
    $saved = $user->save();
    if ($saved) {
      MgHelpers::setFlashSuccess('Aktywacja przebiegła pomyślnie.');
      return $this->redirect('/');
    }
  }

  public function actionNewsletter()
  {
    $post = Yii::$app->request->post();
    $searchModels = false;
    if ($post) {
      $this->newsletterSave($post);
      if (!empty($post['newsletter-search'])) {
        $searchModels = \app\models\db\Newsletter::find()->andWhere(['not', ['date_sent' => null]])->andWhere(['or', ['like', 'name', $post['newsletter-search']], ['like', 'text', $post['newsletter-search']], ['like', 'keywords', $post['newsletter-search']]])->all();
      }
    }

    return $this->render('newsletter', ['searchModels' => $searchModels]);
  }

  public function actionScreenDisplay($institutionId)
  {
    $institution = \app\models\db\Institution::findOne($institutionId);
    if (!$institution) {
      $this->throw404();
    }
    $lessonQuery = \app\models\db\Lesson::find();
    $lessonQuery->andWhere(['or', ['DATE(lesson.date_start)' => new \yii\db\Expression('CURDATE()')], ['DATE(lesson.date_end)' => new \yii\db\Expression('CURDATE()')]]);
    $lessonQuery->orderBy(['lesson.date_start' => SORT_ASC]);
    $lessonQuery->joinWith(['lab', 'training']);
    $lessonQuery->andWhere(['training.is_display_on_screen' => 1]);
    $lessonQuery->andWhere(['lab.institution_id' => $institutionId]);

    $lessons = $lessonQuery->all();

    $eventQuery = \app\models\db\Event::find();
    $eventQuery->andWhere(['or', ['DATE(date_from)' => new \yii\db\Expression('CURDATE()')], ['DATE(date_to)' => new \yii\db\Expression('CURDATE()')]]);
    $eventQuery->orderBy(['date_from' => SORT_ASC]);
    $eventQuery->andWhere(['is_display_on_screen' => 1]);
    $eventQuery->joinWith('lab');
    $eventQuery->andWhere(['lab.institution_id' => $institutionId]);

    $events = $eventQuery->all();

    return $this->renderPartial('screenDisplay',
            [
                'institution' => $institution,
                'lessons' => $lessons,
                'events' => $events,
    ]);
  }

  public function actionFileRelatedFakeDelete()
  {
    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    return [];
  }

  public function actionTestSms()
  {
    $login = 'oeiizk';
    $pass = 'Kgf5#azbN';

    $client = new \SoapClient("https://redlink.pl/ws/v1/Soap/SmsCampaigns/SmsCampaigns.asmx?WSDL");

    $data = array();
    $data['CampaignId'] = 'szkStacjonarne';
    $data['Name'] = 'Name';
    $data['Message'] = 'Message';
    $data['Numbers'] = array('0048663326517');
    $data['SenderId'] = 'OEIiZK';
    $data['Priority'] = true;

    $param = new \stdClass();
    $param->strUserName = $login;
    $param->strPassword = $pass;
    $param->data = $data;
    $res = $client->CreateSmsCampaign2_0($param);
    print_r($res);
  }
}
