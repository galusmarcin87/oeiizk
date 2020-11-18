<?php
namespace app\modules\backend\controllers\oeiizk;

use Yii;
use app\models\db\PollQuestion;
use app\models\db\PollQuestionSearch;
use app\modules\backend\components\mgcms\MgBackendController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\mgcms\MgHelpers;

/**
 * PollQuestionController implements the CRUD actions for PollQuestion model.
 */
class PollQuestionController extends MgBackendController
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
   * Lists all PollQuestion models.
   * @return mixed
   */
  public function actionIndex()
  {
    $searchModel = new PollQuestionSearch();
    $searchModel->is_individual = 0;
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
    ]);
  }

  /**
   * Displays a single PollQuestion model.
   * @param integer $id
   * @return mixed
   */
  public function actionView($id)
  {
    $model = $this->findModel($id);
    $providerPollPollQuestion = new \yii\data\ArrayDataProvider([
        'allModels' => $model->pollPollQuestions,
    ]);
    $providerPollTemplateQuestion = new \yii\data\ArrayDataProvider([
        'allModels' => $model->pollTemplateQuestions,
    ]);
    return $this->render('view', [
            'model' => $this->findModel($id),
            'providerPollPollQuestion' => $providerPollPollQuestion,
            'providerPollTemplateQuestion' => $providerPollTemplateQuestion,
    ]);
  }

  /**
   * Creates a new PollQuestion model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
   */
  public function actionCreate()
  {
    $model = new PollQuestion();

    if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
      return $this->redirect(['view', 'id' => $model->id]);
    } else {
      return $this->render('create', [
              'model' => $model,
      ]);
    }
  }

  /**
   * Creates a new PollQuestion model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
   */
  public function actionAddIndividualQuestion($id)
  {
    $model = new PollQuestion();
    $model->is_individual = true;
    $poll = \app\models\db\Poll::findOne($id);
    if (!$poll) {
      MgHelpers::throw404();
    }

    if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
      $pollPolQuestion = new \app\models\db\PollPollQuestion;
      $pollPolQuestion->poll_id = $poll->id;
      $pollPolQuestion->poll_question_id = $model->id;
      $pollPolQuestion->save();
      $this->redirect(['oeiizk/poll/view', 'id' => $id]);
    } else {
      return $this->render('create', [
              'model' => $model,
      ]);
    }
  }

  /**
   * Updates an existing PollQuestion model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id
   * @return mixed
   */
  public function actionUpdate($id)
  {
    if (Yii::$app->request->post('_asnew') == '1') {
      $model = new PollQuestion();
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
   * Deletes an existing PollQuestion model.
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
   * Export PollQuestion information into PDF format.
   * @param integer $id
   * @return mixed
   */
  public function actionPdf($id)
  {
    $model = $this->findModel($id);
    $providerPollPollQuestion = new \yii\data\ArrayDataProvider([
        'allModels' => $model->pollPollQuestions,
    ]);
    $providerPollTemplateQuestion = new \yii\data\ArrayDataProvider([
        'allModels' => $model->pollTemplateQuestions,
    ]);

    $content = $this->renderAjax('_pdf', [
        'model' => $model,
        'providerPollPollQuestion' => $providerPollPollQuestion,
        'providerPollTemplateQuestion' => $providerPollTemplateQuestion,
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
   * Creates a new PollQuestion model by another data,
   * so user don't need to input all field from scratch.
   * If creation is successful, the browser will be redirected to the 'view' page.
   *
   * @param type $id
   * @return type
   */
  public function actionSaveAsNew($id)
  {
    $model = new PollQuestion();

    if (Yii::$app->request->post('_asnew') != '1') {
      $model = $this->findModel($id);
    }

    if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
      return $this->redirect(['view', 'id' => $model->id]);
    } else {
      return $this->render('saveAsNew', [
              'model' => $model,
      ]);
    }
  }

  /**
   * Finds the PollQuestion model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return PollQuestion the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = PollQuestion::findOne($id)) !== null) {
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
   * for PollTemplateQuestion
   * @author Yohanes Candrajaya <moo.tensai@gmail.com>
   * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
   *
   * @return mixed
   */
  public function actionAddPollTemplateQuestion()
  {
    if (Yii::$app->request->isAjax) {
      $row = Yii::$app->request->post('PollTemplateQuestion');
      if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
        $row[] = [];
      return $this->renderAjax('_formPollTemplateQuestion', ['row' => $row]);
    } else {
      throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
  }
}
