<?php

namespace app\models\mgcms\db;
use app\components\mgcms\MgHelpers;

/**
 * This is the ActiveQuery class for [[\app\models\mgcms\db\UserSubject]].
 *
 * @see \app\models\mgcms\db\UserSubject
 */
class UserSubjectQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\mgcms\db\UserSubject[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\mgcms\db\UserSubject|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}