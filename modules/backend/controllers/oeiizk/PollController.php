<?php
namespace app\modules\backend\controllers\oeiizk;

use Yii;
use app\models\db\Poll;
use app\models\db\PollSearch;
use app\modules\backend\components\mgcms\MgBackendController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\mgcms\MgHelpers;

/**
 * PollController implements the CRUD actions for Poll model.
 */
class PollController extends MgBackendController
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
   * Lists all Poll models.
   * @return mixed
   */
  public function actionIndex()
  {
    $searchModel = new PollSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
    ]);
  }

  /**
   * Displays a single Poll model.
   * @param integer $id
   * @return mixed
   */
  public function actionView($id)
  {
    $model = $this->findModel($id);
    $providerPollPollQuestion = new \yii\data\ArrayDataProvider([
        'allModels' => $model->pollPollQuestions,
    ]);
    $providerTraining = new \yii\data\ArrayDataProvider([
        'allModels' => $model->trainings,
    ]);
    $providerTrainingTemplate = new \yii\data\ArrayDataProvider([
        'allModels' => $model->trainingTemplates,
    ]);
    return $this->render('view', [
            'model' => $this->findModel($id),
            'providerPollPollQuestion' => $providerPollPollQuestion,
            'providerTraining' => $providerTraining,
            'providerTrainingTemplate' => $providerTrainingTemplate,
    ]);
  }

  /**
   * Creates a new Poll model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
   */
  public function actionCreate()
  {
    $model = new Poll();

    if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
      $this->assignTemplateAndReqiredQuestions($model);
      return $this->redirect(['update', 'id' => $model->id]);
    } else {
      return $this->render('create', [
              'model' => $model,
      ]);
    }
  }

  /**
   * 
   * @param Poll $model
   */
  private function assignTemplateAndReqiredQuestions($model)
  {
    try {
      $requiredQuestions = \app\models\db\PollQuestion::find()->where(['is_required' => 1])->all();
      if ($model->pollTemplate) {
        $templateQuestions = [];
        foreach($model->pollTemplate->pollTemplateQuestions as $pollTemplateQuestion){
          $pollTemplateQuestion->pollQuestion->order = $pollTemplateQuestion->order;
          $templateQuestions[] = $pollTemplateQuestion->pollQuestion;
        }
        foreach (\yii\helpers\ArrayHelper::merge($templateQuestions, $requiredQuestions) as $question) {
          if(!$question->is_deleted) {
            $pollPolQuestion = new \app\models\db\PollPollQuestion;
            $pollPolQuestion->poll_id = $model->id;
            $pollPolQuestion->poll_question_id = $question->id;
            $pollPolQuestion->order = $question->order;
            $pollPolQuestion->save();
          }
        }
      }
    } catch (yii\db\IntegrityException $e) {
      
    }
  }

  /**
   * Updates an existing Poll model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id
   * @return mixed
   */
  public function actionUpdate($id)
  {
    if (Yii::$app->request->post('_asnew') == '1') {
      $model = new Poll();
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
   * Deletes an existing Poll model.
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
   * Export Poll information into PDF format.
   * @param integer $id
   * @return mixed
   */
  public function actionPdf($id)
  {
    $model = $this->findModel($id);
    $providerPollPollQuestion = new \yii\data\ArrayDataProvider([
        'allModels' => $model->pollPollQuestions,
    ]);
    $providerTraining = new \yii\data\ArrayDataProvider([
        'allModels' => $model->trainings,
    ]);
    $providerTrainingTemplate = new \yii\data\ArrayDataProvider([
        'allModels' => $model->trainingTemplates,
    ]);

    $content = $this->renderAjax('_pdf', [
        'model' => $model,
        'providerPollPollQuestion' => $providerPollPollQuestion,
        'providerTraining' => $providerTraining,
        'providerTrainingTemplate' => $providerTrainingTemplate,
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
   * Creates a new Poll model by another data,
   * so user don't need to input all field from scratch.
   * If creation is successful, the browser will be redirected to the 'view' page.
   *
   * @param type $id
   * @return type
   */
  public function actionSaveAsNew($id)
  {
    $model = new Poll();

    if (Yii::$app->request->post('_asnew') != '1') {
      $model = $this->findModel($id);
    }

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
      $this->assignTemplateAndReqiredQuestions($model);
      return $this->redirect(['view', 'id' => $model->id]);
    } else {
      return $this->render('saveAsNew', [
              'model' => $model,
      ]);
    }
  }

  /**
   * Finds the Poll model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return Poll the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = Poll::findOne($id)) !== null) {
      return $model;
    } else {
      throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
  }

  /**
   * Action to load a tabular form grid
   * for PollPollQuestion
   * @author Yohanes Candrajaya <moo.tensai@gmail.com>
   * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
   *
   * @return mixed
   */
  public function actionAddPollPollQuestion()
  {
    if (Yii::$app->request->isAjax) {
      $row = Yii::$app->request->post('PollPollQuestion');
      if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
        $row[] = [];
      return $this->renderAjax('_formPollPollQuestion', ['row' => $row]);
    } else {
      throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
  }

  /**
   * Action to load a tabular form grid
   * for Training
   * @author Yohanes Candrajaya <moo.tensai@gmail.com>
   * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
   *
   * @return mixed
   */
  public function actionAddTraining()
  {
    if (Yii::$app->request->isAjax) {
      $row = Yii::$app->request->post('Training');
      if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
        $row[] = [];
      return $this->renderAjax('_formTraining', ['row' => $row]);
    } else {
      throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
  }

  /**
   * Action to load a tabular form grid
   * for TrainingTemplate
   * @author Yohanes Candrajaya <moo.tensai@gmail.com>
   * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
   *
   * @return mixed
   */
  public function actionAddTrainingTemplate()
  {
    if (Yii::$app->request->isAjax) {
      $row = Yii::$app->request->post('TrainingTemplate');
      if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
        $row[] = [];
      return $this->renderAjax('_formTrainingTemplate', ['row' => $row]);
    } else {
      throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
  }
}
