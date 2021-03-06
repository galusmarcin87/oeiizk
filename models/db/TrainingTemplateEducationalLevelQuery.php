<?php

namespace app\models\db;
use app\components\mgcms\MgHelpers;

/**
 * This is the ActiveQuery class for [[TrainingTemplateEducationalLevel]].
 *
 * @see TrainingTemplateEducationalLevel
 */
class TrainingTemplateEducationalLevelQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return TrainingTemplateEducationalLevel[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TrainingTemplateEducationalLevel|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}