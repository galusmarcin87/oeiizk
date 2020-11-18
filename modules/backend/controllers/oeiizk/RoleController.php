<?php
namespace app\modules\backend\controllers\oeiizk;

use Yii;
use app\models\db\Role;
use app\models\db\RoleSearch;
use app\modules\backend\components\mgcms\MgBackendController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RoleController implements the CRUD actions for Role model.
 */
class RoleController extends MgBackendController
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
   * Lists all Role models.
   * @return mixed
   */
  public function actionIndex()
  {
    $searchModel = new RoleSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
    ]);
  }

  /**
   * Displays a single Role model.
   * @param integer $id
   * @return mixed
   */
  public function actionView($id)
  {
    $model = $this->findModel($id);
    $providerUserRole = new \yii\data\ArrayDataProvider([
        'allModels' => $model->userRoles,
    ]);
    return $this->render('view', [
            'model' => $this->findModel($id),
            'providerUserRole' => $providerUserRole,
    ]);
  }

  /**
   * Creates a new Role model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
   */
  public function actionCreate()
  {
    $model = new Role();

    if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
      Yii::$app->cache->flush();
      return $this->redirect(['view', 'id' => $model->id]);
    } else {
      return $this->render('create', [
              'model' => $model,
      ]);
    }
  }

  /**
   * Updates an existing Role model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id
   * @return mixed
   */
  public function actionUpdate($id)
  {
    if (Yii::$app->request->post('_asnew') == '1') {
      $model = new Role();
    } else {
      $model = $this->findModel($id);
    }

    if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
      Yii::$app->cache->flush();
      return $this->redirect(['view', 'id' => $model->id]);
    } else {
      return $this->render('update', [
              'model' => $model,
      ]);
    }
  }

  /**
   * Deletes an existing Role model.
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
   * Export Role information into PDF format.
   * @param integer $id
   * @return mixed
   */
  public function actionPdf($id)
  {
    $model = $this->findModel($id);
    $providerUserRole = new \yii\data\ArrayDataProvider([
        'allModels' => $model->userRoles,
    ]);

    $content = $this->renderAjax('_pdf', [
        'model' => $model,
        'providerUserRole' => $providerUserRole,
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
   * Creates a new Role model by another data,
   * so user don't need to input all field from scratch.
   * If creation is successful, the browser will be redirected to the 'view' page.
   *
   * @param type $id
   * @return type
   */
  public function actionSaveAsNew($id)
  {
    $model = new Role();

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
   * Finds the Role model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return Role the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = Role::findOne($id)) !== null) {
      return $model;
    } else {
      throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
  }

  /**
   * Action to load a tabular form grid
   * for UserRole
   * @author Yohanes Candrajaya <moo.tensai@gmail.com>
   * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
   *
   * @return mixed
   */
  public function actionAddUserRole()
  {
    if (Yii::$app->request->isAjax) {
      $row = Yii::$app->request->post('UserRole');
      if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
        $row[] = [];
      return $this->renderAjax('_formUserRole', ['row' => $row]);
    } else {
      throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
  }
}
