<?php

namespace app\models\mgcms\db\base;

use Yii;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "setting".
 *
 * @property integer $id
 * @property string $key
 * @property string $value
 * @property string $value_text
 */
class Setting extends \app\models\mgcms\db\AbstractRecord
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value', 'value_text'], 'string'],
            [['key'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'setting';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'key' => Yii::t('app', 'Key'),
            'value' => Yii::t('app', 'Value'),
            'value_text' => Yii::t('app', 'Value Text'),
        ];
    }

/**
     * @inheritdoc
     * @return array mixed
     */ 
    public function behaviors()
    {
        return [
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\mgcms\db\SettingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\mgcms\db\SettingQuery(get_called_class());
    }
}
