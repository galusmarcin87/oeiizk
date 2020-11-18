<?php
use yii\db\Migration;


class m180914_100001_event_type extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->execute("ALTER TABLE `event`
	CHANGE COLUMN `type` `type` VARCHAR(50) NULL DEFAULT NULL;");
    

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
