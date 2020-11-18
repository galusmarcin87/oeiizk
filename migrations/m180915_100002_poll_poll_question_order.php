<?php
use yii\db\Migration;


class m180915_100002_poll_poll_question_order extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->addColumn('poll_poll_question', 'order', $this->integer(4));
    
  }

  /**
   * @inheritdoc
   */
  public function safeDown()
  {
    
  }
  /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
    echo "m171121_120201_user cannot be reverted.\n";

    return false;
    }
   */
}
