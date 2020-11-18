<?php

namespace app\models\mgcms\db;

/**
 * This is the ActiveQuery class for [[Category]].
 *
 * @see Category
 */
class CategoryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Category[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Category|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
    public function training(){
      return $this->andWhere(['type'=> Category::TYPE_TRAINING]);
    }
    
    public function withoutParent(){
      return $this->andWhere(['parent_id'=> null]);
    }
    
    public function withParent(){
      return $this->andWhere(['not',['parent_id'=> null]]);
    }
}