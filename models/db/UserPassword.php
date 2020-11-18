<?php

namespace app\models\db;

use Yii;

/**
 * This is the base model class for table "user_password".
 *
 * @property integer $id
 * @property string $created_on
 * @property integer $user_id
 * @property string $password
 *
 * @property app\models\mgcms\db\User $user
 */
class UserPassword extends \app\models\mgcms\db\AbstractRecord
{
    use \app\components\mgcms\RelationTrait;
    const PASSWORD_STORED_COUNT = 5;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_on'], 'safe'],
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['password'], 'string', 'max' => 255],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_password';
    }

  

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'created_on' => Yii::t('app', 'Created On'),
            'user_id' => Yii::t('app', 'User ID'),
            'password' => Yii::t('app', 'Password'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\app\models\mgcms\db\User::className(), ['id' => 'user_id']);
    }
    
    /**
     * @inheritdoc
     * @return app\models\mgcms\db\UserPasswordQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserPasswordQuery(get_called_class());
    }
    
    public static function clearTooOldPassword($user_id){
      $passwords = self::find()->where(['user_id' => $user_id])->orderBy('created_on DESC')->all();
      foreach($passwords as $index => $password){
        if($index + 1 > self::PASSWORD_STORED_COUNT){
          $password->delete();
        }
      }

    
    }
}
