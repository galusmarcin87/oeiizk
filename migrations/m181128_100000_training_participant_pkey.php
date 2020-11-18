<?php
use yii\db\Migration;

class m181128_100000_training_participant_pkey extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->execute("ALTER TABLE `training_participant`
	DROP PRIMARY KEY,
	ADD PRIMARY KEY (`id`, `training_id`, `user_id`)");
    $this->execute("ALTER TABLE `training_participant`
	DROP PRIMARY KEY,
	ADD PRIMARY KEY (`training_id`, `user_id`),
	ADD INDEX `id` (`id`)");
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
