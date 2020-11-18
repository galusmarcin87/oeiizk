<?php
use yii\db\Migration;


class m180908_100003_lab extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->execute("CREATE TABLE IF NOT EXISTS `lab` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `name` VARCHAR(245) NULL COMMENT '',
  `short_headquarter_name` VARCHAR(245) NULL COMMENT '',
  `institution_id` INT NULL COMMENT '',
  `long_name` TEXT NULL COMMENT '',
  `floor` INT(3) NULL COMMENT '',
  `is_our` TINYINT(1) NULL COMMENT '',
  `created_by` INT(11) NULL COMMENT '',
  `created_on` TIMESTAMP NULL COMMENT '',
  `is_deleted` TINYINT(1) NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_lab_institution1_idx` (`institution_id` ASC)  COMMENT '',
  INDEX `fk_lab_user1_idx` (`created_by` ASC)  COMMENT '',
  CONSTRAINT `fk_lab_institution1`
    FOREIGN KEY (`institution_id`)
    REFERENCES `institution` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lab_user1`
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
    $this->dropTable('lab');
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
