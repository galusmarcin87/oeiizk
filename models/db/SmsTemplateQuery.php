<?php
namespace app\models\db;

/**
 * This is the ActiveQuery class for [[SmsTemplate]].
 *
 * @see SmsTemplate
 */
class SmsTemplateQuery extends \yii\db\ActiveQuery
{

  use \app\models\mgcms\db\SoftDeleteTrait;
  /* public function active()
    {
    $this->andWhere('[[status]]=1');
    return $this;
    } */

  /**
   * @inheritdoc
   * @return SmsTemplate[]|array
   */
  public function all($db = null)
  {
    return parent::all($db);
  }

  /**
   * @inheritdoc
   * @return SmsTemplate|array|null
   */
  public function one($db = null)
  {
    return parent::one($db);
  }
}
