<?php
namespace app\models\mgcms\db;

use Yii;
use app\components\mgcms\MgHelpers;

/**
 * This is the base model class for table "modification_history".
 *
 * @property integer $id
 * @property string $created_on
 * @property integer $created_by
 * @property string $model_class
 * @property integer $model_id
 * @property string $previous_model
 * @property string $model
 *
 * @property \app\models\mgcms\db\User $createdBy
 */
class ModificationHistory extends \app\models\mgcms\db\AbstractRecord
{

  const DISABLED_ATTRIBUTES_DIFF = ['updated_on', 'created_on', 'id', 'created_by', 'updated_by', 'slug'];
  use \app\components\mgcms\RelationTrait;

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
        [['created_on'], 'safe'],
        [['created_by'], 'required'],
        [['created_by', 'model_id'], 'integer'],
        [['previous_model', 'model'], 'string'],
        [['model_class'], 'string', 'max' => 245]
    ];
  }

  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'modification_history';
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
        'id' => Yii::t('app', 'ID'),
        'created_on' => Yii::t('app', 'Created On'),
        'model_class' => Yii::t('app', 'Model Class'),
        'model_id' => Yii::t('app', 'Model ID'),
        'previous_model' => Yii::t('app', 'Previous Model'),
        'model' => Yii::t('app', 'Model'),
        'diff' => Yii::t('app', 'Differences'),
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
   * @return \app\models\mgcms\db\ModificationHistoryQuery the active query used by this AR class.
   */
  public static function find()
  {
    return new \app\models\mgcms\db\ModificationHistoryQuery(get_called_class());
  }

  public function getDiff()
  {
    $model = new $this->model_class;
    $model->attributes = unserialize($this->model);
    $previousModel = new $this->model_class;
    $previousModel->attributes = unserialize($this->previous_model);

    $str = '';
    foreach ($model->getAttributes() as $field => $value) {

      if (in_array($field, self::DISABLED_ATTRIBUTES_DIFF)) {
        continue;
      }

      $previousValue = $previousModel->getAttribute($field);

      if ($value != $previousValue) {
        $modelField = false;
        if (preg_match('/.*_id$/', $field)) {
          $field = str_replace('_id', '', $field);
          $field = MgHelpers::camelize($field);
          $modelField = true;
        }



        $previousValue = $modelField ? $previousModel->$field : $previousValue;
        $value = $modelField ? $model->$field : $value;
        $str .= '<p>' . $model->getAttributeLabel($field) . ': <div class="redLightBgDiff">&nbsp; ' . $previousValue . ' </div> -> <div class="greenLightBgDiff">&nbsp; ' . $value . ' </div></p>';
      }
    }
    return $str;
  }
}
