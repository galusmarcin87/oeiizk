<?php
use yii\db\Migration;


class m180908_100015_training_module extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->execute("CREATE TABLE IF NOT EXISTS `training_module` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `subject` VARCHAR(245) NULL COMMENT '',
  `date_start` DATE NULL COMMENT '',
  `date_end` DATE NULL COMMENT '',
  `description` TEXT NULL COMMENT '',
  `hours` INT(5) NULL COMMENT '',
  `training_id` INT NOT NULL COMMENT '',
  `created_by` INT(11) NULL COMMENT '',
  `is_deleted` TINYINT(1) NULL DEFAULT 0 COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_training_module_training1_idx` (`training_id` ASC)  COMMENT '',
  INDEX `fk_training_module_user1_idx` (`created_by` ASC)  COMMENT '',
  CONSTRAINT `fk_training_module_training1`
    FOREIGN KEY (`training_id`)
    REFERENCES `training` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_training_module_user1`
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
    $this->dropTable('training_module');
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
