<?php
namespace app\models\mgcms\db;

use Yii;
use \yii\helpers\Html;

/**
 * This is the base model class for table "log".
 *
 * @property integer $id
 * @property integer $created_by
 * @property string $created_on
 * @property string $type
 * @property string $text
 * @property string $htmlText
 *
 * @property \app\models\mgcms\db\User $createdBy
 */
class Log extends \app\models\mgcms\db\AbstractRecord
{

  use \app\components\mgcms\RelationTrait;

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
        [['created_by'], 'integer'],
        [['created_on'], 'safe'],
        [['text'], 'string'],
        [['type'], 'string', 'max' => 245]
    ];
  }

  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'log';
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
        'id' => Yii::t('app', 'ID'),
        'created_on' => Yii::t('app', 'Created On'),
        'type' => Yii::t('app', 'Type'),
        'text' => Yii::t('app', 'Text'),
        'htmlText' => Yii::t('app', 'Text'),
    ];
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getCreatedBy()
  {
    return $this->hasOne(\app\models\mgcms\db\User::className(), ['id' => 'created_by']);
  }

  /**
   * @inheritdoc
   * @return \app\models\mgcms\db\LogQuery the active query used by this AR class.
   */
  public static function find()
  {
    return new \app\models\mgcms\db\LogQuery(get_called_class());
  }

  /**
   * 
   * @param string $status
   * @param \app\models\LoginForm $loginFormModel
   */
  public static function addLogin($status, $loginFormModel)
  {
    $model = new Log;
    $model->type = 'login_' . $status;
    $model->text = \yii\helpers\Json::encode([
            'username' => $loginFormModel->username,
            'ip' => Yii::$app->request->remoteIP
    ]);
    $model->save();
  }

  public function getHtmlText()
  {
    try {
      $arr = \yii\helpers\Json::decode($this->text);
    } catch (yii\base\InvalidArgumentException $e) {
      $arr = [];
    }
    return '<pre>' . print_r($arr, true) . '</pre>';
  }

  public static function logError($category, $exceptionModel)
  {
    $model = new Log;
    $model->type = 'error_' . $category;
    $model->text = \yii\helpers\Json::encode($exceptionModel);

    if($exceptionModel instanceof yii\web\NotFoundHttpException){
      return true;
    }
    if ($exceptionModel instanceof \Exception) {
      $errorModel = [];
      $errorModel['code'] = $exceptionModel->getCode();
      $errorModel['message'] = $exceptionModel->getMessage();
      $errorModel['file'] = $exceptionModel->getFile();
      $errorModel['line'] = $exceptionModel->getLine();
      $errorModel['trace'] = $exceptionModel->getTraceAsString();
      $model->text = \yii\helpers\Json::encode($errorModel);
    }

    if ($exceptionModel instanceof \Error) {
      $errorModel = [];
      $errorModel['code'] = $exceptionModel->getCode();
      $errorModel['message'] = $exceptionModel->getMessage();
      $errorModel['file'] = $exceptionModel->getFile();
      $errorModel['line'] = $exceptionModel->getLine();
      $errorModel['trace'] = $exceptionModel->getTraceAsString();
      $model->text = \yii\helpers\Json::encode($errorModel);
    }
    $saved = $model->save();
  }
}
