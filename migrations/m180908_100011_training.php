<?php
use yii\db\Migration;


class m180908_100011_training extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->execute("CREATE TABLE IF NOT EXISTS `training` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `name` VARCHAR(245) NOT NULL COMMENT '',
  `subtitle` VARCHAR(245) NULL COMMENT '',
  `created_on` TIMESTAMP NULL COMMENT '',
  `created_by` INT(11) NULL COMMENT '',
  `is_deleted` TINYINT(1) NULL DEFAULT 0 COMMENT '',
  `training_template_id` INT NULL COMMENT '',
  `code` VARCHAR(45) NULL COMMENT '',
  `meeting_number` INT(4) NULL COMMENT '',
  `module_number` INT(4) NULL COMMENT '',
  `date_start` TIMESTAMP NULL COMMENT '',
  `date_end` TIMESTAMP NULL COMMENT '',
  `technical_requirements` TEXT NULL COMMENT '',
  `social_requirements` TEXT NULL COMMENT '',
  `visibility` VARCHAR(45) NULL COMMENT '',
  `certificate_lines` TEXT NULL COMMENT '',
  `minimal_participants_number` INT(4) NULL COMMENT '',
  `maximal_participants_number` INT(4) NULL COMMENT '',
  `final_maximal_participants_number` INT(4) NULL COMMENT '',
  `is_login_required` TINYINT(1) NULL COMMENT '',
  `status` VARCHAR(45) NULL COMMENT '',
  `is_card_required` TINYINT(1) NULL COMMENT '',
  `is_certificate_issued` TEXT NULL COMMENT '',
  `additional_information` TEXT NULL COMMENT '',
  `comments` TEXT NULL COMMENT '',
  `sign_status` TINYINT(3) NULL COMMENT '',
  `is_promoted_oeiizk` TINYINT(1) NULL COMMENT '',
  `is_promoted_pos` TINYINT(1) NULL COMMENT '',
  `file_id` INT(11) NULL COMMENT '',
  `poll_id` INT NULL COMMENT '',
  `link_to_materials` VARCHAR(245) NULL COMMENT '',
  `article_id` INT(11) NULL COMMENT '',
  `subject_id` INT NULL COMMENT '',
  `project` VARCHAR(245) NULL COMMENT '',
  `is_display_on_screen` TINYINT(1) NULL COMMENT '',
  `lab_id` INT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_training_user1_idx` (`created_by` ASC)  COMMENT '',
  INDEX `fk_training_training_template1_idx` (`training_template_id` ASC)  COMMENT '',
  INDEX `fk_training_file1_idx` (`file_id` ASC)  COMMENT '',
  INDEX `fk_training_poll1_idx` (`poll_id` ASC)  COMMENT '',
  INDEX `fk_training_article1_idx` (`article_id` ASC)  COMMENT '',
  INDEX `fk_training_subject1_idx` (`subject_id` ASC)  COMMENT '',
  INDEX `fk_training_lab1_idx` (`lab_id` ASC)  COMMENT '',
  CONSTRAINT `fk_training_user1`
    FOREIGN KEY (`created_by`)
    REFERENCES `user` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_training_training_template1`
    FOREIGN KEY (`training_template_id`)
    REFERENCES `training_template` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_training_file1`
    FOREIGN KEY (`file_id`)
    REFERENCES `file` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_training_poll1`
    FOREIGN KEY (`poll_id`)
    REFERENCES `poll` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_training_article1`
    FOREIGN KEY (`article_id`)
    REFERENCES `article` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_training_subject1`
    FOREIGN KEY (`subject_id`)
    REFERENCES `subject` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_training_lab1`
    FOREIGN KEY (`lab_id`)
    REFERENCES `lab` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION)
ENGINE = InnoDB");

  }

  /**
   * @inheritdoc
   */
  public function safeDown()
  {
    $this->dropTable('training');
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
