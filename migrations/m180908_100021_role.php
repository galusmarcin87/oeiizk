<?php
use yii\db\Migration;


class m180908_100021_role extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->execute("CREATE TABLE IF NOT EXISTS `role` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `name` VARCHAR(245) NOT NULL COMMENT '',
  `slug` VARCHAR(245) NULL COMMENT '',
  `description` TEXT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB");
    
    $this->execute("CREATE TABLE IF NOT EXISTS `user_role` (
  `role_id` INT NOT NULL COMMENT '',
  `user_id` INT(11) NOT NULL COMMENT '',
  PRIMARY KEY (`role_id`, `user_id`)  COMMENT '',
  INDEX `fk_role_has_user_user1_idx` (`user_id` ASC)  COMMENT '',
  INDEX `fk_role_has_user_role1_idx` (`role_id` ASC)  COMMENT '',
  CONSTRAINT `fk_role_has_user_role1`
    FOREIGN KEY (`role_id`)
    REFERENCES `role` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_role_has_user_user1`
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
    $this->dropTable('role');
    $this->dropTable('user_role');
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
