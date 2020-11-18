<?php
namespace app\models\mgcms\db;

class ArticleElastic extends \yii\elasticsearch\ActiveRecord
{
  // Other class attributes and methods go here
  // ...

  /**
   * @return array This model's mapping
   */
  public static function mapping()
  {
    return [
        static::type() => [
            'properties' => [
                'rel_id' => ['type' => 'string'],
                'title' => ['type' => 'string'],
                'excerpt' => ['type' => 'string'],
                'content' => ['type' => 'string'],
                'slug' => ['type' => 'long'],
            ]
        ],
    ];
  }

  /**
   * Set (update) mappings for this model
   */
  public static function updateMapping()
  {
    $db = static::getDb();
    $command = $db->createCommand();
    $command->setMapping(static::index(), static::type(), static::mapping());
  }

  /**
   * Create this model's index
   */
  public static function createIndex()
  {
    $db = static::getDb();
    $command = $db->createCommand();
    $command->createIndex(static::index(), [
        'settings' => [/* ... */],
        'mappings' => static::mapping(),
        //'warmers' => [ /* ... */ ],
        //'aliases' => [ /* ... */ ],
        //'creation_date' => '...'
    ]);
  }

  /**
   * Delete this model's index
   */
  public static function deleteIndex()
  {
    $db = static::getDb();
    $command = $db->createCommand();
    $command->deleteIndex(static::index(), static::type());
  }
}
