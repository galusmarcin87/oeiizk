<?php
use yii\db\Migration;


class m180908_100006_poll_template extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->execute("CREATE TABLE IF NOT EXISTS `poll_template` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `name` VARCHAR(245) NOT NULL COMMENT '',
  `created_on` TIMESTAMP NULL COMMENT '',
  `created_by` INT(11) NULL COMMENT '',
  `is_deleted` TINYINT(1) NULL DEFAULT 0 COMMENT '',
  `text` TEXT NULL COMMENT '',
  `type` INT(3) UNSIGNED NULL COMMENT '',
  `file_id` INT(11) NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_poll_template_user1_idx` (`created_by` ASC)  COMMENT '',
  INDEX `fk_poll_template_file1_idx` (`file_id` ASC)  COMMENT '',
  CONSTRAINT `fk_poll_template_user1`
    FOREIGN KEY (`created_by`)
    REFERENCES `user` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_poll_template_file1`
    FOREIGN KEY (`file_id`)
    REFERENCES `file` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION)
ENGINE = InnoDB");
  }

  /**
   * @inheritdoc
   */
  public function safeDown()
  {
    $this->dropTable('poll_template');
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
