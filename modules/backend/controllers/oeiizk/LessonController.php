<?php
namespace app\modules\backend\controllers\oeiizk;

use Yii;
use app\models\db\Lesson;
use app\models\db\LessonSearch;
use app\modules\backend\components\mgcms\MgBackendController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\mgcms\MgHelpers;

/**
 * LessonController implements the CRUD actions for Lesson model.
 */
class LessonController extends MgBackendController
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
   * Lists all Lesson models.
   * @return mixed
   */
  public function actionIndex()
  {
    $searchModel = new LessonSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
    ]);
  }

  /**
   * Displays a single Lesson model.
   * @param integer $id
   * @return mixed
   */
  public function actionView($id)
  {
    $model = $this->findModel($id);
    $providerLessonPresence = new \yii\data\ArrayDataProvider([
        'allModels' => $model->lessonPresences,
    ]);
    return $this->render('view', [
            'model' => $this->findModel($id),
            'providerLessonPresence' => $providerLessonPresence,
    ]);
  }

  /**
   * Creates a new Lesson model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
   */
  public function actionCreate()
  {
    $model = new Lesson();

    if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
      return $this->redirect(['view', 'id' => $model->id]);
    } else {
      return $this->render('create', [
              'model' => $model,
      ]);
    }
  }

  /**
   * Updates an existing Lesson model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id
   * @return mixed
   */
  public function actionUpdate($id)
  {
    if (Yii::$app->request->post('_asnew') == '1') {
      $model = new Lesson();
    } else {
      $model = $this->findModel($id);
    }

    if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
        MgHelpers::setFlashSuccess('Zapisano');
      return $this->redirect(['update', 'id' => $model->id]);
    } else {
      return $this->render('update', [
              'model' => $model,
      ]);
    }
  }

  /**
   * Deletes an existing Lesson model.
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
   * Export Lesson information into PDF format.
   * @param integer $id
   * @return mixed
   */
  public function actionPdf($id)
  {
    $model = $this->findModel($id);
    $providerLessonPresence = new \yii\data\ArrayDataProvider([
        'allModels' => $model->lessonPresences,
    ]);

    $content = $this->renderAjax('_pdf', [
        'model' => $model,
        'providerLessonPresence' => $providerLessonPresence,
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
   * Creates a new Lesson model by another data,
   * so user don't need to input all field from scratch.
   * If creation is successful, the browser will be redirected to the 'view' page.
   *
   * @param type $id
   * @return type
   */
  public function actionSaveAsNew($id)
  {
    $model = new Lesson();

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
   * Finds the Lesson model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return Lesson the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = Lesson::findOne($id)) !== null) {
      return $model;
    } else {
      throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
  }

  /**
   * Action to load a tabular form grid
   * for LessonPresence
   * @author Yohanes Candrajaya <moo.tensai@gmail.com>
   * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
   *
   * @return mixed
   */
  public function actionAddLessonPresence()
  {
    if (Yii::$app->request->isAjax) {
      $row = Yii::$app->request->post('LessonPresence');
      if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
        $row[] = [];
      return $this->renderAjax('_formLessonPresence', ['row' => $row]);
    } else {
      throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
  }

  public function actionGenerateLessons($id)
  {
    $training = \app\models\db\Training::findOne($id);
    if (!$training) {
      $this->throw404();
    }

    $model = new Lesson();
    $model->scenario = 'generate';
    $model->training_id = $id;

    if ($model->loadAll(Yii::$app->request->post())) {
      $model->date_end = date('Y-m-d H:i:s', strtotime($model->date_start . ' +'.$model->generateHours.'hours'));
      if ($model->interval && $model->validate()) {

        if ($model->lessonsCount > 100) {
          $model->lessonsCount = 100;
        }
        for ($i = 0; $i < $model->lessonsCount; $i++) {
          $newModel = clone $model;
          $newModel->date_start = date('Y-m-d H:i:s', strtotime($newModel->date_start . ' +' . ($i * $newModel->interval) . 'days'));
          $newModel->date_end = date('Y-m-d H:i:s', strtotime($newModel->date_start . ' +'.$model->generateHours.'hours'));
          $newModel->save();
        }
      }

      $this->redirect(['oeiizk/training/update', 'id' => $id]);
    } else {
      return $this->render('generateLessons', [
              'model' => $model,
      ]);
    }
  }

}
