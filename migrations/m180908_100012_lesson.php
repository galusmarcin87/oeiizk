<?php
use yii\db\Migration;


class m180908_100012_lesson extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->execute("CREATE TABLE IF NOT EXISTS `lesson` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `subject` TEXT NULL COMMENT '',
  `date_start` TIMESTAMP NULL COMMENT '',
  `date_end` TIMESTAMP NULL COMMENT '',
  `created_on` TIMESTAMP NULL COMMENT '',
  `created_by` INT(11) NULL COMMENT '',
  `training_id` INT NOT NULL COMMENT '',
  `lab_id` INT NULL COMMENT '',
  `hours_count` INT(3) NULL COMMENT '',
  `is_deleted` TINYINT(1) NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_training_meeting_user1_idx` (`created_by` ASC)  COMMENT '',
  INDEX `fk_training_lesson_training1_idx` (`training_id` ASC)  COMMENT '',
  INDEX `fk_training_lesson_lab1_idx` (`lab_id` ASC)  COMMENT '',
  CONSTRAINT `fk_training_meeting_user1`
    FOREIGN KEY (`created_by`)
    REFERENCES `user` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_training_lesson_training1`
    FOREIGN KEY (`training_id`)
    REFERENCES `training` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_training_lesson_lab1`
    FOREIGN KEY (`lab_id`)
    REFERENCES `lab` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION)
ENGINE = InnoDB");

  }

  /**
   * @inheritdoc
   */
  public function safeDown()
  {
    $this->dropTable('lesson');
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
