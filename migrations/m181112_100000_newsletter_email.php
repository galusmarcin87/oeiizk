<?php
use yii\db\Migration;

class m181112_100000_newsletter_email extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->createTable('newsletter_email', [
        'id' => $this->primaryKey(),
        'email' => $this->string(),
        'created_on' => $this->timestamp(),
    ]);
  }

  /**
   * @inheritdoc
   */
  public function safeDown()
  {
    $this->dropTable('newsletter_email');
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
