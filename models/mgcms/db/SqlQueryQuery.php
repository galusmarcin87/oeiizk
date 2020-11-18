<?php
namespace app\models\mgcms\db;

/**
 * This is the ActiveQuery class for [[SqlQuery]].
 *
 * @see SqlQuery
 */
class SqlQueryQuery extends \yii\db\ActiveQuery
{
  use SoftDeleteTrait;
  /* public function active()
    {
    $this->andWhere('[[status]]=1');
    return $this;
    } */

  /**
   * @inheritdoc
   * @return SqlQuery[]|array
   */
  public function all($db = null)
  {
    return parent::all($db);
  }

  /**
   * @inheritdoc
   * @return SqlQuery|array|null
   */
  public function one($db = null)
  {
    return parent::one($db);
  }
}
