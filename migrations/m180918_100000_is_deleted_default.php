<?php
use yii\db\Migration;


class m180918_100000_is_deleted_default extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->execute("ALTER TABLE `agreement`	CHANGE COLUMN `is_deleted` `is_deleted` TINYINT(1) NULL DEFAULT '0'");
    $this->execute("ALTER TABLE `institution`	CHANGE COLUMN `is_deleted` `is_deleted` TINYINT(1) NULL DEFAULT '0'");
    $this->execute("ALTER TABLE `lab`	CHANGE COLUMN `is_deleted` `is_deleted` TINYINT(1) NULL DEFAULT '0'");
    $this->execute("ALTER TABLE `lesson`	CHANGE COLUMN `is_deleted` `is_deleted` TINYINT(1) NULL DEFAULT '0'");
    
    
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
