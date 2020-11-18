<?php
use yii\db\Migration;


class m180908_100014_workshop extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->execute("CREATE TABLE IF NOT EXISTS `workshop` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `title` VARCHAR(245) NOT NULL COMMENT '',
  `created_on` TIMESTAMP NULL COMMENT '',
  `is_deleted` TINYINT(1) NULL DEFAULT 0 COMMENT '',
  `created_by` INT(11) NULL COMMENT '',
  `description` TEXT NULL COMMENT '',
  `date_start` TIMESTAMP NULL COMMENT '',
  `date_end` TIMESTAMP NULL COMMENT '',
  `lab_id` INT NULL COMMENT '',
  `training_id` INT NOT NULL COMMENT '',
  `order` INT(3) NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_workshop_user1_idx` (`created_by` ASC)  COMMENT '',
  INDEX `fk_workshop_lab1_idx` (`lab_id` ASC)  COMMENT '',
  INDEX `fk_workshop_training1_idx` (`training_id` ASC)  COMMENT '',
  CONSTRAINT `fk_workshop_user1`
    FOREIGN KEY (`created_by`)
    REFERENCES `user` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_workshop_lab1`
    FOREIGN KEY (`lab_id`)
    REFERENCES `lab` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_workshop_training1`
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
    $this->dropTable('workshop');
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
