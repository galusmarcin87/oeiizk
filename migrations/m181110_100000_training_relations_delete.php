<?php
use yii\db\Migration;

class m181110_100000_training_relations_delete extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {
    $this->execute("ALTER TABLE `workshop` DROP FOREIGN KEY `fk_workshop_training1`");
    $this->execute("ALTER TABLE `workshop` ADD CONSTRAINT `fk_workshop_training1` FOREIGN KEY (`training_id`) REFERENCES `training` (`id`) ON UPDATE NO ACTION ON DELETE CASCADE");
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
