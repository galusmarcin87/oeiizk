<?php
namespace app\models\mgcms\db;

use Yii;
use yii\web\IdentityInterface;
use \app\models\db\UserPassword;
use kartik\password\StrengthValidator;
use app\components\mgcms\MgHelpers;
use yii\web\UploadedFile;

/**
 * This is the base model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property string $role
 * @property integer $status
 * @property string $email
 * @property string $created_on
 * @property string $last_login
 * @property integer $created_by
 * @property string $address
 * @property string $postcode
 * @property string $birthdate
 * @property string $city
 * @property string $auth_key
 * @property string $date_last_password_change
 * @property integer $is_password_change_accepted
 * @property string $other_names
 * @property integer $gender
 * @property string $date_email_confirmation
 * @property string $birth_place
 * @property string $position
 * @property string $educational_level
 * @property integer $employment_card_id
 * @property string $date_card_verification
 * @property string $date_card_submission
 * @property string $academic_title
 * @property string $phone
 * @property integer $is_special_account
 * @property integer $credibilityCalc 
 * @property integer $is_newsletter
 * @property string $comments
 * @property integer $is_deleted
 * @property integer $is_not_logged_account
 * @property string $training_preferences
 * @property string $training_preferences_keywords
 * @property string $create_account_additional_data
 * @property string $institutionsStr
 * @property string $rolesStr
 * @property string $groupsStr
 * @property string $subjectsStr
 * @property string $educationalLevelsStr
 * @property string $toStringWithAcademicTitle
 * @property boolean $is_profiled_offer_enabled

 *
 * @property \app\models\mgcms\db\Agreement[] $agreements
 * @property \app\models\mgcms\db\Article[] $articles
 * @property \app\models\mgcms\db\Event[] $events
 * @property \app\models\mgcms\db\Gallery[] $galleries
 * @property \app\models\mgcms\db\Group[] $groups
 * @property \app\models\db\Institution[] $institutions
 * @property \app\models\db\Institution $firstInstitution
 * @property string $firstInstitutionStr
 * @property string $firstInstitutionCode
 * @property \app\models\db\Lab[] $labs
 * @property \app\models\db\Lesson[] $lessons
 * @property \app\models\db\LessonPresence[] $lessonPresences
 * @property \app\models\db\Lesson[] $trainingLessons
 * @property \app\models\db\UserEducationalLevel[] $userEducationalLevels
 * @property \app\models\db\EducationalLevel[] $educationalLevels
 * @property \app\models\mgcms\db\Log[] $logs
 * @property \app\models\mgcms\db\Message[] $messages
 * @property \app\models\db\ModificationHistory[] $modificationHistories
 * @property \app\models\db\Newsletter[] $newsletters
 * @property \app\models\db\NewsletterUser[] $newsletterUsers
 * @property \app\models\db\PolQuestionAnswer[] $polQuestionAnswers
 * @property \app\models\db\Poll[] $polls
 * @property \app\models\db\PollQuestion[] $pollQuestions
 * @property \app\models\db\PollTemplate[] $pollTemplates
 * @property \app\models\db\SmsTemplate[] $smsTemplates
 * @property \app\models\db\SqlQuery[] $sqlQueries
 * @property \app\models\db\Subject[] $subjects
 * @property \app\models\db\Training[] $trainings
 * @property \app\models\db\TrainingDirection[] $trainingDirections
 * @property \app\models\db\TrainingLector[] $trainingLectors
 * @property \app\models\db\TrainingModule[] $trainingModules
 * @property \app\models\db\TrainingModulePresence[] $trainingModulePresences
 * @property \app\models\db\TrainingParticipant[] $trainingParticipants
 * @property \app\models\db\TrainingTemplate[] $trainingTemplates
 * @property \app\models\mgcms\db\File $employmentCard
 * @property \app\models\mgcms\db\User $createdBy
 * @property \app\models\mgcms\db\User[] $users
 * @property \app\models\db\UserAgreement[] $userAgreements
 * @property \app\models\mgcms\db\UserGroup[] $userGroups
 * @property \app\models\mgcms\db\UserPassword[] $userPasswords
 * @property \app\models\mgcms\db\UserRole[] $userRoles
 * @property \app\models\mgcms\db\Role[] $roles
 * @property \app\models\mgcms\db\UserSubject[] $userSubjects
 * @property \app\models\db\Workplace[] $workplaces
 * @property \app\models\db\Workshop[] $workshops
 * @property \app\models\db\WorkshopLector[] $workshopLectors
 * @property \app\models\db\WorkshopUser[] $workshopUsers
 * @property \app\models\db\Training[] $trainingsViaParticipant
 * @property \app\models\db\Training[] $threeLastTrainingsParticipants
 */
class User extends \app\models\mgcms\db\AbstractRecord implements IdentityInterface
{

  use SoftDeleteTrait;

  const ROLE_ADMIN = 'admin';
  const ROLE_USER = 'user';
  const ROLES = [
      self::ROLE_ADMIN,
      self::ROLE_USER
  ];
  const STATUS_ACTIVE = 1;
  const STATUS_INACTIVE = 0;
  const STATUS_SUSPENDED = 2;
  const STATUS_DUPLICATED = 3;
  const STATUS_TEMPORARY_USER = 4;
  const STATUSES = [
      self::STATUS_ACTIVE => 'active',
      self::STATUS_INACTIVE => 'inactive',
      self::STATUS_SUSPENDED => 'suspended',
      self::STATUS_DUPLICATED => 'duplicated',
      self::STATUS_TEMPORARY_USER => 'temporary',
  ];
  const GENDER_MALE = 1;
  const GENDER_FEMALE = 2;
  const GENDERS = [
      self::GENDER_MALE => 'male',
      self::GENDER_FEMALE => 'female',
  ];
  const ROLES_CHECK_EXPIRY = [
      self::ROLE_ADMIN
  ];

  public $auths = false;
  public $roleChosen;
  public $passwordRepeat;
  public $oldFormPassword;
  private $oldPassword;

  const ROLE_WORKER = 'pracownik';
  const ROLE_DOS = 'dos';
  const ROLE_LECTOR = 'wykladowca';
  const ROLE_DIRECTOR = 'dyrektor';
  const ROLE_COACH = 'trener';

  public $uploadEmploymentFile;
  public $acceptTerms;
  public $scenarioDelete = false;
  
  public $importTrainingIds = false;
  public $importUserId = false;

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
        [['username', 'password'], 'required', 'except' => 'myAccount'],
        [['created_on', 'last_login', 'birthdate', 'date_last_password_change', 'date_email_confirmation', 'date_card_verification', 'date_card_submission', 'acceptTerms'], 'safe'],
        [['created_by', 'employment_card_id', 'credibility', 'status'], 'integer'],
        [['comments', 'training_preferences'], 'string'],
        [['username', 'password', 'first_name', 'last_name', 'email', 'address', 'postcode', 'city', 'create_account_additional_data'], 'string', 'max' => 245],
        [['role'], 'string', 'max' => 45],
        [['auth_key'], 'string', 'max' => 60],
        [['is_password_change_accepted', 'is_special_account', 'is_newsletter', 'is_deleted', 'is_not_logged_account', 'importTrainingIds', 'is_profiled_offer_enabled', 'importUserId'], 'safe'],
        [['other_names', 'birth_place', 'position', 'educational_level', 'academic_title', 'phone', 'training_preferences_keywords'], 'string', 'max' => 255],
        [['gender'], 'integer', 'max' => 2],
        [['username', 'email'], 'unique'],
        [['email'], 'email'],
        [['password'], StrengthValidator::className(),
            'min' => (int) MgHelpers::getSetting('hasło minimalna ilość znaków', false, 8),
            'digit' => (int) MgHelpers::getSetting('hasło minimalna ilość cyfr', false, 1),
            'special' => (int) MgHelpers::getSetting('hasło minimalna ilość znaków specjalnych', false, 1),
            'upper' => (int) MgHelpers::getSetting('hasło minimalna ilość wielkich liter', false, 1),
            'lower' => (int) MgHelpers::getSetting('hasło minimalna ilość małych liter', false, 1),
            'userAttribute' => 'username', 'on' => ['backend', 'password']],
        [['username'], StrengthValidator::className(),
            'hasUser' => false,
            'min' => (int) MgHelpers::getSetting('login minimalna ilość znaków', false, 3),
            'digit' => (int) MgHelpers::getSetting('login minimalna ilość cyfr', false, 0),
            'special' => (int) MgHelpers::getSetting('login minimalna ilość znaków specjalnych', false, 0),
            'upper' => (int) MgHelpers::getSetting('login minimalna ilość wielkich liter', false, 0),
            'lower' => (int) MgHelpers::getSetting('login minimalna ilość małych liter', false, 0),
        ],
        [['uploadEmploymentFile'], 'file'],
        [['email'], 'required', 'on' => 'myAccount'],
        ['username', 'usernameValidate'],
        [['oldFormPassword'], 'required', 'on' => ['password']],
        [['oldFormPassword'], 'checkOldPassword', 'on' => ['password']],
        ['passwordRepeat', 'compare', 'compareAttribute' => 'password', 'message' => Yii::t('app', "Passwords don't match"), 'on' => 'password'],
        ['passwordRepeat', 'required', 'on' => 'password'],
        [['birthdate'], 'date', 'format' => 'yyyy-MM-dd', 'message' => 'Format daty urodzenia jest nieprawidłowy, poprawny format to rrrr-mm-dd'],
        [['birthdate'], 'compare', 'compareValue' => '1920-01-01', 'operator' => '>'],
        [['birthdate'], 'compare', 'compareValue' => '2010-01-01', 'operator' => '<'],
        [['phone'],'match', 'pattern' => '/^[0-9]{9}$/']
    ];
  }

  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'user';
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
        'id' => Yii::t('app', 'ID'),
        'username' => 'Login',
        'password' => Yii::t('app', 'Password'),
        'first_name' => Yii::t('app', 'First Name'),
        'last_name' => Yii::t('app', 'Last Name'),
        'role' => Yii::t('app', 'Role'),
        'status' => Yii::t('app', 'Status'),
        'statusStr' => Yii::t('app', 'Status'),
        'email' => Yii::t('app', 'Email'),
        'created_on' => Yii::t('app', 'Created On'),
        'last_login' => Yii::t('app', 'Last Login'),
        'address' => Yii::t('app', 'Address'),
        'postcode' => Yii::t('app', 'Postcode'),
        'birthdate' => Yii::t('app', 'Birthdate'),
        'city' => Yii::t('app', 'City'),
        'auth_key' => Yii::t('app', 'Auth Key'),
        'date_last_password_change' => 'Data ostatniej zmiany hasła',
        'is_password_change_accepted' => Yii::t('app', 'Cykliczna zmiana hasła wyłączona'),
        'other_names' => Yii::t('app', 'Dalsze imiona'),
        'gender' => Yii::t('app', 'Gender'),
        'date_email_confirmation' => Yii::t('app', 'Data potwierdzenia maila'),
        'birth_place' => Yii::t('app', 'Miejsce urodzenia'),
        'position' => Yii::t('app', 'Position'),
        'educational_level' => Yii::t('app', 'Educational Level'),
        'employment_card_id' => Yii::t('app', 'Skan aktualnego zatrudnienia'),
        'date_card_verification' => Yii::t('app', 'Data weryfikacji potwierdzenia'),
        'date_card_submission' => Yii::t('app', 'Data złożenia karty'),
        'academic_title' => Yii::t('app', 'Tytuł naukowy'),
        'phone' => Yii::t('app', 'Phone'),
        'is_special_account' => Yii::t('app', 'Konto specjalne'),
        'credibility' => Yii::t('app', 'Wiarygodność'),
        'credibilityCalc' => Yii::t('app', 'Wiarygodność'),
        'is_newsletter' => Yii::t('app', 'Newsletter'),
        'comments' => Yii::t('app', 'Uwagi'),
        'is_deleted' => Yii::t('app', 'Is Deleted'),
        'is_not_logged_account' => Yii::t('app', 'Is Not Logged Account'),
        'training_preferences' => Yii::t('app', 'Preferencje szkoleniowe uczestnika'),
        'training_preferences_keywords' => Yii::t('app', 'preferencje szkoleniowe uczestnika - słowa kluczowe'),
        'uploadedFiles' => 'Karta zatrudnienia',
        'create_account_additional_data' => 'Kto zakładał konto i skąd dane',
        'passwordRepeat' => 'Powtórz hasło',
        'institutions' => 'Instytucje',
        'uploadEmploymentFile' => 'Skan aktualnego zatrudnienia',
        'employmentCard' => 'Skan aktualnego zatrudnienia',
        'institutionsStr' => 'Instytucje',
        'toString' => 'Użytkownik',
        'oldFormPassword' => 'Podaj stare hasło',
        'genderStr' => 'Płeć',
        'is_profiled_offer_enabled' => 'Sprofilowana oferta'
        
    ];
  }

  public function checkOldPassword($attribute)
  {
    if (sha1($this->oldFormPassword) != $this->getOldAttribute('password')) {
      $this->addError($attribute, 'Nieprawidłowe hasło');
    }
  }

  public function usernameValidate($attribute)
  {
    if (!$this->scenarioDelete && !preg_match('/^[a-z0-9]+$/', $this->username)) {
      $this->addError('username', 'Login nie może zawierać polskich, wielkich liter, znaków diakrytycznych ani znaków specjalnych');
    }
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getAgreements()
  {
    return $this->hasMany(\app\models\db\Agreement::className(), ['id' => 'agreement_id'])->viaTable('user_agreement', ['user_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getArticles()
  {
    return $this->hasMany(\app\models\mgcms\db\Article::className(), ['updated_by' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getEvents()
  {
    return $this->hasMany(\app\models\db\Event::className(), ['created_by' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getGalleries()
  {
    return $this->hasMany(\app\models\mgcms\db\Gallery::className(), ['created_by' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getGroups()
  {
    return $this->hasMany(\app\models\db\Group::className(), ['id' => 'group_id'])->viaTable('user_group', ['user_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getInstitutions()
  {
    return $this->hasMany(\app\models\db\Institution::className(), ['id' => 'institution_id'])->viaTable('workplace', ['user_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getLabs()
  {
    return $this->hasMany(\app\models\db\Lab::className(), ['created_by' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getLessons()
  {
    return $this->hasMany(\app\models\db\Lesson::className(), ['created_by' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getLessonPresences()
  {
    return $this->hasMany(\app\models\db\LessonPresence::className(), ['user_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getTrainingLessons()
  {
    return $this->hasMany(\app\models\db\Lesson::className(), ['id' => 'training_lesson_id'])->viaTable('lesson_presence', ['user_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getLogs()
  {
    return $this->hasMany(Log::className(), ['created_by' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getMessages()
  {
    return $this->hasMany(Message::className(), ['recipient_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getModificationHistories()
  {
    return $this->hasMany(ModificationHistory::className(), ['created_by' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getNewsletters()
  {
    return $this->hasMany(\app\models\db\Newsletter::className(), ['id' => 'newsletter_id'])->viaTable('newsletter_user', ['user_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getNewsletterUsers()
  {
    return $this->hasMany(\app\models\db\NewsletterUser::className(), ['user_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getPolQuestionAnswers()
  {
    return $this->hasMany(\app\models\db\PolQuestionAnswer::className(), ['user_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getPolls()
  {
    return $this->hasMany(\app\models\db\Poll::className(), ['created_by' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getPollQuestions()
  {
    return $this->hasMany(\app\models\db\PollQuestion::className(), ['created_by' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getPollTemplates()
  {
    return $this->hasMany(\app\models\db\PollTemplate::className(), ['created_by' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getSmsTemplates()
  {
    return $this->hasMany(\app\models\db\SmsTemplate::className(), ['created_by' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getSqlQueries()
  {
    return $this->hasMany(\app\models\mgcms\db\SqlQuery::className(), ['created_by' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getSubjects()
  {
    return $this->hasMany(\app\models\db\Subject::className(), ['id' => 'subject_id'])->viaTable('user_subject', ['user_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getTrainings()
  {
    return $this->hasMany(\app\models\db\Training::className(), ['id' => 'training_id'])->viaTable('training_lector', ['user_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getTrainingsViaParticipant()
  {
    return $this->hasMany(\app\models\db\Training::className(), ['id' => 'training_id'])->viaTable('training_participant', ['user_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getTrainingDirections()
  {
    return $this->hasMany(\app\models\db\TrainingDirection::className(), ['created_by' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getTrainingLectors()
  {
    return $this->hasMany(\app\models\db\TrainingLector::className(), ['user_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getTrainingModules()
  {
    return $this->hasMany(\app\models\db\TrainingModule::className(), ['id' => 'training_module_id'])->viaTable('training_module_presence', ['user_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getTrainingModulePresences()
  {
    return $this->hasMany(\app\models\db\TrainingModulePresence::className(), ['user_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getTrainingParticipants()
  {
    return $this->hasMany(\app\models\db\TrainingParticipant::className(), ['user_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getTrainingTemplates()
  {
    return $this->hasMany(\app\models\db\TrainingTemplate::className(), ['created_by' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getEmploymentCard()
  {
    return $this->hasOne(\app\models\mgcms\db\File::className(), ['id' => 'employment_card_id']);
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
  public function getUsers()
  {
    return $this->hasMany(\app\models\mgcms\db\User::className(), ['created_by' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getUserAgreements()
  {
    return $this->hasMany(\app\models\db\UserAgreement::className(), ['user_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getUserGroups()
  {
    return $this->hasMany(\app\models\db\UserGroup::className(), ['user_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getUserPasswords()
  {
    return $this->hasMany(\app\models\db\UserPassword::className(), ['user_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getUserRoles()
  {
    return $this->hasMany(\app\models\db\UserRole::className(), ['user_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery 
   */
  public function getUserEducationalLevels()
  {
    return $this->hasMany(\app\models\db\UserEducationalLevel::className(), ['user_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery 
   */
  public function getEducationalLevels()
  {
    return $this->hasMany(\app\models\db\EducationalLevel::className(), ['id' => 'educational_level_id'])->viaTable('user_educational_level', ['user_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getRoles()
  {
    return $this->hasMany(\app\models\db\Role::className(), ['id' => 'role_id'])->viaTable('user_role', ['user_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getUserSubjects()
  {
    return $this->hasMany(\app\models\db\UserSubject::className(), ['user_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getWorkplaces()
  {
    return $this->hasMany(\app\models\db\Workplace::className(), ['user_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getWorkshops()
  {
    return $this->hasMany(\app\models\db\Workshop::className(), ['id' => 'workshop_id'])->viaTable('workshop_user', ['user_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getWorkshopLectors()
  {
    return $this->hasMany(\app\models\db\WorkshopLector::className(), ['user_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getWorkshopUsers()
  {
    return $this->hasMany(\app\models\db\WorkshopUser::className(), ['user_id' => 'id']);
  }

  public function beforeValidate()
  {
    if ($this->isNewRecord) {
      $this->setAuthKey();
    }
    return parent::beforeValidate();
  }

  public function beforeSave($insert)
  {

    if (!MgHelpers::is_sha1($this->password)) {
      $this->oldPassword = $this->password;
      $this->password = sha1($this->password);
    }
    if (!$this->isNewRecord) {
      $upladedFile = UploadedFile::getInstance($this, 'uploadEmploymentFile');
      if ($upladedFile) {
        if ($upladedFile->type != 'application/octet-stream') {
          if ($upladedFile->hasError) {
            MgHelpers::setFlash(MgHelpers::FLASH_TYPE_ERROR, 'Błąd zapisu pliku');
          } else {
            $fileModel = new File;
            $file = $fileModel->push(new \rmrevin\yii\module\File\resources\UploadedResource($upladedFile));
            if ($file->id) {
              $this->employment_card_id = $file->id;
              $this->date_card_submission = new \yii\db\Expression('now()');
            }
          }
        } else {
          MgHelpers::setFlash(MgHelpers::FLASH_TYPE_ERROR, 'Nieprawidłowy format pliku');
        }
      }
    }

    return parent::beforeSave($insert);
  }

  public function afterSave($insert, $changedAttributes)
  {
    if (!$this->isNewRecord && $this->oldPassword && $this->oldPassword != $this->password) {
      $userPasswordModel = new UserPassword;
      $userPasswordModel->user_id = $this->id;
      $userPasswordModel->password = sha1($this->oldPassword);
      $userPasswordModel->save();
      UserPassword::clearTooOldPassword($this->id);
    }
    return parent::afterSave($insert, $changedAttributes);
  }

  public function validatePassword($password)
  {
    return Yii::$app->getSecurity()->validatePassword($password, $this->password);
  }

  /**
   * Finds an identity by the given ID.
   *
   * @param string|int $id the ID to be looked for
   * @return IdentityInterface|null the identity object that matches the given ID.
   */
  public static function findIdentity($id)
  {
    return static::findOne($id);
  }

  /**
   * Finds an identity by the given token.
   *
   * @param string $token the token to be looked for
   * @return IdentityInterface|null the identity object that matches the given token.
   */
  public static function findIdentityByAccessToken($token, $type = null)
  {
    return static::findOne(['access_token' => $token]);
  }

  /**
   * @return int|string current user ID
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @return string current user auth key
   */
  public function getAuthKey()
  {
    return $this->auth_key;
  }

  /**
   * @param string $authKey
   * @return bool if auth key is valid for current user
   */
  public function validateAuthKey($authKey)
  {
    return $this->getAuthKey() === $authKey;
  }

  private function setAuthKey()
  {
    $this->auth_key = Yii::$app->security->generateRandomString(60);
  }

  public function updateLastLogin()
  {
    $this->last_login = new \yii\db\Expression('NOW()');
    $this->save();
  }

  public function getToString()
  {

    return ($this->first_name ? $this->first_name . ' ' . $this->last_name : $this->username);
  }
  
  public function getToStringWithAcademicTitle(){
    return ($this->academic_title ? $this->academic_title . ' ' : '') . ($this->first_name ? $this->first_name . ' ' . $this->last_name : $this->username);
  }

  public function __toString()
  {
    return $this->getToString();
  }

  public function checkAccess($controller, $action)
  {
      set_time_limit ( 300);
    $controller = str_replace(['mgcms/', 'oeiizk/'], '', $controller);
    $roles = $this->roles;

    $permissionAllowed = false;
    $allowedActions = array('logout', 'login');
    $allowedContollers = array('message');
    $allowedContollerWithAction = array('defaultindex', 'defaultchoose-role');

    if (in_array($controller, $allowedContollers) || in_array($action, $allowedActions) || in_array($controller . $action, $allowedContollerWithAction)) {
      return true;
    }
    if (!$this->auths) {
      $cachedAuths = Yii::$app->cache->get('auths');
      if (!$cachedAuths) {
        $authsFromDb = Auth::find()->asArray()->all();
        Yii::$app->cache->set('auths', $authsFromDb);
        $this->auths = $authsFromDb;
      } else {
        $this->auths = $cachedAuths;
      }
    }
    $rolesToAdd = [];
    $rolesToAdd[] = [$controller, $action, 'admin'];

    $authFound = false;
    foreach ($this->auths as $auth) {
      foreach ($roles as $role) {
        if ($auth['controller'] == $controller && $auth['action'] == $action && $auth['role'] === (string) $role->id) {
          if ($auth['value'] == 1) {
            return true;
          }
        } else {
          $rolesToAdd[] = [$controller, $action, (string) $role->id];
        }
      }
    }

    foreach ($rolesToAdd as $roleToAdd) {
      $exist = false;
      foreach ($this->auths as $auth) {
        if ($auth['controller'] == $roleToAdd[0] && $auth['action'] == $roleToAdd[1] && $auth['role'] == $roleToAdd[2]) {
          $exist = true;
        }
      }
      if (!$exist) {
        if (Auth::findByCondition(['controller' => $roleToAdd[0], 'action' => $roleToAdd[1], 'role' => $roleToAdd[2]])->count() == 0) {
          $auth = new Auth;
          $auth->controller = $roleToAdd[0];
          $auth->action = $roleToAdd[1];
          $auth->role = $roleToAdd[2];
          $auth->value = 0;
          $auth->save();
          Yii::$app->cache->delete('auths');
        }
      }
    }
    return $this->role === User::ROLE_ADMIN ? true : $permissionAllowed;
  }

  public function checkRoleAccess($controller, $action, $role = false)
  {
    if (!$role) {
      $role = $this->role;
    }

    $role = (string) $role;

    $allowedActions = array('logout', 'login');
    $allowedContollers = array();
    $allowedContollerWithAction = array('defaultindex');

    if (in_array($controller, $allowedContollers) || in_array($action, $allowedActions) || in_array($controller . $action, $allowedContollerWithAction)) {
      return true;
    }
    if (!$this->auths) {
      $cachedAuths = Yii::$app->cache->get('auths');
      if (!$cachedAuths) {
        $authsFromDb = Auth::find()->asArray()->all();
        Yii::$app->cache->set('auths', $authsFromDb);
        $this->auths = $authsFromDb;
      } else {
        $this->auths = $cachedAuths;
      }
    }

    $authFound = false;
    foreach ($this->auths as $auth) {
      if ($auth['controller'] == $controller && $auth['action'] == $action && $auth['role'] === $role) {
        $authFound = $auth;
      }
    }

    if (!$authFound) {
      $auth = new Auth;
      $auth->controller = $controller;
      $auth->action = $action;
      $auth->role = $role;
      $auth->value = 0;
      $auth->save();
      if ($role == User::ROLE_ADMIN) {
        return true;
      }
      return false;
    } else {
      if ($role == User::ROLE_ADMIN) {
        return true;
      }
      return $authFound['value'];
    }

    return false;
  }

  public function getStatusStr()
  {
    return Yii::t('app', self::STATUSES[$this->status]);
  }

  function checkPasswordExpiry()
  {
    if (strtotime('now -' . MgHelpers::getSetting('ilość dni wymuszających zmianę hasła', false, 30) . 'day') > strtotime($this->date_last_password_change)) {
      return true;
    }
    return false;
  }

  function checkIfUserNeedPasswordChange()
  {
    return $this->is_password_change_accepted !== 1 && $this->is_special_account;
  }

  function getCredibilityCalc()
  {
    $creadibility = 0;
    if ($this->date_email_confirmation && $this->date_email_confirmation != '0000-00-00 00:00:00') {
      $creadibility += 40 * 0.25;
    }
    if ($this->position) {
      $creadibility += 40 * 0.125;
    }
    if ($this->getEducationalLevels()->count() > 0) {
      $creadibility += 40 * 0.125;
    }
    if ($this->employmentCard) {
      $creadibility += 40 * 0.125;
    }
    if ($this->date_card_verification) {
      $creadibility += 40 * 0.25;
    }

    if ($this->workplaces) {
      $creadibility += 40 * 0.125;
    }

    $lastThreeTrainings = $this->threeLastTrainingsParticipants;

    foreach ($lastThreeTrainings as $index => $trainingParticipant) {
      $indRev = 3 - $index;
      $creadibility += 10 * $indRev;
      if (!$trainingParticipant->is_passed && $trainingParticipant->status != 'Rezygnacja ze szkolenia') {
        $creadibility -= 5 * $indRev;
      }
    }

    return $creadibility;
  }

  /**
   * @return \app\models\db\TrainingParticipant[]
   */
  function getThreeLastTrainingsParticipants()
  {
    $query = \app\models\db\TrainingParticipant::find();
    $query->joinWith('training');
    $query->andWhere(['training_participant.user_id' => $this->id]);
    $query->andWhere(['<', 'training.date_end', new \yii\db\Expression('now()')]);
    $query->orderBy(['training.date_end' => SORT_DESC]);
    $query->limit(3);
    $models = $query->all();
    return $models;
  }

  public function getInstitutionsStr($delimiter = ', ')
  {
    return join($delimiter, array_map(function($x) {
          return $x->name;
        }, $this->getInstitutions()->all()));
  }
  
  public function getFullInstitutionsStr($delimiter = '<br/>')
  {
    return join($delimiter,
        array_map(function($x) {
          return $x->name . ', ' . $x->postcode . ', ' . $x->city;
        }, $this->getInstitutions()->all()));
  }

  /**
   * 
   * @return \app\models\db\Institution
   */
  public function getFirstInstitution()
  {
    $institutions = $this->getInstitutions()->all();
    if(!isset($institutions[0])){
      return false;
    }
    /* @var $institution app\models\db\Institution */
    $institution = $institutions[0];
    
    
    return $institution;
  }
  
  public function getFirstInstitutionStr()
  {
    $institution = $this->firstinstitution;
    if(!$institution){
      return false;
    }
    
    return $institution->name.'<br/>'.$institution->postcode.' '.$institution->city;
  }
  
  public function getFirstInstitutionCode()
  {
    $institution = $this->firstinstitution;
    if(!$institution){
      return false;
    }
    
    return $institution->code;
  }

  public function getRolesStr()
  {
    return join(', ', array_map(function($x) {
          return $x->name;
        }, $this->getRoles()->all()));
  }

  public function getGroupsStr()
  {
    return join(', ', array_map(function($x) {
          return $x->name;
        }, $this->getGroups()->all()));
  }

  public function getSubjectsStr()
  {
    return join(', ', array_map(function($x) {
          return $x->name;
        }, $this->getSubjects()->all()));
  }

  public function getEducationalLevelsStr()
  {
    return join(', ', array_map(function($x) {
          return $x->name;
        }, $this->getEducationalLevels()->all()));
  }

  public function getDataFillLevel()
  {
    $fields = ['first_name', 'last_name', 'email'];
  }

  public function hasRole($roleSlug)
  {
    foreach ($this->roles as $role) {
      if ($role->slug == $roleSlug) {
        return true;
      }
    }
    return false;
  }

  public function checkEditAccess()
  {

    if (\app\components\mgcms\OeiizkHelpers::isRole(\app\models\mgcms\db\User::ROLE_DOS)) {
      if ($this->hasRole(User::ROLE_DOS) || $this->hasRole(User::ROLE_DIRECTOR) || $this->role == User::ROLE_ADMIN) {
        return false;
      }
    }

    return true;
  }

  public static function findDosUsers()
  {
    $query = User::find()->orderBy('id')->orderBy(['first_name' => SORT_ASC, 'username' => SORT_ASC]);
    $query->joinWith('roles');
    $query->andWhere(['role.slug' => self::ROLE_DOS]);
    return $query->all();
  }

  public static function findLectorUsers()
  {
    $query = User::find()->orderBy('id')->orderBy(['first_name' => SORT_ASC, 'username' => SORT_ASC]);
    $query->joinWith('roles');
    $query->andWhere(['role.slug' => self::ROLE_LECTOR]);
    return $query->all();
  }

    public static function findLectorAdnCoachUsers()
    {
        $query = User::find()->orderBy('id')->orderBy(['first_name' => SORT_ASC, 'username' => SORT_ASC]);
        $query->joinWith('roles');
        $query->andWhere(['in','role.slug', [self::ROLE_LECTOR, self::ROLE_COACH]]);
        return $query->all();
    }

  /**
   * 
   * @param integer $agreementId
   */
  public function hasAgreementAccepted($agreementId)
  {
    foreach ($this->agreements as $agreement) {
      if ($agreement->id == $agreementId) {
        return true;
      }
    }
    return false;
  }

  public function getNameWithEmail()
  {
    return $this . ' ' . $this->email;
  }

  /**
   * 
   * @param \app\models\db\Training $training
   * @return \app\models\db\TrainingParticipant
   */
  public function isTrainingParticipant(\app\models\db\Training $training)
  {
    foreach ($this->trainingParticipants as $trainingPart) {
      if ($trainingPart->training && $trainingPart->training_id == $training->id) {
        return $trainingPart;
      }
    }
    return false;
  }
  
  /**
   * 
   * @param \app\models\db\Workshop $workshop
   * @return \app\models\db\WorkshopUser
   */
  public function isWorkshopParticipant(\app\models\db\Workshop $workshop)
  {
    foreach ($this->workshopUsers as $workshopUser) {
      if ($workshopUser->workshop_id && $workshopUser->workshop_id == $workshop->id) {
        return $workshopUser;
      }
    }
    return false;
  }

  public function beforeDelete()
  {
    $this->username = $this->username . '!';
    foreach ($this->trainingParticipants as $participant) {
      if (in_array($participant->training->status, ['uruchomione', 'zakończone', 'zamknięte'])) {
        MgHelpers::setFlashInfo("Nie można usunąć użytkownika, jest on zapisany na szkolenie");
        return false;
      }
    }
    return parent::beforeDelete();
  }

  public function isLessonPresent(\app\models\db\Lesson $lesson)
  {
    return (boolean) \app\models\db\LessonPresence::findByCondition(['user_id' => $this->id, 'training_lesson_id' => $lesson->id])->count();
  }

  public function isModulePresent(\app\models\db\TrainingModule $module)
  {
    return (boolean) \app\models\db\TrainingModulePresence::findByCondition(['user_id' => $this->id, 'training_module_id' => $module->id])->count();
  }
  
  public function getGenderStr(){
    
    return isset(self::GENDERS[$this->gender]) ? Yii::t('app', self::GENDERS[$this->gender]) : '';
  }
}
