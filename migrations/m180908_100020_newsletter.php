<?php
use yii\db\Migration;


class m180908_100020_newsletter extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->execute("CREATE TABLE IF NOT EXISTS `newsletter` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `name` VARCHAR(245) NULL COMMENT '',
  `created_on` TIMESTAMP NULL COMMENT '',
  `created_by` INT(11) NULL COMMENT '',
  `header` TEXT NULL COMMENT '',
  `footer` TEXT NULL COMMENT '',
  `text` TEXT NULL COMMENT '',
  `add_incoming_training_info` TINYINT(1) NULL DEFAULT 0 COMMENT '',
  `status` VARCHAR(45) NULL COMMENT '',
  `group_id` INT NULL COMMENT '',
  `is_deleted` TINYINT(1) NULL DEFAULT 0 COMMENT '',
  `keywords` TEXT NULL COMMENT '',
  `date_sent` TIMESTAMP NULL COMMENT '',
  `is_required_answer` TINYINT(1) NULL DEFAULT 0 COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_newsletter_user1_idx` (`created_by` ASC)  COMMENT '',
  INDEX `fk_newsletter_group1_idx` (`group_id` ASC)  COMMENT '',
  CONSTRAINT `fk_newsletter_user1`
    FOREIGN KEY (`created_by`)
    REFERENCES `user` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_newsletter_group1`
    FOREIGN KEY (`group_id`)
    REFERENCES `group` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION)
ENGINE = InnoDB");
    
    $this->execute("CREATE TABLE IF NOT EXISTS `newsletter_user` (
  `newsletter_id` INT NOT NULL COMMENT '',
  `user_id` INT(11) NULL COMMENT '',
  `status` INT(3) NULL COMMENT '',
  `info` TEXT NULL COMMENT '',
  `email` VARCHAR(245) NULL COMMENT '',
  PRIMARY KEY (`newsletter_id`, `user_id`)  COMMENT '',
  INDEX `fk_newsletter_has_user_user1_idx` (`user_id` ASC)  COMMENT '',
  INDEX `fk_newsletter_has_user_newsletter1_idx` (`newsletter_id` ASC)  COMMENT '',
  CONSTRAINT `fk_newsletter_has_user_newsletter1`
    FOREIGN KEY (`newsletter_id`)
    REFERENCES `newsletter` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_newsletter_has_user_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB");

  }

  /**
   * @inheritdoc
   */
  public function safeDown()
  {
    $this->dropTable('newsletter');
    $this->dropTable('newsletter_user');
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
