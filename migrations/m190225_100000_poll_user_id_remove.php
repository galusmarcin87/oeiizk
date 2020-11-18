<?php
use yii\db\Migration;

class m190225_100000_poll_user_id_remove extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->execute('ALTER TABLE `pol_question_answer`	DROP FOREIGN KEY `fk_poll_poll_question_has_user_user1`');

    

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
