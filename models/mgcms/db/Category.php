<?php
namespace app\models\mgcms\db;

use \app\models\mgcms\db\base\Category as BaseCategory;
use yii\behaviors\SluggableBehavior;

/**
 * This is the base model class for table "category".
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $type
 * @property integer $parent_id
 * @property integer $order
 * @property integer $promoted
 * @property string $custom
 * @property string $language
 * @property string $url
 * @property integer $group_id
 *
 * @property \app\models\mgcms\db\Category $parent
 * @property \app\models\mgcms\db\Category[] $categories
 * @property \app\models\db\Group $group
 */
class Category extends BaseCategory
{

  const TYPE_ARTICLE = 'article';
  const TYPE_TRAINING = 'training';
  const TYPES = [
      Category::TYPE_ARTICLE,
      Category::TYPE_TRAINING,
  ];

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return array_replace_recursive(parent::rules(), [
        [['name', 'slug'], 'required'],
        [['parent_id', 'order', 'promoted', 'group_id'], 'integer'],
        [['custom', 'language'], 'string'],
        [['name', 'slug', 'type'], 'string', 'max' => 245]
    ]);
  }

  public function behaviors()
  {
    return [
        [
            'class' => SluggableBehavior::className(),
            'attribute' => 'name',
            'slugAttribute' => 'slug',
        ],
    ];
  }

  public function __toString()
  {
    $parent = $this->parent ? $this->parent . ' - ' : '';
    return $parent . $this->name;
  }

  public function getUrl()
  {
    return \app\components\mgcms\MgHelpers::createUrl(['/article/category', 'categorySlug' => $this->getCategorySlugUrl()]);
  }

  public function getCategorySlugUrl()
  {
    $str = '/';
    if ($this->parent) {
      $str .= $this->parent->getUrl() . '/';
    }

    return $str . $this->slug;
  }

  public function getLink()
  {
    return \kartik\helpers\Html::a((string) $this, ['/article/category', 'categorySlug' => $this->getCategorySlugUrl()]);
  }

  /**
   * 
   * @param string $$fullCategorySlug
   * @return Category
   */
  public static function findByUrl($fullCategorySlug)
  {
    $categorySlugs = explode('/', $fullCategorySlug);
    $categorySlug = $categorySlugs[sizeof($categorySlugs) - 1];
    $categories = Category::findAll(['slug' => $categorySlug]);
    if (sizeof($categories) === 1) {
      return $categories[0];
    } else {
      unset($categorySlugs[sizeof($categorySlugs) - 1]);
      foreach ($categories as $category) {
        $parentCategory = self::findByUrl(implode('/', $categorySlugs));
        if ($parentCategory->id === $category->id) {
          return $category;
        }
      }
      return $categories[0];
    }
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getGroup()
  {
    return $this->hasOne(\app\models\db\Group::className(), ['id' => 'group_id']);
  }
}
