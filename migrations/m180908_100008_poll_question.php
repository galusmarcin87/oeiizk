<?php
use yii\db\Migration;


class m180908_100008_poll_question extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->execute("CREATE TABLE IF NOT EXISTS `poll_question` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `name` VARCHAR(45) NOT NULL COMMENT '',
  `created_on` TIMESTAMP NULL COMMENT '',
  `created_by` INT(11) NULL COMMENT '',
  `is_deleted` TINYINT(1) NULL DEFAULT 0 COMMENT '',
  `type` INT(3) UNSIGNED NULL COMMENT '',
  `question` TEXT NULL COMMENT '',
  `options_json` TEXT NULL COMMENT '',
  `is_individual` TINYINT(1) NULL DEFAULT 0 COMMENT '',
  `is_required` TINYINT(1) NULL DEFAULT 0 COMMENT '',
  `order` INT(3) NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_poll_question_user1_idx` (`created_by` ASC)  COMMENT '',
  CONSTRAINT `fk_poll_question_user1`
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
    $this->dropTable('poll_question');
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
