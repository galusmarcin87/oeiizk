<?php
use yii\db\Migration;

class m181218_100000_training_date extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->alterColumn('training', 'date_start', $this->date());
    $this->alterColumn('training', 'date_end', $this->date());
    

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
