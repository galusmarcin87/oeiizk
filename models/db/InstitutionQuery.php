<?php

namespace app\models\db;

/**
 * This is the ActiveQuery class for [[Institution]].
 *
 * @see Institution
 */
class InstitutionQuery extends \yii\db\ActiveQuery
{
  use \app\models\mgcms\db\SoftDeleteTrait; 
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Institution[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Institution|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}