<?php
use yii\db\Migration;

/**
 * Class m171121_120201_user
 */
class m180825_130628_log extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {
    $this->execute("CREATE TABLE IF NOT EXISTS `log` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `created_by` INT(11) NULL COMMENT '',
  `created_on` TIMESTAMP NULL COMMENT '',
  `type` VARCHAR(245) NULL COMMENT '',
  `text` LONGTEXT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_log_user1_idx` (`created_by` ASC)  COMMENT '',
  CONSTRAINT `fk_log_user1`
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
    $this->dropTable('log');
  }
}
