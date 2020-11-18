<?php
namespace app\modules\backend\controllers\oeiizk;

use Yii;
use app\models\db\Newsletter;
use app\models\db\NewsletterSearch;
use app\modules\backend\components\mgcms\MgBackendController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\mgcms\MgHelpers;

/**
 * NewsletterController implements the CRUD actions for Newsletter model.
 */
class NewsletterController extends MgBackendController
{

  public function behaviors()
  {
    return [
        'verbs' => [
            'class' => VerbFilter::className(),
            'actions' => [
                'delete' => ['post'],
            ],
        ],
    ];
  }

  /**
   * Lists all Newsletter models.
   * @return mixed
   */
  public function actionIndex()
  {
    $searchModel = new NewsletterSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
    ]);
  }

  /**
   * Displays a single Newsletter model.
   * @param integer $id
   * @return mixed
   */
  public function actionView($id)
  {
    $model = $this->findModel($id);
    $providerNewsletterUser = new \yii\data\ArrayDataProvider([
        'allModels' => $model->newsletterUsers,
    ]);
    return $this->render('view',
            [
            'model' => $this->findModel($id),
            'providerNewsletterUser' => $providerNewsletterUser,
    ]);
  }

  /**
   * Creates a new Newsletter model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
   */
  public function actionCreate()
  {
    $model = new Newsletter();

    MgHelpers::getSetting('newsletter_header', true);

    MgHelpers::getSetting('newsletter_footer', true);

    if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
      return $this->redirect(['view', 'id' => $model->id]);
    } else {
      return $this->render('create', [
              'model' => $model,
      ]);
    }
  }

  /**
   * Updates an existing Newsletter model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id
   * @return mixed
   */
  public function actionUpdate($id)
  {
    if (Yii::$app->request->post('_asnew') == '1') {
      $model = new Newsletter();
    } else {
      $model = $this->findModel($id);
    }

    if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
      return $this->redirect(['view', 'id' => $model->id]);
    } else {
      return $this->render('update', [
              'model' => $model,
      ]);
    }
  }

  /**
   * Deletes an existing Newsletter model.
   * If deletion is successful, the browser will be redirected to the 'index' page.
   * @param integer $id
   * @return mixed
   */
  public function actionDelete($id)
  {
    $this->findModel($id)->delete();

    return $this->redirect(['index']);
  }

  /**
   * 
   * Export Newsletter information into PDF format.
   * @param integer $id
   * @return mixed
   */
  public function actionPdf($id)
  {
    $model = $this->findModel($id);
    $providerNewsletterUser = new \yii\data\ArrayDataProvider([
        'allModels' => $model->newsletterUsers,
    ]);

    $content = $this->renderAjax('_pdf', [
        'model' => $model,
        'providerNewsletterUser' => $providerNewsletterUser,
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
            'SetHeader' => [\Yii::$app->name],
            'SetFooter' => ['{PAGENO}'],
        ]
    ]);

    return $pdf->render();
  }

  /**
   * Creates a new Newsletter model by another data,
   * so user don't need to input all field from scratch.
   * If creation is successful, the browser will be redirected to the 'view' page.
   *
   * @param type $id
   * @return type
   */
  public function actionSaveAsNew($id)
  {
    $model = new Newsletter();

    if (Yii::$app->request->post('_asnew') != '1') {
      $model = $this->findModel($id);
    }

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->id]);
    } else {
      return $this->render('saveAsNew', [
              'model' => $model,
      ]);
    }
  }

  /**
   * Finds the Newsletter model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return Newsletter the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = Newsletter::findOne($id)) !== null) {
      return $model;
    } else {
      throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
  }

  /**
   * Action to load a tabular form grid
   * for NewsletterUser
   * @author Yohanes Candrajaya <moo.tensai@gmail.com>
   * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
   *
   * @return mixed
   */
  public function actionAddNewsletterUser()
  {
    if (Yii::$app->request->isAjax) {
      $row = Yii::$app->request->post('NewsletterUser');
      if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
        $row[] = [];
      return $this->renderAjax('_formNewsletterUser', ['row' => $row]);
    } else {
      throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
  }

  public function actionSend($id)
  {
    set_time_limit(5000);
    $model = Newsletter::findOne($id);
    if (!$model) {
      MgHelpers::throw404();
    }

    $query = \app\models\mgcms\db\User::find()->where(['is_newsletter' => 1]);
    if ($model->group_id) {
      $query->joinWith('groups')->andWhere(['group.id' => $model->group_id]);
    }

    $users = $query->all();
    $emails = [];
    foreach ($users as $user) {
      if ($user->email) {
        $emails[$user->email] = (string) $user;
      }
    }
    
    $newsletterEmails = \app\models\db\NewsletterEmail::find()->all();
    foreach ($newsletterEmails as $newsletterEmail) {
      if ($newsletterEmail->email) {
        $emails[$newsletterEmail->email] = $newsletterEmail->email;
      }
    }

    if (sizeof($emails) == 0) {
      MgHelpers::setFlash(MgHelpers::FLASH_TYPE_WARNING, 'Nie znaleziono żadnego użytkownika spełniającego kryteria');
      return $this->back();
    }

    if (!MgHelpers::getSetting('email') || !MgHelpers::getSetting('email newsletter nazwa')) {
      MgHelpers::setFlashError('Brak skonfigurowanych wartości dla : "email" lub "email newsletter nazwa"');
      return $this->back();
    }

    $mail = Yii::$app->mailer->compose('newsletter', ['model' => $model])
        ->setBcc($emails)
        ->setFrom([MgHelpers::getSetting('email') => MgHelpers::getSetting('email newsletter nazwa')])
        ->setSubject($model->name);

    $sent = $mail->send();

    if ($sent) {
      $model->date_sent = date('Y-m-d H:i:s');
      $saved = $model->save();
      MgHelpers::setFlashSuccess('Newsletter wysłany');
    } else {
      MgHelpers::setFlashError('Nie udało się wysłąć maila: ');
    }


    return $this->back();
  }
}
