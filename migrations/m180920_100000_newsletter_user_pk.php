<?php
use yii\db\Migration;


class m180920_100000_newsletter_user_pk extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->execute("ALTER TABLE `newsletter_user`
	ADD COLUMN `id` INT(11) NOT NULL FIRST,
	CHANGE COLUMN `user_id` `user_id` INT(11) NULL DEFAULT '0' AFTER `newsletter_id`,
	DROP PRIMARY KEY,
	ADD PRIMARY KEY (`id`);
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
