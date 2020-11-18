<?php
use yii\db\Migration;

/**
 * Class m171121_120201_user
 */
//CREATE TABLE IF NOT EXISTS `mgcms2`.`user` (
//  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
//  `username` VARCHAR(245) NOT NULL COMMENT '',
//  `password` VARCHAR(245) NOT NULL COMMENT '',
//  `first_name` VARCHAR(245) NULL DEFAULT NULL COMMENT '',
//  `last_name` VARCHAR(245) NULL DEFAULT NULL COMMENT '',
//  `role` VARCHAR(45) NULL DEFAULT NULL COMMENT '',
//  `status` TINYINT(3) NULL DEFAULT '1' COMMENT '',
//  `email` VARCHAR(245) NULL DEFAULT NULL COMMENT '',
//  `created_on` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT '',
//  `last_login` TIMESTAMP NULL DEFAULT NULL COMMENT '',
//  `created_by` INT(11) NULL DEFAULT NULL COMMENT '',
//  `address` VARCHAR(245) NULL DEFAULT NULL COMMENT '',
//  `postcode` VARCHAR(10) NULL DEFAULT NULL COMMENT '',
//  `birthdate` DATE NULL DEFAULT NULL COMMENT '',
//  `city` VARCHAR(245) NULL DEFAULT NULL COMMENT '',
//  `auth_key` VARCHAR(60) NOT NULL COMMENT '',
//  `other_names` VARCHAR(245) NULL COMMENT '',
//  `gender` TINYINT(2) NULL COMMENT '',
//  `date_email_confirmation` TIMESTAMP NULL COMMENT '',
//  `birth_place` VARCHAR(245) NULL COMMENT '',
//  `position` VARCHAR(245) NULL COMMENT '',
//  `educational_level` VARCHAR(245) NULL COMMENT '',
//  `subject` VARCHAR(245) NULL COMMENT '',
//  `employment_card_id` INT(11) NULL COMMENT '',
//  `date_card_verification` DATE NULL COMMENT '',
//  `date_card_submission` DATE NULL COMMENT '',
//  `academic_title` VARCHAR(245) NULL COMMENT '',
//  `phone` VARCHAR(45) NULL COMMENT '',
//  `is_special_account` TINYINT(1) NULL COMMENT '',
//  `credibility` INT(4) NULL COMMENT '',
//  `newsletter` TINYINT(1) NULL COMMENT '',
//  `comments` TEXT NULL COMMENT '',
//  `is_deleted` TINYINT(1) NULL DEFAULT 0 COMMENT '',
//  `is_not_logged_account` TINYINT(1) NULL DEFAULT 0 COMMENT '',
//  `date_last_password_change` TIMESTAMP NULL COMMENT '',
//  `password_restriction_aproved` TINYINT(1) NULL DEFAULT 0 COMMENT '',
//  `training_preferences` TEXT NULL COMMENT '',
//  `training_preferences_keywords` VARCHAR(245) NULL COMMENT '',
//  `is_password_change_accepted` TINYINT(1) NULL COMMENT '',
//  PRIMARY KEY (`id`)  COMMENT '',
//  UNIQUE INDEX `username_UNIQUE` (`username` ASC)  COMMENT '',
//  UNIQUE INDEX `auth_key` (`auth_key` ASC)  COMMENT '',
//  INDEX `fk_user_user` (`created_by` ASC)  COMMENT '',
//  INDEX `fk_user_file1_idx` (`employment_card_id` ASC)  COMMENT '',
//  CONSTRAINT `fk_user_user`
//    FOREIGN KEY (`created_by`)
//    REFERENCES `mgcms2`.`user` (`id`)
//    ON DELETE SET NULL
//    ON UPDATE NO ACTION,
//  CONSTRAINT `fk_user_file1`
//    FOREIGN KEY (`employment_card_id`)
//    REFERENCES `mgcms2`.`file` (`id`)
//    ON DELETE NO ACTION
//    ON UPDATE NO ACTION)
//ENGINE = InnoDB
//AUTO_INCREMENT = 16
//DEFAULT CHARACTER SET = utf8



class m180908_100001_user_3 extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->addForeignKey('fk_user_file1', 'user', 'employment_card_id', 'file', 'id');
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
