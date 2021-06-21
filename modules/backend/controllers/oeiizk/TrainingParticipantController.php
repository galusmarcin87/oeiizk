<?php

namespace app\modules\backend\controllers\oeiizk;

use app\components\mgcms\OeiizkHelpers;
use Yii;
use app\models\db\TrainingParticipant;
use app\models\db\TrainingParticipantSearch;
use app\modules\backend\components\mgcms\MgBackendController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\mgcms\MgHelpers;

/**
 * TrainingParticipantController implements the CRUD actions for TrainingParticipant model.
 */
class TrainingParticipantController extends MgBackendController
{

    public $importClass = 'app\models\mgcms\db\User';

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
     * Lists all TrainingParticipant models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TrainingParticipantSearch();
        if (OeiizkHelpers::isRole(\app\models\mgcms\db\User::ROLE_LECTOR)) {
            $searchModel->trainingCreatedById = $this->getUserModel()->id;
        }
        $queryParams = Yii::$app->request->queryParams;
        $dataProvider = $searchModel->search($queryParams);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TrainingParticipant model.
     * @param integer $training_id
     * @param integer $user_id
     * @return mixed
     */
    public function actionView($training_id, $user_id)
    {
        $model = $this->findModel($training_id, $user_id);
        return $this->render('view', [
            'model' => $this->findModel($training_id, $user_id),
        ]);
    }

    /**
     * Creates a new TrainingParticipant model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($trainingId = false)
    {
        $model = new TrainingParticipant();
        if($trainingId){
            $model->training_id = $trainingId;
        }

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'training_id' => $model->training_id, 'user_id' => $model->user_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TrainingParticipant model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $training_id
     * @param integer $user_id
     * @return mixed
     */
    public function actionUpdate($training_id, $user_id)
    {
        $model = $this->findModel($training_id, $user_id);

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'training_id' => $model->training_id, 'user_id' => $model->user_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TrainingParticipant model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $training_id
     * @param integer $user_id
     * @return mixed
     */
    public function actionDelete($training_id, $user_id)
    {
        $this->findModel($training_id, $user_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     *
     * Export TrainingParticipant information into PDF format.
     * @param integer $training_id
     * @param integer $user_id
     * @return mixed
     */
    public function actionPdf($training_id, $user_id)
    {
        $model = $this->findModel($training_id, $user_id);

        $content = $this->renderAjax('_pdf', [
            'model' => $model,
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
     * Finds the TrainingParticipant model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $training_id
     * @param integer $user_id
     * @return TrainingParticipant the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($training_id, $user_id)
    {
        if (($model = TrainingParticipant::findOne(['training_id' => $training_id, 'user_id' => $user_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }
}
