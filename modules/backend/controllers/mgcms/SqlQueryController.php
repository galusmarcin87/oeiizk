<?php
namespace app\modules\backend\controllers\mgcms;

use Yii;
use app\models\mgcms\db\SqlQuery;
use app\models\mgcms\db\SqlQuerySearch;
use app\components\mgcms\MgCmsController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SqlQueryController implements the CRUD actions for SqlQuery model.
 */
class SqlQueryController extends MgCmsController
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
   * Lists all SqlQuery models.
   * @return mixed
   */
  public function actionIndex()
  {
    $searchModel = new SqlQuerySearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
    ]);
  }

  /**
   * Displays a single SqlQuery model.
   * @param integer $id
   * @return mixed
   */
  public function actionView($id, $hash = false, $execute = false)
  {
    if (!$hash) {
      \app\components\mgcms\MgHelpers::throw404();
    }
    $model = $this->findModel($id);
    if ($execute) {
      $command = Yii::$app->db->createCommand($model->query);
      if ($model->params) {
        $params = \yii\helpers\Json::decode($model->params);
        foreach ($params as $name => $value) {
          if (!is_array($value)) {
            $command->bindValue($name, $value);
          } else {
            \app\components\mgcms\MgHelpers::setFlashError(Yii::t('app', 'Params error - should be array of key -> values'));
          }
        }
      }

      try {
         if(substr_count(strtolower($command->rawSql), 'select')>0){
           $result = $command->queryAll();
         }else{
           $result = $command->execute();
           \app\components\mgcms\MgHelpers::setFlashSuccess('Komenda wykonana poprawnie');
           return  $this->back();
         }
        
       
            } catch (yii\db\Exception $e) {
        \app\components\mgcms\MgHelpers::setFlashError(Yii::t('app', 'Query error') . ': ' . $e->getMessage());
      }
    }
    return $this->render('view', [
            'model' => $this->findModel($id),
            'result' => $execute && isset($result) ? $result : false
    ]);
  }

  /**
   * Creates a new SqlQuery model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
   */
  public function actionCreate()
  {
    $model = new SqlQuery();

    if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
      return $this->redirect(['view', 'id' => $model->id, 'hash' => $model->hash]);
    } else {
      return $this->render('create', [
              'model' => $model,
      ]);
    }
  }

  /**
   * Updates an existing SqlQuery model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id
   * @return mixed
   */
  public function actionUpdate($id)
  {
    if (Yii::$app->request->post('_asnew') == '1') {
      $model = new SqlQuery();
    } else {
      $model = $this->findModel($id);
    }

    if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
      return $this->redirect(['view', 'id' => $model->id, 'hash' => $model->hash]);
    } else {
      return $this->render('update', [
              'model' => $model,
      ]);
    }
  }

  /**
   * Deletes an existing SqlQuery model.
   * If deletion is successful, the browser will be redirected to the 'index' page.
   * @param integer $id
   * @return mixed
   */
  public function actionDelete($id)
  {
    $this->findModel($id)->deleteWithRelated();

    return $this->redirect(['index']);
  }

  /**
   * Creates a new SqlQuery model by another data,
   * so user don't need to input all field from scratch.
   * If creation is successful, the browser will be redirected to the 'view' page.
   *
   * @param type $id
   * @return type
   */
  public function actionSaveAsNew($id)
  {
    $model = new SqlQuery();

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
   * Finds the SqlQuery model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return SqlQuery the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = SqlQuery::findOne($id)) !== null) {
      return $model;
    } else {
      throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
  }
  
  /**
    * Action to load a tabular form grid
    * for SqlQueryUser
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddSqlQueryUser()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('SqlQueryUser');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formSqlQueryUser', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }
}
