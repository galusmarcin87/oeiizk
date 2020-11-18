<?php
use yii\db\Migration;


class m180922_100000_search_keyword_date extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->execute("ALTER TABLE `search_keyword`
	CHANGE COLUMN `created_on` `created_on` TIMESTAMP NULL DEFAULT NULL AFTER `keyword`;");
    
    
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
