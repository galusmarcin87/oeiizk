<?php
namespace app\modules\backend\controllers\mgcms;

use Yii;
use app\models\mgcms\db\Setting;
use \app\models\mgcms\db\SettingSearch;
use yii\data\ActiveDataProvider;
use app\modules\backend\components\mgcms\MgBackendController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\FileHelper;
use \app\components\mgcms\MgHelpers;
use app\models\mgcms\db\User;

/**
 * SettingController implements the CRUD actions for Setting model.
 */
class SettingController extends MgBackendController
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
   * Lists all Setting models.
   * @return mixed
   */
  public function actionIndex()
  {
    $searchModel = new SettingSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    $this->initEditableBehavior('app\models\mgcms\db\Setting');

    return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
    ]);
  }

  /**
   * Displays a single Setting model.
   * @param integer $id
   * @return mixed
   */
  public function actionView($id)
  {
    $model = $this->findModel($id);
    return $this->render('view', [
            'model' => $this->findModel($id),
    ]);
  }

  /**
   * Creates a new Setting model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
   */
  public function actionCreate()
  {
    $model = new Setting();

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
   * Updates an existing Setting model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id
   * @return mixed
   */
  public function actionUpdate($id)
  {
    $model = $this->findModel($id);

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
   * Deletes an existing Setting model.
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
   * Finds the Setting model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return Setting the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = Setting::findOne($id)) !== null) {
      return $model;
    } else {
      throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
  }

  public function actionClearCache()
  {
    FileHelper::removeDirectory(Yii::getAlias('@webroot') . '/assets');
    FileHelper::createDirectory(Yii::getAlias('@webroot') . '/assets');
    Yii::$app->cache->flush();
    MgHelpers::setFlash(MgHelpers::FLASH_TYPE_SUCCESS, Yii::t('app', 'Cache has been cleared'));

    $this->back();
  }

  public function actionBackup()
  {
    /* @var $backup \demi\backup\Component */
    $backup = \Yii::$app->backup;


    $date = date('YmdHis');
    mkdir(Yii::getAlias('@app') . '/backups/' . $date);
    $backup->backupDatabase(Yii::getAlias('@app') . '/backups/' . $date);
    $file = $backup->create();

    MgHelpers::setFlashSuccess('Backup utworzony w foderze backups');
    $this->back();
  }

  public function actionArchive()
  {
    if (Yii::$app->request->post()) {
      /* @var $backup \demi\backup\Component */
      $backup = \Yii::$app->backup;
      $date = date('YmdHis');
      mkdir(Yii::getAlias('@app') . '/backups/' . $date);
      $backup->backupDatabase(Yii::getAlias('@app') . '/backups/' . $date);

      $transaction = Yii::$app->db->beginTransaction();
      try {
        Yii::$app->db->createCommand()->truncateTable('log')->execute();
        User::deleteAll(['<','last_login',new \yii\db\Expression('NOW() - INTERVAL 1 YEAR')]);
        \app\models\db\Training::deleteAll();
        \app\models\db\TrainingTemplate::deleteAll();
        $transaction->commit();
        MgHelpers::setFlashSuccess('Archiwizacja przebiegłą pomyślnie');
      } catch (\Exception $e) {
        $transaction->rollBack();
        MgHelpers::setFlashSuccess('Archiwizacja przebiegłą błędnie, stan bazy został przywrócony');
        throw $e;
      } catch (\Throwable $e) {
        $transaction->rollBack();
        MgHelpers::setFlashSuccess('Archiwizacja przebiegłą błędnie, stan bazy został przywrócony');
        throw $e;
      }
    }
    return $this->render('archive');
  }
}
