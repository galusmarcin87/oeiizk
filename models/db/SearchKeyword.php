<?php

namespace app\models\db;

use Yii;

/**
 * This is the base model class for table "search_keyword".
 *
 * @property integer $id
 * @property string $keyword
 * @property string $created_on
 */
class SearchKeyword extends \app\models\mgcms\db\AbstractRecord
{
    use \app\components\mgcms\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['keyword'], 'required'],
            [['keyword'], 'string', 'max' => 245],
            [['created_on'], 'safe'],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'search_keyword';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'keyword' => Yii::t('app', 'Słowa kluczowe'),
            'created_on' => Yii::t('app', 'Created On'),
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\db\SearchKeywordQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\db\SearchKeywordQuery(get_called_class());
    }
}
