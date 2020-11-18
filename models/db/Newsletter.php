<?php
namespace app\models\db;

use Yii;

/**
 * This is the base model class for table "newsletter".
 *
 * @property integer $id
 * @property string $name
 * @property string $created_on
 * @property integer $created_by
 * @property string $header
 * @property string $footer
 * @property string $text
 * @property integer $add_incoming_training_info
 * @property string $status
 * @property integer $group_id
 * @property integer $is_deleted
 * @property string $keywords
 * @property string $date_sent
 * @property integer $is_required_answer
 *
 * @property \app\models\db\Group $group
 * @property \app\models\mgcms\db\User $createdBy
 * @property \app\models\db\NewsletterUser[] $newsletterUsers
 * @property \app\models\mgcms\db\User[] $users
 */
class Newsletter extends \app\models\mgcms\db\AbstractRecord
{

  use \app\components\mgcms\RelationTrait;
  use \app\models\mgcms\db\SoftDeleteTrait;

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
        [['created_on', 'date_sent'], 'safe'],
        [['created_by', 'group_id'], 'integer'],
        [['header', 'footer', 'text', 'keywords'], 'string'],
        [['name'], 'string', 'max' => 245],
        [['add_incoming_training_info', 'is_deleted', 'is_required_answer'], 'integer', 'max' => 1],
        [['status'], 'string', 'max' => 45]
    ];
  }

  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'newsletter';
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
        'id' => Yii::t('app', 'ID'),
        'name' => Yii::t('app', 'Name'),
        'created_on' => Yii::t('app', 'Created On'),
        'header' => Yii::t('app', 'Nagłówek'),
        'footer' => Yii::t('app', 'Stopka'),
        'text' => Yii::t('app', 'Text'),
        'add_incoming_training_info' => Yii::t('app', 'Add Incoming Training Info'),
        'status' => Yii::t('app', 'Status'),
        'group_id' => Yii::t('app', 'Group'),
        'is_deleted' => Yii::t('app', 'Is Deleted'),
        'keywords' => Yii::t('app', 'Keywords'),
        'date_sent' => Yii::t('app', 'Date Sent'),
        'is_required_answer' => Yii::t('app', 'Is Required Answer'),
    ];
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getGroup()
  {
    return $this->hasOne(\app\models\db\Group::className(), ['id' => 'group_id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getCreatedBy()
  {
    return $this->hasOne(\app\models\mgcms\db\User::className(), ['id' => 'created_by']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getNewsletterUsers()
  {
    return $this->hasMany(\app\models\db\NewsletterUser::className(), ['newsletter_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getUsers()
  {
    return $this->hasMany(\app\models\mgcms\db\User::className(), ['id' => 'user_id'])->viaTable('newsletter_user', ['newsletter_id' => 'id']);
  }

  public function getLinkUrl()
  {
    return \yii\helpers\Url::to(['newsletter/view', 'id' => $this->id]);
  }
  
  public function getLink()
  {
    return \yii\helpers\Html::a($this->name,$this->getLinkUrl());
  }
  
}
