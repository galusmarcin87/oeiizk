<?php
use yii\db\Migration;


class m180908_100024_others extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->execute("CREATE TABLE IF NOT EXISTS `training_required` (
  `training_template_id` INT NOT NULL COMMENT '',
  `training_id` INT NOT NULL COMMENT '',
  PRIMARY KEY (`training_template_id`, `training_id`)  COMMENT '',
  INDEX `fk_training_template_has_training_training1_idx` (`training_id` ASC)  COMMENT '',
  INDEX `fk_training_template_has_training_training_template1_idx` (`training_template_id` ASC)  COMMENT '',
  CONSTRAINT `fk_training_template_has_training_training_template1`
    FOREIGN KEY (`training_template_id`)
    REFERENCES `training_template` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_training_template_has_training_training1`
    FOREIGN KEY (`training_id`)
    REFERENCES `training` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB");
    
    $this->execute("CREATE TABLE IF NOT EXISTS `user_group` (
  `group_id` INT NOT NULL COMMENT '',
  `user_id` INT(11) NOT NULL COMMENT '',
  PRIMARY KEY (`group_id`, `user_id`)  COMMENT '',
  INDEX `fk_group_has_user_user1_idx` (`user_id` ASC)  COMMENT '',
  INDEX `fk_group_has_user_group1_idx` (`group_id` ASC)  COMMENT '',
  CONSTRAINT `fk_group_has_user_group1`
    FOREIGN KEY (`group_id`)
    REFERENCES `group` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_group_has_user_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB ");
    
    $this->execute("CREATE TABLE IF NOT EXISTS `user_subject` (
  `subject_id` INT NOT NULL COMMENT '',
  `user_id` INT(11) NOT NULL COMMENT '',
  PRIMARY KEY (`subject_id`, `user_id`)  COMMENT '',
  INDEX `fk_subject_has_user_user1_idx` (`user_id` ASC)  COMMENT '',
  INDEX `fk_subject_has_user_subject1_idx` (`subject_id` ASC)  COMMENT '',
  CONSTRAINT `fk_subject_has_user_subject1`
    FOREIGN KEY (`subject_id`)
    REFERENCES `subject` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_subject_has_user_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB");
    
    $this->execute("CREATE TABLE IF NOT EXISTS `workplace` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `position` VARCHAR(245) NULL COMMENT '',
  `school_type` VARCHAR(45) NULL COMMENT '',
  `educational_level` VARCHAR(45) NULL COMMENT '',
  `user_id` INT(11) NOT NULL COMMENT '',
  `institution_id` INT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_workplace_user1_idx` (`user_id` ASC)  COMMENT '',
  INDEX `fk_workplace_institution1_idx` (`institution_id` ASC)  COMMENT '',
  CONSTRAINT `fk_workplace_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_workplace_institution1`
    FOREIGN KEY (`institution_id`)
    REFERENCES `institution` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION)
ENGINE = InnoDB");
    
    $this->execute("CREATE TABLE IF NOT EXISTS `workplace_subject` (
  `workplace_id` INT NOT NULL COMMENT '',
  `subject_id` INT NOT NULL COMMENT '',
  PRIMARY KEY (`workplace_id`, `subject_id`)  COMMENT '',
  INDEX `fk_workplace_has_subject_subject1_idx` (`subject_id` ASC)  COMMENT '',
  INDEX `fk_workplace_has_subject_workplace1_idx` (`workplace_id` ASC)  COMMENT '',
  CONSTRAINT `fk_workplace_has_subject_workplace1`
    FOREIGN KEY (`workplace_id`)
    REFERENCES `workplace` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_workplace_has_subject_subject1`
    FOREIGN KEY (`subject_id`)
    REFERENCES `subject` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB");

  }

  /**
   * @inheritdoc
   */
  public function safeDown()
  {
    $this->dropTable('training_required');
    $this->dropTable('user_group');
    $this->dropTable('user_subject');
    $this->dropTable('workplace');
    $this->dropTable('workplace_subject');
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
