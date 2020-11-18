<?php
use yii\db\Migration;

class m190110_100000_event_name extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->alterColumn('event', 'name', $this->string(245));
    

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
