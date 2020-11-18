<?php

namespace app\models\db;

/**
 * This is the ActiveQuery class for [[TrainingTemplate]].
 *
 * @see TrainingTemplate
 */
class TrainingTemplateQuery extends \yii\db\ActiveQuery
{
  use \app\models\mgcms\db\SoftDeleteTrait;
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return TrainingTemplate[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TrainingTemplate|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}