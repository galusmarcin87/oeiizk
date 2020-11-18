<?php
use yii\db\Migration;


class m180908_100009_poll_question_related extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->execute("CREATE TABLE IF NOT EXISTS `poll_template_question` (
  `poll_template_id` INT NOT NULL COMMENT '',
  `poll_question_id` INT NOT NULL COMMENT '',
  `order` INT(3) NULL COMMENT '',
  PRIMARY KEY (`poll_template_id`, `poll_question_id`)  COMMENT '',
  INDEX `fk_poll_template_has_poll_question_poll_question1_idx` (`poll_question_id` ASC)  COMMENT '',
  INDEX `fk_poll_template_has_poll_question_poll_template1_idx` (`poll_template_id` ASC)  COMMENT '',
  CONSTRAINT `fk_poll_template_has_poll_question_poll_template1`
    FOREIGN KEY (`poll_template_id`)
    REFERENCES `poll_template` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_poll_template_has_poll_question_poll_question1`
    FOREIGN KEY (`poll_question_id`)
    REFERENCES `poll_question` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB");
    
    $this->execute("CREATE TABLE IF NOT EXISTS `poll_poll_question` (
  `poll_id` INT NOT NULL COMMENT '',
  `poll_question_id` INT NOT NULL COMMENT '',
  PRIMARY KEY (`poll_id`, `poll_question_id`)  COMMENT '',
  INDEX `fk_poll_has_poll_question_poll_question1_idx` (`poll_question_id` ASC)  COMMENT '',
  INDEX `fk_poll_has_poll_question_poll1_idx` (`poll_id` ASC)  COMMENT '',
  CONSTRAINT `fk_poll_has_poll_question_poll1`
    FOREIGN KEY (`poll_id`)
    REFERENCES `poll` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_poll_has_poll_question_poll_question1`
    FOREIGN KEY (`poll_question_id`)
    REFERENCES `poll_question` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB");
    
    
    $this->execute("CREATE TABLE IF NOT EXISTS `pol_question_answer` (
  `poll_poll_question_poll_id` INT NOT NULL COMMENT '',
  `poll_poll_question_poll_question_id` INT NOT NULL COMMENT '',
  `user_id` INT(11) NOT NULL COMMENT '',
  `answer` VARCHAR(245) NULL COMMENT '',
  `answer_open` TEXT NULL COMMENT '',
  PRIMARY KEY (`poll_poll_question_poll_id`, `poll_poll_question_poll_question_id`, `user_id`)  COMMENT '',
  INDEX `fk_poll_poll_question_has_user_user1_idx` (`user_id` ASC)  COMMENT '',
  INDEX `fk_poll_poll_question_has_user_poll_poll_question1_idx` (`poll_poll_question_poll_id` ASC, `poll_poll_question_poll_question_id` ASC)  COMMENT '',
  CONSTRAINT `fk_poll_poll_question_has_user_poll_poll_question1`
    FOREIGN KEY (`poll_poll_question_poll_id` , `poll_poll_question_poll_question_id`)
    REFERENCES `poll_poll_question` (`poll_id` , `poll_question_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_poll_poll_question_has_user_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB");
    
  }

  /**
   * @inheritdoc
   */
  public function safeDown()
  {
    $this->dropTable('poll_template_question');
    $this->dropTable('poll_poll_question');
    $this->dropTable('pol_question_answer');
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
