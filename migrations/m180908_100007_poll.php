<?php
use yii\db\Migration;


class m180908_100007_poll extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->execute("CREATE TABLE IF NOT EXISTS `poll` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `name` VARCHAR(245) NULL COMMENT '',
  `created_on` TIMESTAMP NULL COMMENT '',
  `is_deleted` TINYINT(1) NULL DEFAULT 0 COMMENT '',
  `created_by` INT(11) NULL COMMENT '',
  `poll_template_id` INT NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_poll_user1_idx` (`created_by` ASC)  COMMENT '',
  INDEX `fk_poll_poll_template1_idx` (`poll_template_id` ASC)  COMMENT '',
  CONSTRAINT `fk_poll_user1`
    FOREIGN KEY (`created_by`)
    REFERENCES `user` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_poll_poll_template1`
    FOREIGN KEY (`poll_template_id`)
    REFERENCES `poll_template` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB");
  }

  /**
   * @inheritdoc
   */
  public function safeDown()
  {
    $this->dropTable('poll');
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
