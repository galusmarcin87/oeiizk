<?php
use yii\db\Migration;

/**
 * Class m171121_120201_user
 */
class m180825_140728_message extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {
    $this->execute("CREATE TABLE IF NOT EXISTS `message` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `subject` VARCHAR(245) NULL COMMENT '',
  `message` TEXT NULL COMMENT '',
  `sender_id` INT(11) NULL COMMENT '',
  `recipient_id` INT(11) NOT NULL COMMENT '',
  `message_id` INT NULL COMMENT '',
  `email` VARCHAR(245) NULL COMMENT '',
  `created_on` TIMESTAMP NULL COMMENT '',
  `is_read` TINYINT(1) NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_message_user1_idx` (`sender_id` ASC)  COMMENT '',
  INDEX `fk_message_user2_idx` (`recipient_id` ASC)  COMMENT '',
  INDEX `fk_message_message1_idx` (`message_id` ASC)  COMMENT '',
  CONSTRAINT `fk_message_user1`
    FOREIGN KEY (`sender_id`)
    REFERENCES `user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_message_user2`
    FOREIGN KEY (`recipient_id`)
    REFERENCES `user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_message_message1`
    FOREIGN KEY (`message_id`)
    REFERENCES `message` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB");
  }

  /**
   * @inheritdoc
   */
  public function safeDown()
  {
    $this->dropTable('message');
  }
}
