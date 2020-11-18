<?php

namespace app\models\db;

/**
 * This is the ActiveQuery class for [[UserAgreement]].
 *
 * @see UserAgreement
 */
class UserAgreementQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return UserAgreement[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return UserAgreement|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}