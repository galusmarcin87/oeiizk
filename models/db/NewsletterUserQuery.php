<?php

namespace app\models\db;

/**
 * This is the ActiveQuery class for [[NewsletterUser]].
 *
 * @see NewsletterUser
 */
class NewsletterUserQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return NewsletterUser[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return NewsletterUser|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}