<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\mgcms\db\User;
use app\components\mgcms\MgHelpers;
use app\components\mgcms\OeiizkHelpers;
use \app\models\mgcms\db\Message;
use yii\data\ActiveDataProvider;
use app\models\db\TrainingSearch;

class MyAccountController extends \app\components\mgcms\MgCmsController
{

  public function actionIndex()
  {
    $model = $this->getUserModel();
    $model->scenario = 'myAccount';
    $oldEmail = $model->email;
    if ($model->load(Yii::$app->request->post()) && $model->save()) {

      if (is_array($model->acceptTerms)) {
        foreach ($model->acceptTerms as $id => $checked) {
          $agreement = \app\models\db\Agreement::findOne($id);
          if ($agreement) {
            if ($checked && !$model->hasAgreementAccepted($id)) {
              $agreementUserModel = new \app\models\db\UserAgreement;
              $agreementUserModel->user_id = $model->id;
              $agreementUserModel->agreement_id = $id;
              $agreementUserModel->save();
            }
            if (!$checked && $model->hasAgreementAccepted($id)) {
              \app\models\db\UserAgreement::deleteAll(['user_id' => $model->id, 'agreement_id' => $id]);
            }
            if (strtolower($agreement->name) == 'newsletter') {
              $model->is_newsletter = (int) $checked;
              $model->save();
            }
          }
        }
      }

      if ($oldEmail != $model->email) {
        $model->date_email_confirmation = '0000-00-00 00:00:00';
        $model->save();
        $mailer = Yii::$app->mailer->compose('activation', [
                'model' => $model
            ])
            ->setTo($model->email)
            ->setFrom([MgHelpers::getSetting('register_email') => MgHelpers::getSetting('register_email_name')])
            ->setSubject(MgHelpers::getSetting('register_activation_email_subject', false, 'OEIiZK - aktywacja'));
        $sent = $mailer->send();
      }
      MgHelpers::setFlashSuccess('Zapisano zmiany.');
      return $this->refresh();
    }

    return $this->render('index', ['model' => $model]);
  }

  public function actionChangePassword()
  {
    $model = new \app\models\ChangePasswordForm($this->getUserModel());
    if ($model->load(Yii::$app->request->post()) && $model->changePassword(false)) {
      MgHelpers::setFlashSuccess('Zapisano zmiany.');
      return $this->refresh();
    }

    return $this->render('changePassword', ['model' => $model]);
  }

  public function actionWorkplace()
  {

    $model = $this->getUserModel();
    $model->scenario = 'myAccount';

    $searchModel = new \app\models\db\InstitutionSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


    try {
      if ($model->loadAll(Yii::$app->request->post(), ['subjects', 'institutions']) && $model->saveAll(['subjects', 'institutions'])) {
        MgHelpers::setFlashSuccess('Zapisano zmiany.');
        return $this->refresh();
      }
    } catch (yii\db\IntegrityException $e) {
      MgHelpers::setFlashError('Problem z zapisem danych.');
      return $this->refresh();
    }

    return $this->render('workplace', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
    ]);
  }

  public function actionAdditionalData()
  {
    $model = $this->getUserModel();
    $model->scenario = 'myAccount';
    if ($model->load(Yii::$app->request->post()) && $model->save()) {

      MgHelpers::setFlashSuccess('Zapisano zmiany.');
      return $this->refresh();
    }

    return $this->render('additionalData', ['model' => $model]);
  }

  public function actionPreferences()
  {
    $model = $this->getUserModel();
    $model->scenario = 'myAccount';
    if ($model->load(Yii::$app->request->post()) && $model->save()) {
      MgHelpers::setFlashSuccess('Zapisano zmiany.');
      return $this->refresh();
    }

    $searchModel = new TrainingSearch();
    $dataProvider = $searchModel->searchWaitingRoom(Yii::$app->request->queryParams);
    
    $dataProviderMy = $searchModel->searchWaitingRoom(Yii::$app->request->queryParams, true);

    return $this->render('preferences', [
            'model' => $model,
            'dataProvider' => $dataProvider,
            'dataProviderMy' => $dataProviderMy
    ]);
  }

  public function actionMessage()
  {
    $model = new Message();
    $model->sender_id = $this->getUserModel()->id;

    if (Yii::$app->request->post()) {
      $post = Yii::$app->request->post();
      if (!$post['rodo']) {
        $model->load(Yii::$app->request->post());
        MgHelpers::setFlashError('Musisz zaakceptować zgodę na przetwarzanie danych osobowych.');
      } else {
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
          if ($model->sendEmail()) {
            MgHelpers::setFlashSuccess('Wiadomość została wysłana.');
            return $this->refresh();
          }
        }
      }
    }


    return $this->render('message', [
            'model' => $model,
    ]);
  }

  public function actionAddUserEducationalLevel()
  {

    if (Yii::$app->request->isAjax) {
      $row = Yii::$app->request->post('UserEducationalLevel');
      if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
        $row[] = [];
      return $this->renderAjax('common/_formUserEducationalLevel', ['row' => $row]);
    } else {
      throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
  }

  public function actionAddUserSubject()
  {
    if (Yii::$app->request->isAjax) {
      $row = Yii::$app->request->post('UserSubject');
      if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
        $row[] = [];
      return $this->renderAjax('common/_formUserSubject', ['row' => $row]);
    } else {
      throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
  }

  public function actionAddWorkplace()
  {
    if (Yii::$app->request->isAjax) {
      $row = Yii::$app->request->post('Workplace');
      if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
        $row[] = [];
      return $this->renderAjax('common/_formWorkplace', ['row' => $row]);
    } else {
      throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
  }

  public function actionMessageAnswer($hash)
  {
    if(!$this->getUserModel()){
      MgHelpers::setFlashInfo('Musisz być zalogowany aby odpowiedzieć.');
      return $this->redirect(['/site/login']);
    }
    $model = new Message();
    $model->sender_id = $this->getUserModel()->id;
    $messageId = \app\components\mgcms\MgHelpers::decrypt($hash);
    if (!$messageId) {
      \app\components\mgcms\MgHelpers::throw404();
    }
    $previousMessage = Message::findOne(['id' => $messageId]);
    $previousMessage->is_read = 1;
    $previousMessage->save();

    if (!$previousMessage) {
      \app\components\mgcms\MgHelpers::throw404();
    }
    $model->message_id = $messageId;
    $model->recipient_id = $previousMessage->sender_id;
    $model->subject = 'Re: ' . $previousMessage->subject;

    if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
      if ($model->sendEmail()) {
        MgHelpers::setFlashSuccess('Wiadomość została wysłana.');
        return $this->refresh();
      }
    } else {

      return $this->render('messageAnswer', [
              'model' => $model,
      ]);
    }
  }

  public function actionMessageRecieved()
  {

    $dataProvider = new ActiveDataProvider([
        'query' => Message::find()
            ->andWhere(['recipient_id' => $this->getUserModel()->id])
            ->orderBy('created_on DESC'),
    ]);

    return $this->render('messagesList', ['dataProvider' => $dataProvider]);
  }

  public function actionMessageSent()
  {

    $dataProvider = new ActiveDataProvider([
        'query' => Message::find()
            ->andWhere(['sender_id' => $this->getUserModel()->id])
            ->orderBy('created_on DESC'),
    ]);

    return $this->render('messagesList', ['dataProvider' => $dataProvider]);
  }

  public function actionGenerateEmployeeCard()
  {
    $model = $this->getUserModel();

    if (!$model->institutions) {
      MgHelpers::setFlashInfo('Brak przypisanego miejsca pracy.');
      return $this->back();
    }
    $engine = new \app\components\mgcms\docRepl\docRepl();
    $engine->loadTemplate(Yii::getAlias('@app/modules/backend/assets/files/wzor_potwierdzenie_zatrudnienia.docx'));

    $curentYearStart = substr(\app\components\mgcms\OeiizkHelpers::getCurrentSchoolYearStart(), 0, 4);
    $data = [
        'year1' => $curentYearStart,
        'year2' => $curentYearStart + 1,
    ];

    foreach ($model->getAttributes() as $attr => $value) {
      $data['user_' . $attr] = $value;
    }

    foreach ($model->institutions[0] as $attr => $value) {
      $data['institution.' . $attr] = $value;
    }

    $data['user_birthdate'] = date('d.m.Y', strtotime($model->birthdate));
    $data['user_subject'] = $model->subjectsStr;
    $data['userlastname'] = $model->last_name;
    $data['userfirstname'] = $model->first_name;
    $data['institutionschoolgoverningbody'] = $model->institutions[0]->school_governing_body;
    $data['user_educational_level'] = $model->educationalLevelsStr;


    $engine->replace($data);

    $tempName = md5(time()) . '.docx';

    $engine->save($tempName);

    header('Content-Disposition: attachment; filename="potwierdzenie_zatrudnienia.docx"');

    echo file_get_contents($tempName);

    unlink($tempName);
  }

  public function actionGenerateEmployeeCardPdf()
  {
    $model = $this->getUserModel();

    if (!$model->institutions) {
      MgHelpers::setFlashInfo('Brak przypisanego miejsca pracy.');
      return $this->back();
    }
    // $engine = new \app\components\mgcms\docRepl\docRepl();
    // $engine->loadTemplate(Yii::getAlias('@app/modules/backend/assets/files/wzor_potwierdzenie_zatrudnienia.docx'));

    $curentYearStart = substr(\app\components\mgcms\OeiizkHelpers::getCurrentSchoolYearStart(), 0, 4);
    $data = [
        'year1' => $curentYearStart,
        'year2' => $curentYearStart + 1,
    ];

    foreach ($model->getAttributes() as $attr => $value) {
      $data['user_' . $attr] = $value;
    }

    foreach ($model->institutions[0] as $attr => $value) {
      $data['institution.' . $attr] = $value;
    }

    $data['user_birthdate'] = date('d.m.Y', strtotime($model->birthdate));
    $data['user_subject'] = $model->subjectsStr;
    $data['userlastname'] = $model->last_name;
    $data['userfirstname'] = $model->first_name;
    $data['institutionschoolgoverningbody'] = $model->institutions[0]->school_governing_body;
    $data['user_educational_level'] = $model->educationalLevelsStr;


    // $engine->replace($data);
    // $tempName = md5(time()) . '.docx';
    // $engine->save($tempName);
    // header('Content-Disposition: attachment; filename="potwierdzenie_zatrudnienia.docx"');
    // echo file_get_contents($tempName);
    // unlink($tempName);

    $content = $this->renderAjax('_employeeCard', [
        'model' => $model,
        'data' => $data
    ]);
//    MgHelpers::registerCssFile('@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css');
//    return $content;

    $pdf = new \kartik\mpdf\Pdf([
        'mode' => \kartik\mpdf\Pdf::MODE_UTF8,
        'format' => \kartik\mpdf\Pdf::FORMAT_A4,
        'orientation' => \kartik\mpdf\Pdf::ORIENT_PORTRAIT,
        'destination' => \kartik\mpdf\Pdf::DEST_BROWSER,
        'marginTop' => 30,        
        'content' => $content,
        'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
        'cssInline' => '
      body { 
        font-family: serif; 
        font-size: 10pt; 
    }
    h1,h2,h3,h4,h5,h6 {
      font-family: serif; 
    }
    img {width:100%;height:auto;}
      table{border: 0px solid black; width: 100%;border-collapse: separate;
  border-spacing: 0;} 
        table td{
        border: 0px solid #000;
        padding: 1mm 0.5cm;
        font-size:9pt;
        
      }',
        'options' => ['title' => \Yii::$app->name],
        'methods' => [
            //  'SetHeader' => [\Yii::$app->name],
            'SetFooter' => ['{PAGENO}'],
        ]
    ]);

    return $pdf->render();
  }

  public function actionTrainings()
  {

    $searchModel = new TrainingSearch();

    $dataProviderNow = $searchModel->searchMyAccount(0);
    $dataProviderPrevious = $searchModel->searchMyAccount(-1);
    $dataProviderFuture = $searchModel->searchMyAccount(1);


    return $this->render('trainings',
            [
                'searchModel' => $searchModel,
                'dataProviderNow' => $dataProviderNow,
                'dataProviderPrevious' => $dataProviderPrevious,
                'dataProviderFuture' => $dataProviderFuture,
    ]);
  }

  public function actionPdf()
  {
    $model = $this->getUserModel();

    $providerUserRole = new \yii\data\ArrayDataProvider([
        'allModels' => $model->userRoles,
    ]);
    $providerUserAgreement = new \yii\data\ArrayDataProvider([
        'allModels' => $model->userAgreements,
    ]);
    $providerUserGroup = new \yii\data\ArrayDataProvider([
        'allModels' => $model->userGroups,
    ]);
    $providerUserSubject = new \yii\data\ArrayDataProvider([
        'allModels' => $model->userSubjects,
    ]);
    $providerWorkplace = new \yii\data\ArrayDataProvider([
        'allModels' => $model->workplaces,
    ]);
    $providerUserEducationalLevel = new \yii\data\ArrayDataProvider([
        'allModels' => $model->userEducationalLevels,
    ]);

    $content = $this->renderAjax('_pdf',
        [
            'model' => $model,
            'providerUserRole' => $providerUserRole,
            'providerUserAgreement' => $providerUserAgreement,
            'providerUserGroup' => $providerUserGroup,
            'providerUserSubject' => $providerUserSubject,
            'providerWorkplace' => $providerWorkplace,
            'providerUserEducationalLevel' => $providerUserEducationalLevel,
    ]);
    $pdf = new \kartik\mpdf\Pdf([
        'mode' => \kartik\mpdf\Pdf::MODE_UTF8,
        'format' => \kartik\mpdf\Pdf::FORMAT_A4,
        'orientation' => \kartik\mpdf\Pdf::ORIENT_PORTRAIT,
        'destination' => \kartik\mpdf\Pdf::DEST_BROWSER,
        'content' => $content,
        'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
        'cssInline' => '.kv-heading-1{font-size:18px}',
        'options' => ['title' => \Yii::$app->name],
        'methods' => [
            'SetFooter' => ['{PAGENO}'],
        ]
    ]);
    return $pdf->render();
  }

  public function actionAddInstitution()
  {
    $model = new \app\models\db\Institution();
    $model->is_verified = 0;

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect('workplace');
    } else {
      return $this->render('addInstitution', [
              'model' => $model,
      ]);
    }
  }

  public function actionResendActivation()
  {
    $sent = OeiizkHelpers::sendReactivationMail();

    if (!$sent) {
      MgHelpers::setFlashError(Yii::t('app', 'Error during sending activation email'));
    } else {
      MgHelpers::setFlashSuccess(Yii::t('app', 'Account successfully created, check your email for activation link'));
    }
    $this->back();
  }

  public function actionInstitutionsAjax($q = null, $id = null)
  {
    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    $out = ['results' => ['id' => '', 'text' => '']];
    if (!is_null($q)) {
      $query = new \yii\db\Query;
      $query->select(["id", " concat(name,' ',postcode,' ',post,' ',street,' ', house_no) AS text"])
          ->from('institution')
          ->where(
              ['or',
                  ['like', 'name', $q],
                  ['like', 'city', $q],
                  ['like', 'street', $q],
                  ['like', 'postcode', $q],
                  ['like', 'post', $q],
          ])
          ->limit(20);
      $command = $query->createCommand();
      $data = $command->queryAll();
      $out['results'] = array_values($data);
    } elseif ($id > 0) {
      $model = \app\models\db\Institution::findOne($id);
      $out['results'] = [
          'id' => $id,
          'text' => (string) $model];
    }
    return $out;
  }
  
  public function actionGenerateCertificate($hash)
  {
    
    $model = \app\models\db\Training::findOne(MgHelpers::decrypt($hash));
    $user = $this->getUserModel();
    if (!$model || !$user) {
      $this->throw404();
    }

    $trainingParticipant = \app\models\db\TrainingParticipant::findOne(['user_id' => $user->id, 'training_id' => $model->id]);
    if (!$trainingParticipant) {
      $this->throw404();
    }


    $content = MgHelpers::getSetting($model->certificate_template, true);
    $content = OeiizkHelpers::replaceCertificate($content, $model, $trainingParticipant);
    

//    MgHelpers::registerCssFile('@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css');
//    return $content;

    $pdf = new \kartik\mpdf\Pdf([
        'mode' => \kartik\mpdf\Pdf::MODE_UTF8,
        'format' => \kartik\mpdf\Pdf::FORMAT_A4,
        'orientation' => \kartik\mpdf\Pdf::ORIENT_PORTRAIT,
        'destination' => \kartik\mpdf\Pdf::DEST_BROWSER,
        'content' => $content,
        'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
        'cssInline' => 'table{border: 1px solid black; width: 100%;border-collapse: separate;
    border-spacing: 0;} 
          table td{
          border: 1px solid #000;
          padding: 3px;
          
        }',
        'marginTop' => 30,
        'marginBottom' => 30,
        'options' => ['title' => \Yii::$app->name],
        'methods' => [
//            'SetHeader' => [\Yii::$app->name],
            'SetFooter' => ['{PAGENO}'],
        ]
    ]);

    return $pdf->render();
  }
}
