<?php
use yii\db\Migration;

/**
 * Class m171121_120201_user
 */
class m180825_140628_sql_query extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {
    $this->execute("CREATE TABLE IF NOT EXISTS `sql_query` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `name` VARCHAR(245) NOT NULL COMMENT '',
  `query` TEXT NULL COMMENT '',
  `created_on` TIMESTAMP NULL COMMENT '',
  `is_deleted` TINYINT(1) NULL DEFAULT 0 COMMENT '',
  `created_by` INT(11) NOT NULL COMMENT '',
  `params` TEXT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_sql_query_user1_idx` (`created_by` ASC)  COMMENT '',
  CONSTRAINT `fk_sql_query_user1`
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
    $this->dropTable('sql_query');
  }
}
