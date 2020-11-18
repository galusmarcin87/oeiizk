<?php
use yii\db\Migration;


class m180908_100005_event extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->execute("CREATE TABLE IF NOT EXISTS `event` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `name` VARCHAR(45) NOT NULL COMMENT '',
  `subtitle` VARCHAR(245) NULL COMMENT '',
  `created_on` TIMESTAMP NULL COMMENT '',
  `created_by` INT(11) NULL COMMENT '',
  `code` VARCHAR(45) NULL COMMENT '',
  `info` TEXT NULL COMMENT '',
  `link` VARCHAR(245) NULL COMMENT '',
  `link_to_registration` VARCHAR(255) NULL COMMENT '',
  `date_from` TIMESTAMP NULL COMMENT '',
  `date_to` TIMESTAMP NULL COMMENT '',
  `file_id` INT(11) NULL COMMENT '',
  `promoted_oeiizk` TINYINT(1) NULL COMMENT '',
  `promoted_pos` TINYINT(1) NULL COMMENT '',
  `coments` TEXT NULL COMMENT '',
  `is_deleted` TINYINT(1) NULL DEFAULT 0 COMMENT '',
  `type` INT(3) NULL COMMENT '',
  `is_display_on_screen` TINYINT(1) NULL COMMENT '',
  `lab_id` INT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_event_user1_idx` (`created_by` ASC)  COMMENT '',
  INDEX `fk_event_file1_idx` (`file_id` ASC)  COMMENT '',
  INDEX `fk_event_lab1_idx` (`lab_id` ASC)  COMMENT '',
  CONSTRAINT `fk_event_user1`
    FOREIGN KEY (`created_by`)
    REFERENCES `user` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_event_file1`
    FOREIGN KEY (`file_id`)
    REFERENCES `file` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_event_lab1`
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
    $this->dropTable('event');
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
