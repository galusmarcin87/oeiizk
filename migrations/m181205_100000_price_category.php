<?php
use yii\db\Migration;

class m181205_100000_price_category extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->alterColumn('training_template', 'default_price_category', $this->text());
    $this->alterColumn('training', 'price_category', $this->text());
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
