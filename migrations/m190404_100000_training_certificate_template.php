<?php
use yii\db\Migration;

class m190404_100000_training_certificate_template extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->addColumn('training', 'certificate_template', $this->string());
    

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
