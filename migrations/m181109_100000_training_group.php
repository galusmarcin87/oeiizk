<?php
use yii\db\Migration;

class m181109_100000_training_group extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {
    $this->execute("ALTER TABLE `training`
	ADD COLUMN `group_id` INT(11) NULL DEFAULT NULL AFTER `price_category`,
	ADD INDEX `group_id` (`group_id`),
	ADD CONSTRAINT `fk_training_group1` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON UPDATE NO ACTION ON DELETE SET NULL
");
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
