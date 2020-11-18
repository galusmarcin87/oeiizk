<?php
use yii\db\Migration;

class m181215_100002_educational_level_workplace extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->execute("CREATE TABLE IF NOT EXISTS `workplace_educational_level` (
  `workplace_id` INT NOT NULL COMMENT '',
  `educational_level_id` INT NOT NULL COMMENT '',
  PRIMARY KEY (`workplace_id`, `educational_level_id`)  COMMENT '',
  INDEX `fk_workplace_has_educational_level_educational_level1_idx` (`educational_level_id` ASC)  COMMENT '',
  INDEX `fk_workplace_has_educational_level_workplace1_idx` (`workplace_id` ASC)  COMMENT '',
  CONSTRAINT `fk_workplace_has_educational_level_workplace1`
    FOREIGN KEY (`workplace_id`)
    REFERENCES `workplace` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_workplace_has_educational_level_educational_level1`
    FOREIGN KEY (`educational_level_id`)
    REFERENCES `educational_level` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB");
    

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
