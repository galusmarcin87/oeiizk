<?php
use yii\db\Migration;

class m190411_100000_user_is_profiled_offer_enabled extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->addColumn('user', 'is_profiled_offer_enabled', $this->boolean()->defaultValue(1));
    

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
