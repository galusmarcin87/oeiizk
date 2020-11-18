<?php
use yii\db\Migration;


class m180908_100013_training_participant extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->execute("CREATE TABLE IF NOT EXISTS `training_participant` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `training_id` INT NOT NULL COMMENT '',
  `user_id` INT(11) NOT NULL COMMENT '',
  `order` INT(5) NULL COMMENT '',
  `surname` VARCHAR(245) NULL COMMENT '',
  `workplace` VARCHAR(245) NULL COMMENT '',
  `status` VARCHAR(45) NULL COMMENT '',
  `created_on` TIMESTAMP NULL COMMENT '',
  `is_reserve` TINYINT(1) NULL COMMENT '',
  `is_paid` TINYINT(1) NULL COMMENT '',
  `paid_missing` FLOAT(6,2) NULL COMMENT '',
  `is_passed` TINYINT(1) NULL COMMENT '',
  `is_print_certificate` TINYINT(1) NULL COMMENT '',
  `created_by` INT(11) NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_training_has_user_user1_idx` (`user_id` ASC)  COMMENT '',
  INDEX `fk_training_has_user_training1_idx` (`training_id` ASC)  COMMENT '',
  INDEX `fk_training_participant_user1_idx` (`created_by` ASC)  COMMENT '',
  CONSTRAINT `fk_training_has_user_training1`
    FOREIGN KEY (`training_id`)
    REFERENCES `training` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_training_has_user_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_training_participant_user1`
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
    $this->dropTable('training_participant');
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
