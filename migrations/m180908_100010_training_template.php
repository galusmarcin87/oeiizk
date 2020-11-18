<?php
use yii\db\Migration;


class m180908_100010_training_template extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->execute("CREATE TABLE IF NOT EXISTS `training_template` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `name` VARCHAR(255) NOT NULL COMMENT '',
  `subtitle` VARCHAR(245) NULL COMMENT '',
  `is_deleted` TINYINT(1) NULL DEFAULT 0 COMMENT '',
  `type` VARCHAR(245) NULL COMMENT '',
  `code_start` VARCHAR(245) NULL COMMENT '',
  `educational_level` VARCHAR(245) NULL COMMENT '',
  `training_gruop` VARCHAR(245) NULL COMMENT '',
  `training_path` VARCHAR(245) NULL COMMENT '',
  `category_id` INT(11) NULL COMMENT '',
  `subcategory_id` INT(11) NULL COMMENT '',
  `hours_local` FLOAT(5,2) NULL COMMENT '',
  `hours_online` FLOAT(5,2) NULL COMMENT '',
  `meeting_default_number` INT(3) NULL COMMENT '',
  `modules_default_number` INT(3) NULL COMMENT '',
  `created_by` INT(11) NULL COMMENT '',
  `created_on` TIMESTAMP NULL COMMENT '',
  `lead` TEXT NULL COMMENT '',
  `program_file_id` INT(11) NULL COMMENT '',
  `date_program_submission` DATE NULL COMMENT '',
  `date_last_program_modification` TIMESTAMP NULL COMMENT '',
  `preliminary_recommendations` TEXT NULL COMMENT '',
  `default_technical_requirements` TEXT NULL COMMENT '',
  `default_social_requirements` TEXT NULL COMMENT '',
  `image_id` INT(11) NULL COMMENT '',
  `image_2_id` INT(11) NULL COMMENT '',
  `keywords` TEXT NULL COMMENT '',
  `default_price_category` VARCHAR(245) NULL COMMENT '',
  `visibility` VARCHAR(45) NULL COMMENT '',
  `default_certificate_lines` TEXT NULL COMMENT '',
  `default_minimal_participants_number` INT(4) NULL COMMENT '',
  `default_maximal_participants_number` INT(4) NULL COMMENT '',
  `is_login_required` TINYINT(1) NULL COMMENT '',
  `is_card_required` TINYINT(1) NULL COMMENT '',
  `is_certificate_issued` TEXT NULL COMMENT '',
  `additional_information` TEXT NULL COMMENT '',
  `comments` TEXT NULL COMMENT '',
  `poll_id` INT NULL COMMENT '',
  `article_id` INT(11) NULL COMMENT '',
  `subject_id` INT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_training_template_category_idx` (`category_id` ASC)  COMMENT '',
  INDEX `fk_training_template_category1_idx` (`subcategory_id` ASC)  COMMENT '',
  INDEX `fk_training_template_user1_idx` (`created_by` ASC)  COMMENT '',
  INDEX `fk_training_template_file1_idx` (`program_file_id` ASC)  COMMENT '',
  INDEX `fk_training_template_file2_idx` (`image_id` ASC)  COMMENT '',
  INDEX `fk_training_template_file3_idx` (`image_2_id` ASC)  COMMENT '',
  INDEX `fk_training_template_poll1_idx` (`poll_id` ASC)  COMMENT '',
  INDEX `fk_training_template_article1_idx` (`article_id` ASC)  COMMENT '',
  INDEX `fk_training_template_subject1_idx` (`subject_id` ASC)  COMMENT '',
  CONSTRAINT `fk_training_template_category`
    FOREIGN KEY (`category_id`)
    REFERENCES `category` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_training_template_category1`
    FOREIGN KEY (`subcategory_id`)
    REFERENCES `category` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_training_template_user1`
    FOREIGN KEY (`created_by`)
    REFERENCES `user` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_training_template_file1`
    FOREIGN KEY (`program_file_id`)
    REFERENCES `file` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_training_template_file2`
    FOREIGN KEY (`image_id`)
    REFERENCES `file` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_training_template_file3`
    FOREIGN KEY (`image_2_id`)
    REFERENCES `file` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_training_template_poll1`
    FOREIGN KEY (`poll_id`)
    REFERENCES `poll` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_training_template_article1`
    FOREIGN KEY (`article_id`)
    REFERENCES `article` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_training_template_subject1`
    FOREIGN KEY (`subject_id`)
    REFERENCES `subject` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION)
ENGINE = InnoDB");

  }

  /**
   * @inheritdoc
   */
  public function safeDown()
  {
    $this->dropTable('training_template');
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
