<?php
use yii\db\Migration;


class m180908_100023_training_direction extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->execute("CREATE TABLE IF NOT EXISTS `training_direction` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `name` VARCHAR(245) NOT NULL COMMENT '',
  `is_deleted` TINYINT(1) NULL DEFAULT 0 COMMENT '',
  `created_on` TIMESTAMP NULL COMMENT '',
  `created_by` INT(11) NULL COMMENT '',
  `order` INT(3) NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_training_direction_user1_idx` (`created_by` ASC)  COMMENT '',
  CONSTRAINT `fk_training_direction_user1`
    FOREIGN KEY (`created_by`)
    REFERENCES `user` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION)
ENGINE = InnoDB");
    
    $this->execute("CREATE TABLE IF NOT EXISTS `training_training_direction` (
  `training_id` INT NOT NULL COMMENT '',
  `training_direction_id` INT NOT NULL COMMENT '',
  PRIMARY KEY (`training_id`, `training_direction_id`)  COMMENT '',
  INDEX `fk_training_has_training_direction_training_direction1_idx` (`training_direction_id` ASC)  COMMENT '',
  INDEX `fk_training_has_training_direction_training1_idx` (`training_id` ASC)  COMMENT '',
  CONSTRAINT `fk_training_has_training_direction_training1`
    FOREIGN KEY (`training_id`)
    REFERENCES `training` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_training_has_training_direction_training_direction1`
    FOREIGN KEY (`training_direction_id`)
    REFERENCES `training_direction` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB");

  }

  /**
   * @inheritdoc
   */
  public function safeDown()
  {
    $this->dropTable('training_training_direction');
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
