<?php
use yii\db\Migration;


class m180908_100018_agreement extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->execute("CREATE TABLE IF NOT EXISTS `agreement` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `name` VARCHAR(245) NULL COMMENT '',
  `text` TEXT NULL COMMENT '',
  `is_deleted` TINYINT(1) NULL COMMENT '',
  `created_on` TIMESTAMP NULL COMMENT '',
  `created_by` INT(11) NULL COMMENT '',
  `order` INT(5) NULL COMMENT '',
  `is_required` TINYINT(1) NULL COMMENT '',
  `is_cancel` TINYINT(1) NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_agreement_user1_idx` (`created_by` ASC)  COMMENT '',
  CONSTRAINT `fk_agreement_user1`
    FOREIGN KEY (`created_by`)
    REFERENCES `user` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION)
ENGINE = InnoDB");
    
    $this->execute("CREATE TABLE IF NOT EXISTS `user_agreement` (
  `agreement_id` INT NOT NULL COMMENT '',
  `user_id` INT(11) NOT NULL COMMENT '',
  `created_on` TIMESTAMP NULL COMMENT '',
  `expiry_date` DATE NULL COMMENT '',
  PRIMARY KEY (`agreement_id`, `user_id`)  COMMENT '',
  INDEX `fk_agreement_has_user_user1_idx` (`user_id` ASC)  COMMENT '',
  INDEX `fk_agreement_has_user_agreement1_idx` (`agreement_id` ASC)  COMMENT '',
  CONSTRAINT `fk_agreement_has_user_agreement1`
    FOREIGN KEY (`agreement_id`)
    REFERENCES `agreement` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_agreement_has_user_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB");
    
 
  }

  /**
   * @inheritdoc
   */
  public function safeDown()
  {
    $this->dropTable('agreement');
    $this->dropTable('user_agreement');
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
