<?php
namespace app\modules\backend\controllers\oeiizk;

use app\models\db\TrainingParticipant;
use Yii;
use app\models\db\Training;
use app\models\db\TrainingSearch;
use app\modules\backend\components\mgcms\MgBackendController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\mgcms\MgHelpers;
use app\models\db\LessonPresence;
use app\models\db\TrainingModulePresence;
use \app\components\mgcms\OeiizkHelpers;

/**
 * TrainingController implements the CRUD actions for Training model.
 */
class TrainingController extends MgBackendController
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
   * Lists all Training models.
   * @return mixed
   */
  public function actionIndex($dateType = false)
  {
    $searchModel = new TrainingSearch();
    $searchModel->dateType = $dateType;


    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
    ]);
  }

  /**
   * Displays a single Training model.
   * @param integer $id
   * @return mixed
   */
  public function actionView($id)
  {
    $model = $this->findModel($id);
    $providerLesson = new \yii\data\ArrayDataProvider([
        'allModels' => $model->lessons,
    ]);
    $providerTrainingLector = new \yii\data\ArrayDataProvider([
        'allModels' => $model->trainingLectors,
    ]);
    $providerTrainingModule = new \yii\data\ArrayDataProvider([
        'allModels' => $model->trainingModules,
    ]);
    $providerTrainingParticipant = new \yii\data\ArrayDataProvider([
        'allModels' => $model->trainingParticipants,
    ]);
    $providerTrainingRequired = new \yii\data\ArrayDataProvider([
        'allModels' => $model->trainingRequireds,
    ]);
    $providerTrainingTrainingDirection = new \yii\data\ArrayDataProvider([
        'allModels' => $model->trainingTrainingDirections,
    ]);
    $providerWorkshop = new \yii\data\ArrayDataProvider([
        'allModels' => $model->workshops,
    ]);
    return $this->render('view',
            [
                'model' => $this->findModel($id),
                'providerLesson' => $providerLesson,
                'providerTrainingLector' => $providerTrainingLector,
                'providerTrainingModule' => $providerTrainingModule,
                'providerTrainingParticipant' => $providerTrainingParticipant,
                'providerTrainingRequired' => $providerTrainingRequired,
                'providerTrainingTrainingDirection' => $providerTrainingTrainingDirection,
                'providerWorkshop' => $providerWorkshop,
    ]);
  }

  /**
   * Creates a new Training model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
   */
  public function actionCreate($templateId = false)
  {
    $model = new Training();
    if ($templateId) {
      $template = \app\models\db\TrainingTemplate::findOne($templateId);
      if (!$template) {
        MgHelpers::throw404();
      }
      $model->training_template_id = $templateId;
      $model->inheritFromTemplate();
    }

    if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll(['lectorsStr'])) {
      if (OeiizkHelpers::isRole(\app\models\mgcms\db\User::ROLE_LECTOR)) {
        $trainingLector = new \app\models\db\TrainingLector;
        $trainingLector->user_id = $this->getUserModel()->id;
        $trainingLector->training_id = $model->id;
        try {
          $trainingLector->save();
        } catch (yii\db\IntegrityException $e) {
          
        }
      }

      $this->saveParticipantCheckboxes($model);

      return $this->redirect(['view', 'id' => $model->id]);
    } else {
      return $this->render('create', [
              'model' => $model,
      ]);
    }
  }

  /**
   * Updates an existing Training model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id
   * @return mixed
   */
  public function actionUpdate($id, $templateId = false)
  {
    if (Yii::$app->request->post('_asnew') == '1') {
      $model = new Training();
    } else {
      $model = $this->findModel($id);
    }

    if ($model->status == Training::STATUS_CLOSED) {
      $this->back();
    }

    if ($templateId) {
      $model->training_template_id = $templateId;
    }

    if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll(['lectorsStr', 'participants', 'lectors'])) {
      $this->savePresences($model);
      $this->saveParticipantCheckboxes($model);
      return $this->redirect(['view', 'id' => $model->id]);
    } else {
      return $this->render('update', [
              'model' => $model,
      ]);
    }
  }

  public function actionUpdateParticipants($id)
  {

    $model = $this->findModel($id);

    if ($model->status == Training::STATUS_CLOSED) {
      $this->back();
    }

    if(isset($_POST['timestamp'])){
        $trainingParticipantsAddedInMeantime = TrainingParticipant::find()->andWhere(['training_id'=>$id])->andWhere(['>','created_on',$_POST['timestamp']])->all();
    }
    if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll(['lectorsStr', 'participants', 'lectors'])) {
        foreach ($trainingParticipantsAddedInMeantime as $trainingParticipantsAddedInMeantimeItem){
            $trainingParticipantsAddedInMeantimeItem->isNewRecord = true;
            $trainingParticipantsAddedInMeantimeItem->save();
        }
      $this->saveParticipantCheckboxes($model);
        MgHelpers::setFlashSuccess("Zapisano");
      $this->refresh();

    }
    return $this->render('updateParticipants', [
            'model' => $model,
    ]);
  }

  private function savePresences($model)
  {
    $post = Yii::$app->request->post();
    if (isset($post['lessonPresenceToDelete'])) {
      LessonPresence::deleteAll(['IN', 'training_lesson_id', $post['lessonPresenceToDelete']]);
    }
    if (isset($post['modulePresenceToDelete'])) {
      TrainingModulePresence::deleteAll(['IN', 'training_module_id', $post['modulePresenceToDelete']]);
    }

    if (isset($post['lessonPresence'])) {
      foreach ($post['lessonPresence'] as $userId => $lessons) {
        foreach ($lessons as $lessonId => $on) {
          $lessonPresence = new LessonPresence;
          $lessonPresence->user_id = $userId;
          $lessonPresence->training_lesson_id = $lessonId;
          $lessonPresence->save();
        }
      }
    }

    if (isset($post['modulePresence'])) {
      foreach ($post['modulePresence'] as $userId => $modules) {
        foreach ($modules as $moduleId => $on) {
          $modulePresence = new TrainingModulePresence;
          $modulePresence->user_id = $userId;
          $modulePresence->training_module_id = $moduleId;
          $modulePresence->save();
        }
      }
    }
  }

  private function saveParticipantCheckboxes(Training $model)
  {
    $post = Yii::$app->request->post();
    if (isset($post['is_print_certificate'])) {
      foreach ($post['is_print_certificate'] as $userId => $val) {
        $participant = \app\models\db\TrainingParticipant::findOne(['training_id' => $model->id, 'user_id' => $userId]);
        if ($participant) {
          $participant->is_print_certificate = $val;
          $participant->save();
        }
      }
    }

    if (isset($post['is_passed'])) {
      foreach ($post['is_passed'] as $userId => $val) {
        $participant = \app\models\db\TrainingParticipant::findOne(['training_id' => $model->id, 'user_id' => $userId]);
        if ($participant) {
          $participant->is_passed = $val;
          $participant->save();
        }
      }
    }
  }

  public function actionStatusEdit($id)
  {

    $model = $this->findModel($id);

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->id]);
    } else {
      return $this->render('editStatus', [
              'model' => $model,
      ]);
    }
  }

  /**
   * Deletes an existing Training model.
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
   * Export Training information into PDF format.
   * @param integer $id
   * @return mixed
   */
  public function actionPdf($id)
  {
    $model = $this->findModel($id);
    $providerLesson = new \yii\data\ArrayDataProvider([
        'allModels' => $model->lessons,
    ]);
    $providerTrainingLector = new \yii\data\ArrayDataProvider([
        'allModels' => $model->trainingLectors,
    ]);
    $providerTrainingModule = new \yii\data\ArrayDataProvider([
        'allModels' => $model->trainingModules,
    ]);
    $providerTrainingParticipant = new \yii\data\ArrayDataProvider([
        'allModels' => $model->trainingParticipants,
    ]);
    $providerTrainingRequired = new \yii\data\ArrayDataProvider([
        'allModels' => $model->trainingRequireds,
    ]);
    $providerTrainingTrainingDirection = new \yii\data\ArrayDataProvider([
        'allModels' => $model->trainingTrainingDirections,
    ]);
    $providerWorkshop = new \yii\data\ArrayDataProvider([
        'allModels' => $model->workshops,
    ]);

    $content = $this->renderAjax('_pdf',
        [
            'model' => $model,
            'providerLesson' => $providerLesson,
            'providerTrainingLector' => $providerTrainingLector,
            'providerTrainingModule' => $providerTrainingModule,
            'providerTrainingParticipant' => $providerTrainingParticipant,
            'providerTrainingRequired' => $providerTrainingRequired,
            'providerTrainingTrainingDirection' => $providerTrainingTrainingDirection,
            'providerWorkshop' => $providerWorkshop,
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
        'marginTop' => 30,
        'marginBottom' => 30,
        'methods' => [
            'SetHeader' => [\Yii::$app->name],
            'SetFooter' => ['{PAGENO}'],
        ]
    ]);

    return $pdf->render();
  }

  public function actionGeneratePresenseList($id)
  {

    ini_set('memory_limit', '800M');
    ini_set('max_execution_time', 300);
    $model = $this->findModel($id);
    if (!$model) {
      $this->throw404();
    }


    $content = $this->renderAjax('_presenceList', [
        'model' => $model,
    ]);
//    MgHelpers::registerCssFile('@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css');
//    return $content;

    $pdf = new \kartik\mpdf\Pdf([
        'mode' => \kartik\mpdf\Pdf::MODE_UTF8,
        'format' => \kartik\mpdf\Pdf::FORMAT_A4,
        'orientation' => \kartik\mpdf\Pdf::ORIENT_LANDSCAPE,
        'destination' => \kartik\mpdf\Pdf::DEST_BROWSER,
        'content' => $content,
        'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
        'cssInline' => 'table{border: 1px solid black; width: 100%;border-collapse: separate;
    border-spacing: 0;} 
          table td{
          border: 1px solid #000;
          padding: 3px;
          
        }',
        'marginTop' => 10,
        'marginBottom' => 10,
        'options' => [
            'title' => \Yii::$app->name,
            'defaultheaderline' => 0, //for header
            'defaultfooterline' => 0  //for footer
        ],
        'methods' => [
            'SetHeader' => [MgHelpers::getSetting('dokumentacja pozioma - nagłówek', true)],
            'SetFooter' => ['{PAGENO}/{nbpg}' . MgHelpers::getSetting('dokumentacja pozioma - stopka', true)],
        ]
    ]);

    return $pdf->render();
  }

  public function actionGenerateList($id)
  {
    ini_set('memory_limit', '800M');
    ini_set('max_execution_time', 300);

    $model = $this->findModel($id);
    if (!$model) {
      $this->throw404();
    }


    $content = $this->renderAjax('_list', [
        'model' => $model,
    ]);
//    MgHelpers::registerCssFile('@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css');
//    return $content;

    $pdf = new \kartik\mpdf\Pdf([
        'mode' => \kartik\mpdf\Pdf::MODE_UTF8,
        'format' => \kartik\mpdf\Pdf::FORMAT_A4,
        'orientation' => \kartik\mpdf\Pdf::ORIENT_LANDSCAPE,
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
        'options' => [
            'title' => \Yii::$app->name,
            'defaultheaderline' => 0, //for header
            'defaultfooterline' => 0  //for footer
        ],
        'methods' => [
            'SetHeader' => [MgHelpers::getSetting('dokumentacja pozioma - nagłówek', true)],
            'SetFooter' => ['{PAGENO}/{nbpg}' . MgHelpers::getSetting('dokumentacja pozioma - stopka', true)],
        ]
    ]);

    return $pdf->render();
  }

  public function actionGenerateDiary($id)
  {
    ini_set('memory_limit', '800M');
    $model = $this->findModel($id);
    if (!$model) {
      $this->throw404();
    }

    $content = $this->renderAjax('_diary', [
        'model' => $model,
        'model' => $model
    ]);
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
        }
          h3{
            font-size: 24px;
          }
        ',
        'marginTop' => 30,
        'marginBottom' => 30,
        'options' => [
            'title' => \Yii::$app->name,
            'defaultheaderline' => 0, //for header
            'defaultfooterline' => 0  //for footer
        ],
        'methods' => [
            'SetHeader' => [MgHelpers::getSetting('dokumentacja - nagłówek', true)],
            'SetFooter' => ['{PAGENO}/{nbpg}' . MgHelpers::getSetting('dokumentacja - stopka', true)],
        ]
    ]);

    return $pdf->render();
  }

  public function actionGeneratePoll($id)
  {

    ini_set('memory_limit', '800M');
    $model = $this->findModel($id);
    if (!$model) {
      $this->throw404();
    }


    $content = $this->renderAjax('_poll', [
        'model' => $model,
    ]);
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
        'options' => [
            'title' => \Yii::$app->name,
            'defaultheaderline' => 0, //for header
            'defaultfooterline' => 0  //for footer
        ],
        'methods' => [
            'SetHeader' => [MgHelpers::getSetting('dokumentacja - nagłówek', true)],
            'SetFooter' => [MgHelpers::getSetting('dokumentacja - stopka', true)],
        ]
    ]);

    return $pdf->render();
  }

  public function actionGeneratePollSummary($id)
  {

    ini_set('memory_limit', '800M');
    $model = $this->findModel($id);
    if (!$model) {
      $this->throw404();
    }

    if (!$model->poll) {
      MgHelpers::setFlashInfo('Brak ankiety dla tego szkolenia');
      return $this->back();
    }
    $answerUsers = (new yii\db\Query())
            ->select(['user_id',])
            ->select('user_id')
            ->from('pol_question_answer')
            ->where(['training_id' => $id, 'poll_poll_question_poll_id' => $model->poll->id])->distinct()->all();

    $userIds = array_map(function($e) {
      return $e['user_id'];
    }, $answerUsers);


    if (!$userIds) {
      MgHelpers::setFlashInfo('Nikt nie wypełnił ankiety');
      return $this->back();
    }


    $content = $this->renderAjax('_pollAnswersPdf', [
        'model' => $model,
        'userIds' => $userIds,
    ]);
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
        'options' => [
            'title' => \Yii::$app->name,
            'defaultheaderline' => 0,
            'defaultfooterline' => 0,
        ],
        'methods' => [
            'SetHeader' => [MgHelpers::getSetting('dokumentacja - nagłówek', true), ''],
            'SetFooter' => [MgHelpers::getSetting('dokumentacja - stopka', true), ''],
        ]
    ]);

    return $pdf->render();
  }

  /**
   * Creates a new Training model by another data,
   * so user don't need to input all field from scratch.
   * If creation is successful, the browser will be redirected to the 'view' page.
   *
   * @param type $id
   * @return type
   */
  public function actionSaveAsNew($id)
  {
    $model = new Training();

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
   * Finds the Training model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return Training the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = Training::findOne($id)) !== null) {
      if (!$model->checkAccess()) {
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
      }
      return $model;
    } else {
      throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
  }

  /**
   * Action to load a tabular form grid
   * for Lesson
   * @author Yohanes Candrajaya <moo.tensai@gmail.com>
   * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
   *
   * @return mixed
   */
  public function actionAddLesson()
  {
    if (Yii::$app->request->isAjax) {
      $row = Yii::$app->request->post('Lesson');
      if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
        $row[] = [];
      return $this->renderAjax('_formLesson', ['row' => $row]);
    } else {
      throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
  }

  /**
   * Action to load a tabular form grid
   * for TrainingLector
   * @author Yohanes Candrajaya <moo.tensai@gmail.com>
   * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
   *
   * @return mixed
   */
  public function actionAddTrainingLector()
  {
    if (Yii::$app->request->isAjax) {
      $row = Yii::$app->request->post('TrainingLector');
      if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
        $row[] = [];
      return $this->renderAjax('_formTrainingLector', ['row' => $row]);
    } else {
      throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
  }

  /**
   * Action to load a tabular form grid
   * for TrainingModule
   * @author Yohanes Candrajaya <moo.tensai@gmail.com>
   * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
   *
   * @return mixed
   */
  public function actionAddTrainingModule()
  {
    if (Yii::$app->request->isAjax) {
      $row = Yii::$app->request->post('TrainingModule');
      if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
        $row[] = [];
      return $this->renderAjax('_formTrainingModule', ['row' => $row]);
    } else {
      throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
  }

  /**
   * Action to load a tabular form grid
   * for TrainingParticipant
   * @author Yohanes Candrajaya <moo.tensai@gmail.com>
   * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
   *
   * @return mixed
   */
  public function actionAddTrainingParticipant()
  {
    if (Yii::$app->request->isAjax) {
      $row = Yii::$app->request->post('TrainingParticipant');
      if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
        $row[] = [];
      return $this->renderAjax('_formTrainingParticipant', ['row' => $row]);
    } else {
      throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
  }

  /**
   * Action to load a tabular form grid
   * for TrainingRequired
   * @author Yohanes Candrajaya <moo.tensai@gmail.com>
   * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
   *
   * @return mixed
   */
  public function actionAddTrainingRequired()
  {
    if (Yii::$app->request->isAjax) {
      $row = Yii::$app->request->post('TrainingRequired');
      if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
        $row[] = [];
      return $this->renderAjax('_formTrainingRequired', ['row' => $row]);
    } else {
      throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
  }

  /**
   * Action to load a tabular form grid
   * for TrainingTrainingDirection
   * @author Yohanes Candrajaya <moo.tensai@gmail.com>
   * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
   *
   * @return mixed
   */
  public function actionAddTrainingTrainingDirection()
  {
    if (Yii::$app->request->isAjax) {
      $row = Yii::$app->request->post('TrainingTrainingDirection');
      if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
        $row[] = [];
      return $this->renderAjax('_formTrainingTrainingDirection', ['row' => $row]);
    } else {
      throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
  }

  /**
   * Action to load a tabular form grid
   * for Workshop
   * @author Yohanes Candrajaya <moo.tensai@gmail.com>
   * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
   *
   * @return mixed
   */
  public function actionAddWorkshop()
  {
    if (Yii::$app->request->isAjax) {
      $row = Yii::$app->request->post('Workshop');
      if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
        $row[] = [];
      return $this->renderAjax('_formWorkshop', ['row' => $row]);
    } else {
      throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
  }

  public function actionCalendar($lab_id = false)
  {
    $a = Yii::$app->get('assetsAutoCompress');
    $a->cssFileCompile = false;

    if ($lab_id) {
      $lab = \app\models\db\Lab::findOne($lab_id);
    }

    return $this->render('calendar', [
            'lab' => isset($lab) ? $lab : false
    ]);
  }

  public function actionJsoncalendar($start = NULL, $end = NULL, $_ = NULL, $lab_id = false)
  {

    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

    $events = [];


    /* ----------------LESSONS--------------- */
    $queryLessons = \app\models\db\Lesson::find();
    if ($start) {
      $queryLessons->andWhere(['>', 'date_start', $start]);
    }
    if ($end) {
      $queryLessons->andWhere(['<=', 'date_end', $end]);
    }

    if ($lab_id) {
      $queryLessons->andFilterCompare('lab_id', $lab_id);
    }
    /* @var $lessons \app\models\db\Lesson[] */
    $lessons = $queryLessons->all();

    foreach ($lessons as $lesson) {
      if ($lesson->training) {
        $Event = new \yii2fullcalendar\models\Event();
        $Event->id = $lesson->id;
        $Event->title = $lesson->training->code . ': ' . $lesson->training->name . ', ' . ($lesson->lab ? $lesson->lab->shorterName : "");
        $Event->start = date('Y-m-d\TH:i:s\Z', strtotime($lesson->date_start));
        $Event->end = date('Y-m-d\TH:i:s\Z', strtotime($lesson->date_end));
        $Event->url = $lesson->link;

        $events[] = $Event;
      }
    }
    /* ----------------LESSONS--------------- */



    /* ----------------EVENTS--------------- */
    $queryEvents = \app\models\db\Event::find();
    if ($start) {
      $queryEvents->andWhere(['>', 'date_from', $start]);
    }
    if ($end) {
      $queryEvents->andWhere(['<=', 'date_to', $end]);
    }
    if ($lab_id) {
      $queryEvents->andFilterCompare('lab_id', $lab_id);
    }
    $eventModels = $queryEvents->all();

    foreach ($eventModels as $model) {
      $Event = new \yii2fullcalendar\models\Event();
      $Event->id = $model->id;
      $Event->title = (string) $model . ', Sala: ' . ($model->lab ? $model->lab->shorterName : '');
      $Event->start = date('Y-m-d\TH:i:s\Z', strtotime($model->date_from));
      $Event->end = date('Y-m-d\TH:i:s\Z', strtotime($model->date_to));
      $Event->color = 'green';
      $Event->url = $model->link2;
      $events[] = $Event;
    }
    /* ----------------EVENTS--------------- */


    /* ----------------WORKSHOPS--------------- */
    $queryWorkshops = \app\models\db\Workshop::find();
    if ($start) {
      $queryWorkshops->andWhere(['>', 'date_start', $start]);
    }
    if ($end) {
      $queryWorkshops->andWhere(['<=', 'date_end', $end]);
    }
    if ($lab_id) {
      $queryWorkshops->andFilterCompare('lab_id', $lab_id);
    }
    $workshopModels = $queryWorkshops->all();
    foreach ($workshopModels as $model) {
      $Event = new \yii2fullcalendar\models\Event();
      $Event->id = $model->id;
      $Event->title = 'Warsztat: ' . (string) $model . ', Sala: ' . ($model->lab ? $model->lab->shorterName : '');
      $Event->start = date('Y-m-d\TH:i:s\Z', strtotime($model->date_start));
      $Event->end = date('Y-m-d\TH:i:s\Z', strtotime($model->date_end));
      $Event->color = 'purple';
      $Event->url = $model->link2;
      $events[] = $Event;
    }
    /* ----------------WORKSHOPS--------------- */

    return $events;
  }

  public function actionPollAnswers($id)
  {
    $model = $this->findModel($id);
    if (!$model) {
      $this->throw404();
    }
    if (!$model->poll) {
      MgHelpers::setFlashInfo('Brak ankiety dla tego szkolenia');
      return $this->back();
    }
    $answerUsers = (new yii\db\Query())
            ->select(['user_id',])
            ->select('user_id')
            ->from('pol_question_answer')
            ->where(['training_id' => $id, 'poll_poll_question_poll_id' => $model->poll->id])->distinct()->all();

    $userIds = array_map(function($e) {
      return $e['user_id'];
    }, $answerUsers);


    if (!$userIds) {
      MgHelpers::setFlashInfo('Nikt nie wypełnił ankiety');
      return $this->back();
    }
    return $this->render('pollAnswers', [
            'model' => $model,
            'userIds' => $userIds,
    ]);
  }

  public function actionGenerateCertificate($training_id, $user_id)
  {
    $model = $this->findModel($training_id);
    if (!$model->certificate_template) {
      MgHelpers::setFlashInfo('Brak ustawionego szablonu zaświadczenia');
      return $this->back();
    }
    $user = \app\models\mgcms\db\User::findOne($user_id);
    if (!$model || !$user) {
      $this->throw404();
    }

    $trainingParticipant = \app\models\db\TrainingParticipant::findOne(['user_id' => $user_id, 'training_id' => $training_id]);
    if (!$trainingParticipant) {
      $this->throw404();
    }

    if (!$trainingParticipant->is_print_certificate) {
      MgHelpers::setFlashInfo('Generowanie cetryfikatu dla tego uczestnika jest wyłączone.');
      return $this->back();
    }

    if (!$trainingParticipant->is_certificate_printed) {
      $trainingParticipant->is_certificate_printed = 1;
      $trainingParticipant->workplace = $user->getInstitutionsStr();
      $trainingParticipant->surname = $user->last_name;
      $trainingParticipant->save();
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
            'SetFooter' => false,
        ]
    ]);

    return $pdf->render();
  }

  public function actionGenerateCertificateAll($training_id)
  {
    $model = $this->findModel($training_id);

    if (!$model->certificate_template) {
      MgHelpers::setFlashInfo('Brak ustawionego szablonu zaświadczenia');
      return $this->back();
    }

    $templateContent = MgHelpers::getSetting($model->certificate_template, true);

    $users = [];
    $contents = [];
    foreach ($model->trainingParticipants as $participant) {
      if ($participant->is_print_certificate) {
        if (!$participant->is_certificate_printed) {
          $participant->is_certificate_printed = 1;
          $participant->workplace = $participant->user->getInstitutionsStr();
          $participant->surname = $participant->user->last_name;
          $participant->save();
        }
        $users[] = $participant->user;
        $content = $templateContent;

        $content = OeiizkHelpers::replaceCertificate($content, $model, $participant);

        $contents[] = $content;
      }
    }



    $pdf = new \kartik\mpdf\Pdf([
        'mode' => \kartik\mpdf\Pdf::MODE_UTF8,
        'format' => \kartik\mpdf\Pdf::FORMAT_A4,
        'orientation' => \kartik\mpdf\Pdf::ORIENT_PORTRAIT,
        'destination' => \kartik\mpdf\Pdf::DEST_BROWSER,
        'content' => implode('<newpage>', $contents),
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
            'SetFooter' => false,
        ]
    ]);

    return $pdf->render();
  }

  public function actionNumerate($id)
  {
    $model = $this->findModel($id);
    $participants = \app\models\db\TrainingParticipant::find()->andWhere(['training_id' => $id])->joinWith('user')->orderBy(['user.last_name' => SORT_ASC])->all();
    $n = 0;
    foreach ($participants as $index => $participant) {
      if (in_array($participant->status, ['wykreślenie', 'rezygnacja przed zapisem', 'rezygnacja zamiast potwierdzenia', 'lista rezerwowa'])) {
        $participant->order = null;
      } else {
        $participant->order = $n + 1;
        $n++;
      }
      $participant->save();
    }
    MgHelpers::setFlashSuccess('Ponumerowano');
    $this->back();
  }
}
