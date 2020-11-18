<?php
use yii\db\Migration;


class m180917_100000_training_template_is_certificate_issued extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->execute("ALTER TABLE `training_template`
	CHANGE COLUMN `is_certificate_issued` `is_certificate_issued` TINYINT(1) NULL;
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
