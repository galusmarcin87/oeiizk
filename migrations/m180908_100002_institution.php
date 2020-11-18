<?php
use yii\db\Migration;


class m180908_100002_institution extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->execute("CREATE TABLE IF NOT EXISTS `institution` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `name` VARCHAR(245) NOT NULL COMMENT '',
  `short_name` VARCHAR(245) NULL COMMENT '',
  `code` VARCHAR(100) NULL COMMENT '',
  `created_on` TIMESTAMP NULL COMMENT '',
  `created_by` INT(11) NULL COMMENT '',
  `is_deleted` TINYINT(1) NULL DEFAULT 0 COMMENT '',
  `patron` VARCHAR(245) NULL COMMENT '',
  `city` VARCHAR(245) NULL COMMENT '',
  `community` VARCHAR(245) NULL COMMENT '',
  `county` VARCHAR(245) NULL COMMENT '',
  `province` VARCHAR(245) NULL COMMENT '',
  `street` VARCHAR(245) NULL COMMENT '',
  `house_no` VARCHAR(10) NULL COMMENT '',
  `postcode` VARCHAR(12) NULL COMMENT '',
  `post` VARCHAR(245) NULL COMMENT '',
  `phone` VARCHAR(45) NULL COMMENT '',
  `www` VARCHAR(245) NULL COMMENT '',
  `type` VARCHAR(45) NULL COMMENT '',
  `is_verified` TINYINT(1) NULL DEFAULT 1 COMMENT '',
  `territory` VARCHAR(45) NULL COMMENT '',
  `school_group_name` VARCHAR(245) NULL COMMENT '',
  `delegacy` VARCHAR(245) NULL COMMENT '',
  `NIP` VARCHAR(45) NULL COMMENT '',
  `email` VARCHAR(245) NULL COMMENT '',
  `school_governing_body` VARCHAR(245) NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_institution_user1_idx` (`created_by` ASC)  COMMENT '',
  CONSTRAINT `fk_institution_user1`
    FOREIGN KEY (`created_by`)
    REFERENCES `user` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION)
ENGINE = InnoDB");
  }

  /**
   * @inheritdoc
   */
  public function safeDown()
  {
    $this->dropTable('institution');
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
