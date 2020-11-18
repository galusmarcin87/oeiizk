<?php

namespace app\models\db;

/**
 * This is the ActiveQuery class for [[UserPassword]].
 *
 * @see UserPassword
 */
class UserPasswordQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return UserPassword[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return UserPassword|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}