<?php
use yii\db\Migration;

/**
 * Class m171121_120201_user
 */
class m180906_120626_user_1 extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->addColumn('user', 'is_password_change_accepted', $this->tinyInteger(1));
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
