<?php
use yii\db\Migration;

class m190124_100000_workspace_key extends Migration
{

  /**
   * @inheritdoc
   */
  public function safeUp()
  {

    $this->execute("ALTER TABLE `workplace_educational_level`
      DROP FOREIGN KEY `fk_workplace_has_educational_level_educational_level1`,
      DROP FOREIGN KEY `fk_workplace_has_educational_level_workplace1`;
    ");

    $this->execute("ALTER TABLE `workplace_educational_level`
      ADD CONSTRAINT `fk_workplace_has_educational_level_educational_level1` FOREIGN KEY (`educational_level_id`) REFERENCES `educational_level` (`id`) ON UPDATE NO ACTION ON DELETE CASCADE,
      ADD CONSTRAINT `fk_workplace_has_educational_level_workplace1` FOREIGN KEY (`workplace_id`) REFERENCES `workplace` (`id`) ON UPDATE NO ACTION ON DELETE CASCADE;");
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
