<?php
namespace app\modules\backend\components\mgcms;

use app\components\mgcms\MgCmsController;
use yii\filters\AccessControl;
use Yii;
use app\components\mgcms\MgHelpers;

/**
 * Default controller for the `backend` module
 */
class MgBackendController extends MgCmsController
{

  public $importClass = false;

  public function init()
  {
    parent::init();
    Yii::$app->user->loginUrl = '/backend/default/login';
    Yii::$app->homeUrl = '/admin';
  }

  public function behaviors()
  {
    return [
        'access' => [
            'class' => AccessControl::className(),
            'rules' => [
                [
                    'allow' => true,
                    'actions' => ['login', 'signup'],
                ],
                [
                    'allow' => true,
//                    'actions' => ['login', 'signup'],
                    'roles' => ['@'],
                ],
                [
                    'allow' => true,
//                    'actions' => ['*'],
                    'roles' => ['*'],
                ],
            ]
        ],
    ];
  }

  public function beforeAction($action)
  {

    if ($this->getUserModel()) {
      if (!$this->getUserModel()->checkAccess(str_replace(['mgcms/', 'oeizk/'], '', Yii::$app->controller->id),
              Yii::$app->controller->action->id)) {
        throw new \yii\web\HttpException(403);
      }
    }
    $actionController = Yii::$app->controller->id . '/' . Yii::$app->controller->action->id;
    if (!$this->getUserModel() && !in_array($actionController, [
            'default/login',
            'default/index'
        ])) {
      $this->redirect(['/backend/default']);
      return;
    }


    return parent::beforeAction($action);
  }

  public function initEditableBehavior($className)
  {
    if (Yii::$app->request->post('hasEditable')) {
      $model = new $className;
      $reflectionModel = new \ReflectionClass($model);
      $modelFullClass = $reflectionModel->getName();
      $modelClass = $reflectionModel->getShortName();
      $model = $modelFullClass::findOne(Yii::$app->request->post('editableKey'));
      $post = [];
      $posted = current($_POST[$modelClass]);
      $post[$modelClass] = $posted;
      if ($model->load($post)) {
        if ($model->save()) {
          if (preg_match('/.*Setting/', $model::className())) {
            Yii::$app->cache->flush();
          }
          $out = \yii\helpers\Json::encode(['output' => $model->{Yii::$app->request->post('editableAttribute')}, 'message' => '']);
        }
      }
      echo $out;
      die;
    }
  }

  public function actionHistory($id)
  {
    $model = $this->findModel($id);
    $this->redirect(['mgcms/modification-history/index', 'id' => $id, 'modelClass' => $model::className()]);
  }

  public function actionImport()
  {
    if (!$this->importClass) {
      MgHelpers::setFlashError(Yii::t('app', 'importClass not configured'));
    }
    $modelImport = new \yii\base\DynamicModel([
        'fileImport' => 'File Import',
    ]);
    $modelImport->addRule(['fileImport'], 'required');
    $modelImport->addRule(['fileImport'], 'file', ['extensions' => 'ods,xls,xlsx'], ['maxSize' => 1024 * 1024]);
    Yii::$app->session['similarUsers'] = [];

    $errString = false;
    if (Yii::$app->request->post() && $this->importClass) {
      $modelImport->fileImport = \yii\web\UploadedFile::getInstance($modelImport, 'fileImport');
      if ($modelImport->fileImport && $modelImport->validate()) {
        $inputFileType = \PHPExcel_IOFactory::identify($modelImport->fileImport->tempName);
        $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($modelImport->fileImport->tempName);
        $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
        $attributes = [];
        foreach ($sheetData[1] as $col => $attribute) {
          $attributes[$col] = $attribute;
        }
        $baseRow = 2;
        if (empty($sheetData[$baseRow]['A'])) {
          MgHelpers::setFlashError('Brak danych');
          return $this->back();
        }
        while (!empty($sheetData[$baseRow]['A'])) {
          /* @var $model \app\models\mgcms\db\AbstractRecord */
          $model = new $this->importClass;
          foreach ($attributes as $col => $attribute) {
            if ($model->hasAttribute($attribute)) {
              $model->setAttribute($attribute, (string) $sheetData[$baseRow][$col]);
            }
            if (isset($model->$attribute)) {
              $model->$attribute = (string) $sheetData[$baseRow][$col];
            }
          }
          if ($model instanceof \app\models\mgcms\db\User) {
            $model = $this->importUser($model);
          }

          $saved = $model->save();
          if (!$saved) {
            $errString .= MgHelpers::getErrorsString($model->getErrors()) . '<br/>';
          }

          if ($saved && $model instanceof \app\models\mgcms\db\User) {
            if(!$model->importUserId){
              $this->storeSimilarUsers($model);
            }
            $this->importUserAfterSave($model);
          }

          $baseRow++;
        }
        if ($errString) {
          Yii::$app->getSession()->setFlash('error', 'Błedy importu: ' . $errString);
          \app\models\mgcms\db\Log::logError('import', $errString);
        } else {
          Yii::$app->getSession()->setFlash('success', 'Success');
        }
      } else {
        Yii::$app->getSession()->setFlash('error', 'Error');
      }
    }

    if (sizeof(Yii::$app->session['similarUsers']) > 0) {
      return $this->redirect('/backend/mgcms/user/similar-users');
    }

    return $this->render('/common/import',
            [
            'modelImport' => $modelImport,
            'importClass' => MgHelpers::getClassShortNameByName($this->importClass)
    ]);
  }

  /**
   * 
   * @param \app\models\mgcms\db\User $model
   * @return \app\models\mgcms\db\User
   */
  private function importUser($model)
  {
    if($model->importUserId){
      $model = \app\models\mgcms\db\User::findOne($model->importUserId);
      return $model;
    }
    
    $random = MgHelpers::generateRandomString();
    if (!$model->username) {
      $model->username = $random;
    }
    if (!$model->password) {
      $model->password = $random;
    }

    if ($model->username == $random && $model->email) {
      $parts = explode('@', $model->email);
      $model->username = $model->password = preg_replace("/[^a-z0-9]+/", "", $parts[0]);
    }

    $model->create_account_additional_data = (MgHelpers::isAdmin() ? 'Admin' : 'DOS') . ($model->create_account_additional_data ? ' - ' . $model->create_account_additional_data : '');
    $model->role = \app\models\mgcms\db\User::ROLE_USER;
    return $model;
  }

  /**
   * 
   * @param \app\models\mgcms\db\User $model
   * @return \app\models\mgcms\db\User
   */
  function importUserAfterSave($model)
  {
    if ($model->importTrainingIds) {
      $trainingIds = preg_split("/(,|\.)/", $model->importTrainingIds);
      if (sizeof($trainingIds) > 0) {
        foreach ($trainingIds as $trainingId) {
          $participant = new \app\models\db\TrainingParticipant;
          $participant->user_id = $model->id;
          $participant->training_id = $trainingId;
          $participant->status = 'zgłoszenie przez DOS';
          $participant->save();
        }
      }
    }
  }

  /**
   * 
   * @param \app\models\mgcms\db\User $model
   */
  private function storeSimilarUsers($model)
  {
    $similarUser = \app\models\mgcms\db\User::find()->andWhere([
                'first_name' => $model->first_name,
                'last_name' => $model->last_name,
                'birthdate' => $model->birthdate])->
            andWhere(['!=', 'id', $model->id])->one();
    if ($similarUser) {
      $model->status = \app\models\mgcms\db\User::STATUS_DUPLICATED;
      $model->save();
      Yii::$app->session['similarUsers'] = array_merge(Yii::$app->session['similarUsers'],
          [['new' => $model->id, 'old' => $similarUser->id]]);
    }
  }

  public function isRole($role)
  {
    return \app\components\mgcms\OeiizkHelpers::getCurrentBackendRole() == $role;
  }
}
