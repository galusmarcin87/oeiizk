<?php

namespace app\modules\backend\controllers\oeiizk;

use Yii;
use app\models\db\WorkshopUser;
use app\models\db\WorkshopUserSearch;
use app\components\mgcms\MgCmsController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\mgcms\MgHelpers;

/**
 * WorkshopUserController implements the CRUD actions for WorkshopUser model.
 */
class WorkshopUserController extends MgCmsController
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
     * Lists all WorkshopUser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WorkshopUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single WorkshopUser model.
     * @param integer $user_id
     * @param integer $workshop_id
     * @return mixed
     */
    public function actionView($user_id, $workshop_id)
    {
        $model = $this->findModel($user_id, $workshop_id);
        return $this->render('view', [
            'model' => $this->findModel($user_id, $workshop_id),
        ]);
    }

    /**
     * Creates a new WorkshopUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new WorkshopUser();

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'user_id' => $model->user_id, 'workshop_id' => $model->workshop_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing WorkshopUser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $user_id
     * @param integer $workshop_id
     * @return mixed
     */
    public function actionUpdate($user_id, $workshop_id)
    {
        if (Yii::$app->request->post('_asnew') == '1') {
            $model = new WorkshopUser();
        }else{
            $model = $this->findModel($user_id, $workshop_id);
        }

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'user_id' => $model->user_id, 'workshop_id' => $model->workshop_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing WorkshopUser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $user_id
     * @param integer $workshop_id
     * @return mixed
     */
    public function actionDelete($user_id, $workshop_id)
    {
        $this->findModel($user_id, $workshop_id)->delete();

        return $this->redirect(['index']);
    }
    
    /**
     * 
     * Export WorkshopUser information into PDF format.
     * @param integer $user_id
     * @param integer $workshop_id
     * @return mixed
     */
    public function actionPdf($user_id, $workshop_id) {
        $model = $this->findModel($user_id, $workshop_id);

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
    * Creates a new WorkshopUser model by another data,
    * so user don't need to input all field from scratch.
    * If creation is successful, the browser will be redirected to the 'view' page.
    *
    * @param type $id
    * @return type
    */
    public function actionSaveAsNew($user_id, $workshop_id) {
        $model = new WorkshopUser();

        if (Yii::$app->request->post('_asnew') != '1') {
            $model = $this->findModel($user_id, $workshop_id);
        }
    
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'user_id' => $model->user_id, 'workshop_id' => $model->workshop_id]);
        } else {
            return $this->render('saveAsNew', [
                'model' => $model,
            ]);
        }
    }
    
    /**
     * Finds the WorkshopUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $user_id
     * @param integer $workshop_id
     * @return WorkshopUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($user_id, $workshop_id)
    {
        if (($model = WorkshopUser::findOne(['user_id' => $user_id, 'workshop_id' => $workshop_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }
}
