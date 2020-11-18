<?php
use yii\db\Migration;

class m190601_100000_log_fk extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->execute("ALTER TABLE `log`	DROP FOREIGN KEY `fk_log_user1`");
    //$this->execute("ALTER TABLE `log`	ADD CONSTRAINT `fk_log_user1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON UPDATE NO ACTION ON DELETE SET NULL;");

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
