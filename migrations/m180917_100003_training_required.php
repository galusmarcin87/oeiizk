<?php
use yii\db\Migration;


class m180917_100003_training_required extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->execute("ALTER TABLE `training_required`
	DROP FOREIGN KEY `fk_training_template_has_training_training_template1`;
ALTER TABLE `training_required`
	ALTER `training_template_id` DROP DEFAULT;

");
    
    $this->execute("ALTER TABLE `training_required`
	CHANGE COLUMN `training_template_id` `training_2_id` INT(11) NOT NULL FIRST,
	ADD CONSTRAINT `fk_training_template_has_training_training_template1` FOREIGN KEY (`training_2_id`) REFERENCES `training` (`id`) ON UPDATE NO ACTION ON DELETE CASCADE;
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
