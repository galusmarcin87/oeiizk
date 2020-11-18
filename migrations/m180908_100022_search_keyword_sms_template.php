<?php
use yii\db\Migration;


class m180908_100022_search_keyword_sms_template extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->execute("CREATE TABLE IF NOT EXISTS `search_keyword` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `keyword` VARCHAR(245) NOT NULL COMMENT '',
  `created_on` VARCHAR(245) NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB");
    
    $this->execute("CREATE TABLE IF NOT EXISTS `sms_template` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `name` VARCHAR(245) NULL COMMENT '',
  `created_on` TIMESTAMP NULL COMMENT '',
  `is_deleted` TINYINT(1) NULL DEFAULT 0 COMMENT '',
  `created_by` INT(11) NULL COMMENT '',
  `text` TEXT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_sms_template_user1_idx` (`created_by` ASC)  COMMENT '',
  CONSTRAINT `fk_sms_template_user1`
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
    $this->dropTable('search_keyword');
    $this->dropTable('sms_template');
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
