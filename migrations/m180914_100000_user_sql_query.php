<?php
use yii\db\Migration;


class m180914_100000_user_sql_query extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->execute("CREATE TABLE IF NOT EXISTS `sql_query_user` (
  `sql_query_id` INT NOT NULL,
  `user_id` INT(11) NOT NULL,
  PRIMARY KEY (`sql_query_id`, `user_id`),
  INDEX `fk_sql_query_has_user_user1_idx` (`user_id` ASC),
  INDEX `fk_sql_query_has_user_sql_query1_idx` (`sql_query_id` ASC),
  CONSTRAINT `fk_sql_query_has_user_sql_query1`
    FOREIGN KEY (`sql_query_id`)
    REFERENCES `sql_query` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sql_query_has_user_user1`
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
    $this->dropTable('sql_query_user');
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
