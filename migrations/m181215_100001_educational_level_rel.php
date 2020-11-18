<?php
use yii\db\Migration;

class m181215_100001_educational_level_rel extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->execute("CREATE TABLE IF NOT EXISTS `training_template_educational_level` (
  `training_template_id` INT NOT NULL COMMENT '',
  `educational_level_id` INT NOT NULL COMMENT '',
  PRIMARY KEY (`training_template_id`, `educational_level_id`)  COMMENT '',
  INDEX `fk_training_template_has_educational_level_educational_leve_idx` (`educational_level_id` ASC)  COMMENT '',
  INDEX `fk_training_template_has_educational_level_training_templat_idx` (`training_template_id` ASC)  COMMENT '',
  CONSTRAINT `fk_training_template_has_educational_level_training_template1`
    FOREIGN KEY (`training_template_id`)
    REFERENCES `training_template` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_training_template_has_educational_level_educational_level1`
    FOREIGN KEY (`educational_level_id`)
    REFERENCES `educational_level` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB");
    
    $this->execute("CREATE TABLE IF NOT EXISTS `user_educational_level` (
  `user_id` INT(11) NOT NULL COMMENT '',
  `educational_level_id` INT NOT NULL COMMENT '',
  PRIMARY KEY (`user_id`, `educational_level_id`)  COMMENT '',
  INDEX `fk_user_has_educational_level_educational_level1_idx` (`educational_level_id` ASC)  COMMENT '',
  INDEX `fk_user_has_educational_level_user1_idx` (`user_id` ASC)  COMMENT '',
  CONSTRAINT `fk_user_has_educational_level_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_educational_level_educational_level1`
    FOREIGN KEY (`educational_level_id`)
    REFERENCES `educational_level` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8");
  }

  /**
   * @inheritdoc
   */
  public function safeDown()
  {

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
