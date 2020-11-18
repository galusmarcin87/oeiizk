<?php
namespace app\models\db;

use Yii;
use yii\web\UploadedFile;
use app\components\mgcms\MgHelpers;

/**
 * This is the base model class for table "training_template".
 *
 * @property integer $id
 * @property string $name
 * @property string $subtitle
 * @property integer $is_deleted
 * @property string $type
 * @property string $code_start
 * @property string $educational_level
 * @property string $training_gruop
 * @property string $training_path
 * @property integer $category_id
 * @property integer $subcategory_id
 * @property double $hours_local
 * @property double $hours_online
 * @property integer $meeting_default_number
 * @property integer $modules_default_number
 * @property integer $created_by
 * @property string $created_on
 * @property string $lead
 * @property integer $program_file_id
 * @property string $date_program_submission
 * @property string $date_last_program_modification
 * @property string $preliminary_recommendations
 * @property string $default_technical_requirements
 * @property string $default_social_requirements
 * @property integer $image_id
 * @property integer $image_2_id
 * @property string $keywords
 * @property string $default_price_category
 * @property string $visibility
 * @property string $default_certificate_lines
 * @property integer $default_minimal_participants_number
 * @property integer $default_maximal_participants_number
 * @property integer $is_login_required
 * @property integer $is_card_required
 * @property integer $is_certificate_issued
 * @property string $additional_information
 * @property string $comments
 * @property integer $sign_status
 * @property integer $poll_id
 * @property integer $article_id
 * @property integer $subject_id
 *
 * @property \app\models\db\Training[] $trainings
 * @property \app\models\db\Training[] $templateTrainings
 * @property \app\models\db\Training[] $templateFutureTrainings
 * @property \app\models\db\EducationalLevel[] $educationalLevels
 * @property \app\models\db\TrainingRequired[] $trainingRequireds
 * @property \app\models\db\TrainingTemplateEducationalLevel[] $trainingTemplateEducationalLevels
 * @property \app\models\mgcms\db\Article $article
 * @property \app\models\mgcms\db\Category $category
 * @property \app\models\mgcms\db\Category $subcategory
 * @property \app\models\mgcms\db\File $programFile
 * @property \app\models\mgcms\db\File $imageFile
 * @property \app\models\mgcms\db\File $imageFile2
 * @property \app\models\db\Poll $poll
 * @property \app\models\db\Subject $subject
 * @property \app\models\mgcms\db\User $createdBy
 */
class TrainingTemplate extends \app\models\mgcms\db\AbstractRecord
{

  use \app\components\mgcms\RelationTrait;
  use \app\models\mgcms\db\SoftDeleteTrait;

  const VISIBILITY_YES = 'Tak';
  const VISIBILITY_NO = 'Nie';
  const VISIBILITY_PASSWORD = 'Na hasło';
  const VISIBILITY_GROUP = 'Dla grupy';
  const VISIBILITY_ARCHIVED = 'Archiwalne';
  const VISIBILITY_IN_PREPARATION = 'W przygotowaniu';
  const VISIBILITIES = [
      self::VISIBILITY_YES,
      self::VISIBILITY_NO,
      self::VISIBILITY_PASSWORD,
      self::VISIBILITY_GROUP,
      self::VISIBILITY_ARCHIVED,
      self::VISIBILITY_IN_PREPARATION
  ];
  const SIGN_STATUS_YES = 0;
  const SIGN_STATUS_NO = 1;
  const SIGN_STATUS_BLOCKED = 2;
  const SIGN_STATUSES = [
      self::SIGN_STATUS_YES => 'Tak',
      self::SIGN_STATUS_NO => 'Nie',
      self::SIGN_STATUS_BLOCKED => 'Zablokowane',
  ];
  
  const TYPE_KONFERENCJA = 'konferencja';
  const TYPE_SIECI_WSPOLPRACY = 'sieć współpracy';

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
        [['name'], 'required'],
        [['category_id', 'subcategory_id', 'meeting_default_number', 'modules_default_number', 'created_by', 'default_minimal_participants_number', 'default_maximal_participants_number', 'poll_id', 'article_id', 'subject_id'], 'integer'],
        [['hours_local', 'hours_online'], 'number'],
        [['created_on', 'date_program_submission', 'date_last_program_modification', 'program_file_id', 'image_id', 'image_2_id'], 'safe'],
        [['lead', 'preliminary_recommendations', 'default_technical_requirements', 'default_social_requirements', 'keywords', 'default_certificate_lines', 'additional_information', 'comments'], 'string'],
        [['name'], 'string', 'max' => 255],
        [['subtitle', 'type', 'code_start', 'educational_level', 'training_gruop', 'training_path', 'default_price_category'], 'string', 'max' => 245],
        [['is_deleted', 'is_login_required', 'is_card_required', 'is_certificate_issued'], 'integer', 'max' => 1],
        [['visibility'], 'string', 'max' => 45],
        [['sign_status'], 'integer', 'max' => 3],
        [['hours_local','hours_online'],'required'],
        [['code_start'], 'unique'],
    ];
  }

  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'training_template';
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
        'id' => Yii::t('app', 'ID'),
        'name' => Yii::t('app', 'Name'),
        'subtitle' => Yii::t('app', 'Subtitle'),
        'is_deleted' => Yii::t('app', 'Is Deleted'),
        'type' => Yii::t('app', 'Type'),
        'code_start' => Yii::t('app', 'Początek kodu szkolenia'),
        'educational_level' => Yii::t('app', 'Educational Level'),
        'training_gruop' => Yii::t('app', 'Grupa szkoleń'),
        'training_path' => Yii::t('app', 'Ścieżka szkoleniowa'),
        'category_id' => Yii::t('app', 'Category'),
        'subcategory_id' => Yii::t('app', 'Subcategory'),
        'hours_local' => Yii::t('app', 'Liczba godzin stacjonarnych'),
        'hours_online' => Yii::t('app', 'Liczba godzin online'),
        'meeting_default_number' => Yii::t('app', 'Domyślna liczba spotkań'),
        'modules_default_number' => Yii::t('app', 'Domyślna liczba modułów'),
        'created_on' => Yii::t('app', 'Created On'),
        'lead' => Yii::t('app', 'Lead'),
        'program_file_id' => Yii::t('app', 'Program szkolenia'),
        'programFile' => Yii::t('app', 'Program szkolenia'),
        'date_program_submission' => Yii::t('app', 'Data wprowadzenia programu szkolenia'),
        'date_last_program_modification' => Yii::t('app', 'Data ostatniej modyfikacji programu'),
        'preliminary_recommendations' => Yii::t('app', 'Zalecenia wstępne'),
        'default_technical_requirements' => Yii::t('app', 'Domyślne wymagania techniczne'),
        'default_social_requirements' => Yii::t('app', 'Domyślne wymagania socjalne'),
        'image_id' => Yii::t('app', 'Obrazek do oferty'),
        'imageFile' => Yii::t('app', 'Obrazek do oferty'),
        'image_2_id' => Yii::t('app', 'Obrazek do Moodla'),
        'imageFile2' => Yii::t('app', 'Obrazek do Moodla'),
        'keywords' => Yii::t('app', 'Keywords'),
        'default_price_category' => Yii::t('app', 'Domyślna kategoria cennika'),
        'visibility' => Yii::t('app', 'Visibility'),
        'default_certificate_lines' => Yii::t('app', 'Domyślne linijki do zaświadczeń'),
        'default_minimal_participants_number' => Yii::t('app', 'Domyślna minimalna liczba uczestników'),
        'default_maximal_participants_number' => Yii::t('app', 'Domyślna maksymalna liczba uczestników'),
        'is_login_required' => Yii::t('app', 'Logowanie wymagane'),
        'is_card_required' => Yii::t('app', 'Czy potrzebna karta'),
        'is_certificate_issued' => Yii::t('app', 'Czy wydawane są zaświadczenia '),
        'additional_information' => Yii::t('app', 'Informacja dodatkowa dla DOS'),
        'comments' => Yii::t('app', 'Uwagi'),
        'sign_status' => Yii::t('app', 'Możliwość zapisu na szkolenie'),
        'poll_id' => Yii::t('app', 'Poll'),
        'article_id' => Yii::t('app', 'Article'),
        'subject_id' => Yii::t('app', 'Subject'),
    ];
  }
  
  /**
   * @return \yii\db\ActiveQuery
   */
  public function getTrainings()
  {
    return $this->hasMany(\app\models\db\Training::className(), ['id' => 'training_id'])->viaTable('training_required', ['training_2_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getEducationalLevels()
  {
    return $this->hasMany(\app\models\db\EducationalLevel::className(), ['id' => 'educational_level_id'])->viaTable('training_template_educational_level', ['training_template_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getTemplateTrainings()
  {
    return $this->hasMany(\app\models\db\Training::className(), ['training_template_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getTemplateFutureTrainings()
  {
    $user = MgHelpers::getUserModel();
    $groupCondition = [];
    if($user && $user->groups){
      $groupsIds = [];
      foreach($user->groups as $group){
        $groupsIds[] = $group->id;
      }
      $groupCondition = ['in','training.group_id',$groupsIds];
    }
    
    return $this->hasMany(\app\models\db\Training::className(), ['training_template_id' => 'id'])
            ->andWhere(['>', 'date_start', new \yii\db\Expression('now()')])
            ->andWhere(['OR', ['status' => Training::STATUS_SIGN_TIME], ['sign_status' => Training::SIGN_STATUS_YES]])
            ->andWhere(['or',['training.visibility' => Training::VISIBILITY_YES], $groupCondition])
            ->orderBy(['date_start' => SORT_ASC]);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getTrainingRequireds()
  {
    return $this->hasMany(\app\models\db\TrainingRequired::className(), ['training_2_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getTrainingTemplateEducationalLevels()
  {
    return $this->hasMany(TrainingTemplateEducationalLevel::className(), ['training_template_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getArticle()
  {
    return $this->hasOne(\app\models\mgcms\db\Article::className(), ['id' => 'article_id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getCategory()
  {
    return $this->hasOne(\app\models\mgcms\db\Category::className(), ['id' => 'category_id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getSubcategory()
  {
    return $this->hasOne(\app\models\mgcms\db\Category::className(), ['id' => 'subcategory_id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getProgramFile()
  {
    return $this->hasOne(\app\models\mgcms\db\File::className(), ['id' => 'program_file_id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getImageFile()
  {
    return $this->hasOne(\app\models\mgcms\db\File::className(), ['id' => 'image_id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getImageFile2()
  {
    return $this->hasOne(\app\models\mgcms\db\File::className(), ['id' => 'image_2_id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getPoll()
  {
    return $this->hasOne(\app\models\db\Poll::className(), ['id' => 'poll_id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getSubject()
  {
    return $this->hasOne(\app\models\db\Subject::className(), ['id' => 'subject_id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getCreatedBy()
  {
    return $this->hasOne(\app\models\mgcms\db\User::className(), ['id' => 'created_by']);
  }

  /**
   * 
   * @param EducationalLevel $educationalLevelModel
   * @return boolean
   */
  public function hasEducationalLevel($educationalLevelModel)
  {

    foreach ($this->educationalLevels as $educationalLevel) {
      if ($educationalLevel->id == $educationalLevelModel->id) {
        return true;
      }
    }

    return false;
  }
}
