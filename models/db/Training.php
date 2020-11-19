<?php
namespace app\models\db;

use Yii;
use app\components\mgcms\MgHelpers;

/**
 * This is the base model class for table "training".
 *
 * @property integer $id
 * @property string $name
 * @property string $subtitle
 * @property string $created_on
 * @property integer $created_by
 * @property integer $is_deleted
 * @property integer $training_template_id
 * @property string $code
 * @property integer $meeting_number
 * @property integer $module_number
 * @property string $date_start
 * @property string $date_end
 * @property string $technical_requirements
 * @property string $social_requirements
 * @property string $visibility
 * @property string $certificate_lines
 * @property integer $minimal_participants_number
 * @property integer $maximal_participants_number
 * @property integer $final_maximal_participants_number
 * @property integer $is_login_required
 * @property string $status
 * @property integer $is_card_required
 * @property string $is_certificate_issued
 * @property string $additional_information
 * @property string $comments
 * @property integer $sign_status
 * @property integer $is_promoted_oeiizk
 * @property integer $is_promoted_pos
 * @property integer $file_id
 * @property integer $poll_id
 * @property string $link_to_materials
 * @property integer $article_id
 * @property integer $subject_id
 * @property string $project
 * @property integer $is_display_on_screen
 * @property integer $lab_id
 * @property string $price_category
 * @property string $link
 * @property string $url
 * @property integer $group_id
 * @property string $lectorsStr
 * @property string $lectorsStrNewLines
 * @property string $delegacy
 * @property string $city
 * @property date $poll_from
 * @property date $poll_to
 * @property string $certificate_template
 *
 * @property \app\models\db\Lesson[] $lessons
 * @property \app\models\db\Lesson[] $lessonsDateAsc
 * @property \app\models\mgcms\db\Article $article
 * @property \app\models\mgcms\db\File $file
 * @property \app\models\db\Lab $lab
 * @property \app\models\db\Poll $poll
 * @property \app\models\db\Subject $subject
 * @property \app\models\db\TrainingTemplate $trainingTemplate
 * @property \app\models\mgcms\db\User $createdBy
 * @property \app\models\db\TrainingLector[] $trainingLectors
 * @property \app\models\mgcms\db\User[] $lectors
 * @property \app\models\db\TrainingModule[] $trainingModules
 * @property \app\models\db\TrainingModule[] $trainingModulesDateAsc
 * @property \app\models\db\TrainingParticipant[] $trainingParticipants
 * @property \app\models\db\TrainingParticipant[] $trainingParticipantsNonReserve
 * @property \app\models\db\TrainingParticipant[] $trainingParticipantsReserve
 * @property \app\models\db\TrainingRequired[] $trainingRequireds
 * @property \app\models\db\Training[] $trainingTrainings
 * @property \app\models\db\TrainingTrainingDirection[] $trainingTrainingDirections
 * @property \app\models\db\TrainingDirection[] $trainingDirections
 * @property \app\models\db\Workshop[] $workshops
 * @property \app\models\db\Group $group
 * @property \app\models\mgcms\db\User[] $participants
 */
class Training extends \app\models\mgcms\db\AbstractRecord
{

  use \app\components\mgcms\RelationTrait;
  use \app\models\mgcms\db\SoftDeleteTrait;

  public $relationsToDelete = ['lessons', 'trainingModules', 'workshops'];

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
  const STATUS_PROJECT = 'projekt';
  const STATUS_SIGN_TIME = 'czas zapisu';
  const STATUS_AFTER_SIGNS = 'po zapisach';
  const STATUS_CONFIRMATIONS = 'potwierdzenia';
  const STATUS_CONFIRMED = 'zatwierdzone do realizacji';
  const STATUS_LAUNCHED = 'uruchomione';
  const STATUS_ENDED = 'zakończone';
  const STATUS_CANCELED = 'odwołane';
  const STATUS_CLOSED = 'zamknięte';
  const STATUS_WAITINGROOM = 'poczekalnia';
  const STATUSES = [
      self::STATUS_PROJECT => self::STATUS_PROJECT,
      self::STATUS_SIGN_TIME => self::STATUS_SIGN_TIME,
      self::STATUS_AFTER_SIGNS => self::STATUS_AFTER_SIGNS,
      self::STATUS_CONFIRMATIONS => self::STATUS_CONFIRMATIONS,
      self::STATUS_CONFIRMED => self::STATUS_CONFIRMED,
      self::STATUS_LAUNCHED => self::STATUS_LAUNCHED,
      self::STATUS_ENDED => self::STATUS_ENDED,
      self::STATUS_CANCELED => self::STATUS_CANCELED,
      self::STATUS_CLOSED => self::STATUS_CLOSED,
      self::STATUS_WAITINGROOM => self::STATUS_WAITINGROOM,
  ];

  public $password;

//   private $_rt_softdelete;
//   
//  function __construct(){
//       $this->_rt_softdelete = [
//           'is_deleted' => 1
//       ];
//  }

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
        [['name', 'training_template_id', 'maximal_participants_number'], 'required'],
        [['created_on', 'date_start', 'date_end', 'price_category', 'poll_from', 'poll_to', 'certificate_template'], 'safe'],
        [['created_by', 'training_template_id', 'meeting_number', 'module_number', 'minimal_participants_number', 'maximal_participants_number', 'final_maximal_participants_number', 'file_id', 'poll_id', 'article_id', 'subject_id', 'lab_id', 'group_id'], 'integer'],
        [['technical_requirements', 'social_requirements', 'certificate_lines', 'additional_information', 'comments'], 'string'],
        [['name', 'subtitle', 'link_to_materials', 'project', 'delegacy', 'city'], 'string', 'max' => 245],
        [['is_deleted', 'is_login_required', 'is_card_required', 'is_promoted_oeiizk', 'is_promoted_pos', 'is_display_on_screen', 'is_certificate_issued'], 'integer', 'max' => 1],
        [['code', 'visibility', 'status'], 'string', 'max' => 45],
        [['sign_status'], 'integer', 'max' => 3],
        [['date_start'], 'validateDates'],
        [['meeting_number'], 'validateMeetingNumber'],
        [['module_number'], 'validateModulesNumber'],
        [['maximal_participants_number'], 'compare', 'compareValue' => 0, 'operator' => '>'],
        //[['code'], 'unique'],
    ];
  }

  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'training';
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
        'created_on' => Yii::t('app', 'Created On'),
        'is_deleted' => Yii::t('app', 'Is Deleted'),
        'training_template_id' => Yii::t('app', 'Training Template'),
        'training_template' => Yii::t('app', 'Training Template'),
        'code' => Yii::t('app', 'Code'),
        'meeting_number' => Yii::t('app', 'Liczba spotkań'),
        'module_number' => Yii::t('app', 'Liczba modułów'),
        'price_category' => Yii::t('app', 'Kategoria cennika'),
        'date_start' => Yii::t('app', 'Date Start'),
        'date_end' => Yii::t('app', 'Date End'),
        'technical_requirements' => Yii::t('app', 'Wymagania techniczne'),
        'social_requirements' => Yii::t('app', 'Wymagania socjalne'),
        'visibility' => Yii::t('app', 'Visibility'),
        'certificate_lines' => Yii::t('app', 'Linijki do zaświadczeń'),
        'minimal_participants_number' => Yii::t('app', 'Minimalna liczba uczestników'),
        'maximal_participants_number' => Yii::t('app', 'Maksymalna liczba uczestników'),
        'final_maximal_participants_number' => Yii::t('app', 'Ostatecznie maksymalna liczba uczestników'),
        'is_login_required' => Yii::t('app', 'Is Login Required'),
        'status' => Yii::t('app', 'Status'),
        'is_card_required' => Yii::t('app', 'Czy potrzebna karta'),
        'is_certificate_issued' => Yii::t('app', 'Czy wydawane są zaświadczenia '),
        'additional_information' => Yii::t('app', 'Informacja dodatkowa dla DOS'),
        'comments' => Yii::t('app', 'Uwagi'),
        'sign_status' => Yii::t('app', 'Możliwość zapisu na szkolenie'),
        'is_promoted_oeiizk' => Yii::t('app', 'Promowane na stronie Oeiizk'),
        'is_promoted_pos' => Yii::t('app', 'Promowane na stronie POS'),
        'file_id' => Yii::t('app', 'File'),
        'file' => Yii::t('app', 'Link do materiałów'),
        'poll_id' => Yii::t('app', 'Poll'),
        'poll' => Yii::t('app', 'Poll'),
        'link_to_materials' => Yii::t('app', 'Link do materiałów'),
        'article_id' => Yii::t('app', 'Article'),
        'article' => Yii::t('app', 'Article'),
        'subject_id' => Yii::t('app', 'Subject'),
        'subject' => Yii::t('app', 'Subject'),
        'project' => Yii::t('app', 'Project'),
        'is_display_on_screen' => Yii::t('app', 'Wyświetlany na monitorach na korytarzu'),
        'lab_id' => Yii::t('app', 'Lab'),
        'lab' => Yii::t('app', 'Lab'),
        'group_id' => Yii::t('app', 'Group'),
        'group' => Yii::t('app', 'Group'),
        'schoolYear' => 'Rok szkolny',
        'delegacy' => Yii::t('app', 'Delegacy'),
        'city' => Yii::t('app', 'City'),
        'lectorsStr' => 'Prowadzący',
        'poll_from' => 'Ankieta ważna od',
        'poll_to' => 'Ankieta ważna do',
        'certificate_template' => 'Szablon zaświadczenia',
    ];
  }

  public function validateDates($attribute, $params)
  {
    if (!$this->hasErrors()) {
      if (strtotime($this->date_start) > strtotime($this->date_end)) {
        $this->addError($attribute, 'Data od musi być wcześniejsza niż data do');
      }

      if ($this->date_start && $this->date_end) {
        foreach ($this->lessons as $lesson) {
          if (strtotime($this->date_start) > strtotime($lesson->date_start)) {
            $this->addError($attribute, "Data od zajęć $lesson jest wcześniejsza niż data od szkolenia");
          }

          if (strtotime($this->date_end . ' 23:59:59') < strtotime($lesson->date_end)) {
            $this->addError('date_end', "Data do zajęć $lesson jest późniejsza niż data od szkolenia");
          }
        }

          foreach ($this->trainingModules as $module) {
              if (strtotime($this->date_start) > strtotime($module->date_start)) {
                  $this->addError($attribute, "Data od zajęć $module jest wcześniejsza niż data od szkolenia");
              }

              if (strtotime($this->date_end . ' 23:59:59') < strtotime($module->date_end)) {
                  $this->addError('date_end', "Data do zajęć $module jest późniejsza niż data od szkolenia");
              }
          }
      }
    }
  }

  public function validateMeetingNumber($attribute, $params)
  {
    if (!$this->hasErrors()) {
      if (sizeof($this->lessons) > $this->meeting_number) {
        $this->addError($attribute, 'Ilość zajęć większa niż deklarowana');
      }
    }
  }

  public function validateModulesNumber($attribute, $params)
  {
    if (!$this->hasErrors()) {
      if (sizeof($this->trainingModules) > $this->module_number) {
        $this->addError($attribute, 'Ilość modułów większa niż deklarowana');
      }
    }
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getLessons()
  {
    return $this->hasMany(\app\models\db\Lesson::className(), ['training_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getLessonsDateAsc()
  {
    return $this->hasMany(\app\models\db\Lesson::className(), ['training_id' => 'id'])->orderBy(['date_start' => SORT_ASC]);
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
  public function getFile()
  {
    return $this->hasOne(\app\models\mgcms\db\File::className(), ['id' => 'file_id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getLab()
  {
    return $this->hasOne(\app\models\db\Lab::className(), ['id' => 'lab_id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getGroup()
  {
    return $this->hasOne(\app\models\db\Group::className(), ['id' => 'group_id']);
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
  public function getTrainingTemplate()
  {
    return $this->hasOne(\app\models\db\TrainingTemplate::className(), ['id' => 'training_template_id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getCreatedBy()
  {
    return $this->hasOne(\app\models\mgcms\db\User::className(), ['id' => 'created_by']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getTrainingLectors()
  {
    return $this->hasMany(\app\models\db\TrainingLector::className(), ['training_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getLectors()
  {
    return $this->hasMany(\app\models\mgcms\db\User::className(), ['id' => 'user_id'])->viaTable('training_lector', ['training_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getParticipants()
  {
    return $this->hasMany(\app\models\mgcms\db\User::className(), ['id' => 'user_id'])->viaTable('training_participant', ['training_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getTrainingModules()
  {
    return $this->hasMany(\app\models\db\TrainingModule::className(), ['training_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getTrainingModulesDateAsc()
  {
    return $this->hasMany(\app\models\db\TrainingModule::className(), ['training_id' => 'id'])->orderBy(['date_start' => SORT_ASC]);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getTrainingParticipants()
  {
    return $this->hasMany(\app\models\db\TrainingParticipant::className(), ['training_id' => 'id'])->orderBy(['order' => SORT_ASC]);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getTrainingParticipantsNonReserve()
  {
    return $this->hasMany(\app\models\db\TrainingParticipant::className(), ['training_id' => 'id'])->andWhere(['!=', 'status', TrainingParticipant::STATUS_RESERVE]);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getTrainingParticipantsReserve()
  {
    return $this->hasMany(\app\models\db\TrainingParticipant::className(), ['training_id' => 'id'])->andWhere(['status' => TrainingParticipant::STATUS_RESERVE]);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getTrainingRequireds()
  {
    return $this->hasMany(\app\models\db\TrainingRequired::className(), ['training_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getTrainingTrainings()
  {
    return $this->hasMany(\app\models\db\Training::className(), ['id' => 'training_2_id'])->viaTable('training_required', ['training_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getTrainingTrainingDirections()
  {
    return $this->hasMany(\app\models\db\TrainingTrainingDirection::className(), ['training_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getTrainingDirections()
  {
    return $this->hasMany(\app\models\db\TrainingDirection::className(), ['id' => 'training_direction_id'])->viaTable('training_training_direction', ['training_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getWorkshops()
  {
    return $this->hasMany(\app\models\db\Workshop::className(), ['training_id' => 'id']);
  }

  public function inheritFromTemplate()
  {

    $this->code = $this->trainingTemplate->code_start . '-' . (sizeof($this->trainingTemplate->templateTrainings) + 1);
    $this->attributes = $this->trainingTemplate->attributes;
    $inheritDefaultAttributes = [
        'meeting_default_number' => 'meeting_number',
        'modules_default_number' => 'module_number',
        'default_technical_requirements' => 'technical_requirements',
        'default_social_requirements' => 'social_requirements',
        'default_price_category' => 'price_category',
        'default_certificate_lines' => 'certificate_lines',
        'default_minimal_participants_number' => 'minimal_participants_number',
        'default_maximal_participants_number' => 'maximal_participants_number',
        'default_certificate_lines' => 'certificate_lines',
    ];
    foreach ($inheritDefaultAttributes as $attributeFrom => $attributeTo) {
      $this->setAttribute($attributeTo, $this->trainingTemplate->getAttribute($attributeFrom));
    }
  }

  public function getUrl()
  {
    return \yii\helpers\Url::to(['/training/view', 'code' => $this->code], true);
  }

  public function getLink()
  {
    return \yii\helpers\Html::a((string) $this, $this->url);
  }

  /**
   * 
   * @return Training[]
   */
  public static function getIncomingTrainings()
  {
    $query = self::find()
        ->andWhere(['visibility' => self::VISIBILITY_YES])
        ->andWhere(['>', 'date_start', new \yii\db\Expression('NOW()')]);

    return $query->all();
  }

  public static function getIncomingTrainingsJSON($attributes = ['name', 'code', 'link'])
  {
    $trainingsArr = [];
    $incomingTrainings = self::getIncomingTrainings();
    foreach ($incomingTrainings as $training) {
      $item = [];
      foreach ($attributes as $attribute) {
        $item[$attribute] = $training->$attribute;
      }
      $trainingsArr[] = $item;
    }

    return \yii\helpers\Json::encode($trainingsArr);
  }

  static function getPriceCategoryDropdownListOptions()
  {
    $arr = \app\components\mgcms\MgHelpers::getSettingOptionArray('Kategorie cennika');
    $res = [];
    foreach ($arr as $item) {
      $exp = explode(':', $item);
      if (sizeof($exp) == 2) {
        $res[$exp[0]] = $exp[1];
      }
    }
    return $res;
  }

  public function checkAccess()
  {
    $user = MgHelpers::getUserModel();
    if ($this->created_by == $user->id) {
      return true;
    }
    if (\app\components\mgcms\OeiizkHelpers::isRole(\app\models\mgcms\db\User::ROLE_LECTOR)) {
      if (!MgHelpers::isExistModelInModelsArrayById($this->lectors, MgHelpers::getUserModel()->id)) {
        return false;
      }
    }

    return true;
  }

  public function getLectorsStr()
  {
    return join(', ', array_map(function($x) {
          return (string) $x->toStringWithAcademicTitle;
        }, $this->getLectors()->all()));
  }
  
  public function getLectorsStrNewLines()
  {
    return join('<br/>', array_map(function($x) {
          return (string) $x->toStringWithAcademicTitle;
        }, $this->getLectors()->all()));
  }

  public function __toString()
  {
    return "$this->code $this->name";
  }

  public function isRegisteringAvailable()
  {
    return (strtotime($this->date_end) > strtotime('now') || $this->isWaitingRoom())
    && (($this->status == self::STATUS_SIGN_TIME || $this->sign_status == self::SIGN_STATUS_YES) || sizeof($this->workshops) > 0);
  }

  /**
   * 
   * @param \app\models\mgcms\db\User $user
   */
  public function checkIfUserPassedRequiredTrainings($user)
  {
    foreach ($this->trainingRequireds as $requiredTraining) {
      $passed = false;
      if ($requiredTraining->trainingRequired) {
        foreach ($requiredTraining->trainingRequired->trainingTemplate->templateTrainings as $training) {
          $tp = $user->isTrainingParticipant($training);
          if ($tp && $tp->is_passed) {
            $passed = true;
          }
        }
      }
      if (!$passed) {
        return false;
      }
    }

    return true;
  }

  public function save($runValidaton = true, $attributes = null)
  {
    if (!$this->isNewRecord && $this->oldAttributes['status'] == self::STATUS_AFTER_SIGNS && $this->attributes['status'] == self::STATUS_CONFIRMATIONS) {
      $emails = [];
      $emailValidator = new \yii\validators\EmailValidator;

      foreach ($this->trainingParticipants as $participant) {
        if ($emailValidator->validate($participant->user->email)) {
          $emails[] = $participant->user->email;
        }
      }
      /* @var $mailer \yii\swiftmailer\Mailer */
      $mailer = Yii::$app->mailer->compose('trainingStatusChangedConfirmations', [
              'model' => $this,
          ])
          ->setBcc($emails)
//            ->setTo('galusmarcin87@gmail.com')
          ->setFrom([MgHelpers::getSetting('register_email') => MgHelpers::getSetting('register_email_name')])
          ->setSubject('POS OEIiZK - szkolenie w fazie potwierdzeń');
      $sent = $mailer->send();
    }

    return parent::save($runValidaton, $attributes);
  }

  public function checkFrontAccess()
  {
    if($this->is_promoted_pos && $this->sign_status == 0){
      return true;
    }
    switch ($this->visibility) {
      case self::VISIBILITY_YES:
        return true;
        break;
      case self::VISIBILITY_NO:
      case self::VISIBILITY_ARCHIVED:
      case self::VISIBILITY_IN_PREPARATION:
        return false;
        break;
      case self::VISIBILITY_PASSWORD:
        return $this->id == MgHelpers::decrypt($this->password);
        break;

      case self::VISIBILITY_GROUP:
        $user = MgHelpers::getUserModel();
        if (!$user) {
          return false;
        }
        return in_array($this->group, $user->groups);
        break;
      default:
        return true;
        break;
    }
  }

  /**
   * 
   * @param \app\models\mgcms\db\User $user
   * @return boolean
   */
  public function checkIfUserDontHaveWorkshopsInTime($user)
  {

    if (sizeof($this->workshops) > 0) {
      foreach ($user->trainingsViaParticipant as $training) {
        foreach ($training->workshops as $userWorkshop) {
          foreach ($this->workshops as $workshop) {
            if (MgHelpers::checkIfDateOverlap($workshop->date_start, $workshop->date_end, $userWorkshop->date_start, $userWorkshop->date_end)) {
              return false;
            }
          }
        }
      }
    }
    return true;
  }

  public function isWaitingRoom()
  {
    return $this->status == self::STATUS_WAITINGROOM;
  }

  public function isConference()
  {
    return $this->trainingTemplate && $this->trainingTemplate->type == TrainingTemplate::TYPE_KONFERENCJA;
  }

  public function isDirectionSupport(TrainingDirection $direction)
  {
    foreach ($this->trainingDirections as $trainingDirection) {
      if ($trainingDirection->id == $direction->id) {
        return true;
      }
    }
    return false;
  }

  public function isPollActive()
  {
    return $this->poll_to && $this->poll_from && strtotime('now') > strtotime($this->poll_from) && strtotime('now') < strtotime($this->poll_to . '23:59:59');
  }
}
