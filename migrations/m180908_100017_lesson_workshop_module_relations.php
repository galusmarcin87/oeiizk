<?php
use yii\db\Migration;


class m180908_100017_lesson_workshop_module_relations extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->execute("CREATE TABLE IF NOT EXISTS `lesson_presence` (
  `training_lesson_id` INT NOT NULL COMMENT '',
  `user_id` INT(11) NOT NULL COMMENT '',
  `note` VARCHAR(245) NULL COMMENT '',
  PRIMARY KEY (`training_lesson_id`, `user_id`)  COMMENT '',
  INDEX `fk_training_lesson_has_user_user1_idx` (`user_id` ASC)  COMMENT '',
  INDEX `fk_training_lesson_has_user_training_lesson1_idx` (`training_lesson_id` ASC)  COMMENT '',
  CONSTRAINT `fk_training_lesson_has_user_training_lesson1`
    FOREIGN KEY (`training_lesson_id`)
    REFERENCES `lesson` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_training_lesson_has_user_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB");
    
    $this->execute("CREATE TABLE IF NOT EXISTS `workshop_user` (
  `user_id` INT(11) NOT NULL COMMENT '',
  `workshop_id` INT NOT NULL COMMENT '',
  `status` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`user_id`, `workshop_id`)  COMMENT '',
  INDEX `fk_user_has_workshop_workshop1_idx` (`workshop_id` ASC)  COMMENT '',
  INDEX `fk_user_has_workshop_user1_idx` (`user_id` ASC)  COMMENT '',
  CONSTRAINT `fk_user_has_workshop_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_workshop_workshop1`
    FOREIGN KEY (`workshop_id`)
    REFERENCES `workshop` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8");
    
    $this->execute("CREATE TABLE IF NOT EXISTS `workshop_lector` (
  `workshop_id` INT NOT NULL COMMENT '',
  `user_id` INT(11) NOT NULL COMMENT '',
  PRIMARY KEY (`workshop_id`, `user_id`)  COMMENT '',
  INDEX `fk_workshop_has_user_user1_idx` (`user_id` ASC)  COMMENT '',
  INDEX `fk_workshop_has_user_workshop1_idx` (`workshop_id` ASC)  COMMENT '',
  CONSTRAINT `fk_workshop_has_user_workshop1`
    FOREIGN KEY (`workshop_id`)
    REFERENCES `workshop` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_workshop_has_user_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB");
    
    $this->execute("CREATE TABLE IF NOT EXISTS `training_lector` (
  `training_id` INT NOT NULL COMMENT '',
  `user_id` INT(11) NOT NULL COMMENT '',
  PRIMARY KEY (`training_id`, `user_id`)  COMMENT '',
  INDEX `fk_training_has_user_user2_idx` (`user_id` ASC)  COMMENT '',
  INDEX `fk_training_has_user_training2_idx` (`training_id` ASC)  COMMENT '',
  CONSTRAINT `fk_training_has_user_training2`
    FOREIGN KEY (`training_id`)
    REFERENCES `training` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_training_has_user_user2`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB");
    
    $this->execute("CREATE TABLE IF NOT EXISTS `training_module_presence` (
  `training_module_id` INT NOT NULL COMMENT '',
  `user_id` INT(11) NOT NULL COMMENT '',
  `note` VARCHAR(245) NULL COMMENT '',
  PRIMARY KEY (`training_module_id`, `user_id`)  COMMENT '',
  INDEX `fk_training_module_has_user_user1_idx` (`user_id` ASC)  COMMENT '',
  INDEX `fk_training_module_has_user_training_module1_idx` (`training_module_id` ASC)  COMMENT '',
  CONSTRAINT `fk_training_module_has_user_training_module1`
    FOREIGN KEY (`training_module_id`)
    REFERENCES `training_module` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_training_module_has_user_user1`
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
    $this->dropTable('lesson_presence');
    $this->dropTable('workshop_user');
    $this->dropTable('workshop_lector');
    $this->dropTable('training_lector');
    $this->dropTable('training_module_presence');
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
