<?php

namespace app\models\db;

use Yii;
use app\components\mgcms\MgHelpers;

/**
 * This is the base model class for table "educational_level".
 *
 * @property integer $id
 * @property string $name
 * @property integer $is_deleted
 */
class EducationalLevel extends \app\models\mgcms\db\AbstractRecord
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 245],
            [['is_deleted'], 'string', 'max' => 1]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'educational_level';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\mgcms\db\EducationalLevelQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\db\EducationalLevelQuery(get_called_class());
    }
}
