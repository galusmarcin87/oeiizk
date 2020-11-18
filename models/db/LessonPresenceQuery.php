<?php

namespace app\models\db;

/**
 * This is the ActiveQuery class for [[LessonPresence]].
 *
 * @see LessonPresence
 */
class LessonPresenceQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return LessonPresence[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return LessonPresence|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}