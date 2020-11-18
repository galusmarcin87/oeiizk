<?php
use yii\db\Migration;


class m180917_100001_training_price_category extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->addColumn('training', 'price_category', $this->string(245));
    
  }

  /**
   * @inheritdoc
   */
  public function safeDown()
  {
    $this->dropColumn('training', 'price_category');
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
