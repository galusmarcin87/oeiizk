<?php
use yii\db\Migration;

/**
 * Class m171121_120201_user
 */
class m180822_130628_modification_history extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {
    $this->execute("CREATE TABLE IF NOT EXISTS `modification_history` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `created_on` TIMESTAMP NULL COMMENT '',
  `created_by` INT(11) NOT NULL COMMENT '',
  `model_class` VARCHAR(245) NULL COMMENT '',
  `model_id` INT NULL COMMENT '',
  `previous_model` TEXT NULL COMMENT '',
  `model` TEXT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_modification_history_user1_idx` (`created_by` ASC)  COMMENT '',
  CONSTRAINT `fk_modification_history_user1`
    FOREIGN KEY (`created_by`)
    REFERENCES `user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB");
  }

  /**
   * @inheritdoc
   */
  public function safeDown()
  {
    $this->dropTable('modification_history');
  }
}
