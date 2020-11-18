<?php
use yii\db\Migration;

class m181204_100000_pol_question_answer extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->dropTable('pol_question_answer');
    $this->execute("CREATE TABLE IF NOT EXISTS `pol_question_answer` (
  `poll_poll_question_poll_id` INT NOT NULL COMMENT '',
  `poll_poll_question_poll_question_id` INT NOT NULL COMMENT '',
  `user_id` INT(11) NOT NULL COMMENT '',
  `answer` VARCHAR(245) NULL COMMENT '',
  `answer_open` TEXT NULL COMMENT '',
  `training_id` INT NOT NULL COMMENT '',
  PRIMARY KEY (`poll_poll_question_poll_id`, `poll_poll_question_poll_question_id`, `user_id`, `training_id`)  COMMENT '',
  INDEX `fk_poll_poll_question_has_user_user1_idx` (`user_id` ASC)  COMMENT '',
  INDEX `fk_poll_poll_question_has_user_poll_poll_question1_idx` (`poll_poll_question_poll_id` ASC, `poll_poll_question_poll_question_id` ASC)  COMMENT '',
  INDEX `fk_pol_question_answer_training1_idx` (`training_id` ASC)  COMMENT '',
  CONSTRAINT `fk_poll_poll_question_has_user_poll_poll_question1`
    FOREIGN KEY (`poll_poll_question_poll_id` , `poll_poll_question_poll_question_id`)
    REFERENCES `poll_poll_question` (`poll_id` , `poll_question_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_poll_poll_question_has_user_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pol_question_answer_training1`
    FOREIGN KEY (`training_id`)
    REFERENCES `training` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB");
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
