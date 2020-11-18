<?php
namespace app\models;

use Yii;
use yii\base\Model;
use app\components\mgcms\T;
use app\models\mgcms\db\Log;
use app\components\mgcms\MgHelpers;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{

  public $username;
  public $password;
  public $rememberMe = true;
  private $_user = false;

  /**
   * @return array the validation rules.
   */
  public function rules()
  {
    return [
        // username and password are both required
        [['username', 'password'], 'required'],
        // rememberMe must be a boolean value
        ['rememberMe', 'boolean'],
        // password is validated by validatePassword()
        ['password', 'validatePassword'],
    ];
  }

  /**
   * Validates the password.
   * This method serves as the inline validation for password.
   *
   * @param string $attribute the attribute currently being validated
   * @param array $params the additional name-value pairs given in the rule
   */
  public function validatePassword($attribute, $params)
  {
    if (!$this->hasErrors()) {
      $user = $this->getUser();

      if (!$user || $user->password != sha1($this->password)) {
        $this->addError($attribute, Yii::t('app', 'Incorrect username or password.'));
      }
    }
  }

  /**
   * Logs in a user using the provided username and password.
   * @return bool whether the user is logged in successfully
   */
  public function login()
  {
    Yii::$app->user->on(\yii\web\User::EVENT_AFTER_LOGIN, function($event) {
      
      $this->setAlerts();

      $event->identity->updateLastLogin();
      Log::addLogin('success', $this);
    });
    if ($this->validate()) {
      if ($this->getUser()->checkPasswordExpiry() && $this->getUser()->checkIfUserNeedPasswordChange()) {
        Yii::$app->session['changePasswordUser'] = $this->getUser();
        Yii::$app->getResponse()->redirect(['/site/change-password']);
        Log::addLogin('need_change', $this);
        return false;
      }
      if ($this->getUser()->is_deleted == 1) {
        $this->addError('username', 'Twoje konto jest usunięte.');
        return false;
      }
      if ($this->getUser()->status == mgcms\db\User::STATUS_INACTIVE) {
        $this->addError('username', 'Twoje konto jest nieaktywne. Prosimy kliknąć w link aktywacyjny wysłany emailem.');
        return false;
      }
      if ($this->getUser()->status == mgcms\db\User::STATUS_SUSPENDED) {
        $this->addError('username', 'Twoje konto jest zawieszone, zgłoś się do Działu Obsługi Szkoleń w celu wyjaśnienia problemu.');
        return false;
      }
      
      if ($this->getUser()->status == mgcms\db\User::STATUS_DUPLICATED) {
        $this->addError('username', 'Nieprawidłowe dane logowania');
        return false;
      }


      return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
    }
    Log::addLogin('failed', $this);
    return false;
  }
  
  private function setAlerts(){
    /* @var $user mgcms\db\User */
      $user = $this->getUser();
      if (!$user->is_special_account && $user->role != mgcms\db\User::ROLE_ADMIN ) {
        if (strtotime($user->last_login) < strtotime(\app\components\mgcms\OeiizkHelpers::getCurrentSchoolYearStart())) {
          MgHelpers::setFlash(MgHelpers::FLASH_TYPE_INFO, 'Proszę potwierdzić poprawność danych.');
        }
        
        if (!$user->first_name || !$user->last_name || !$user->birthdate  || !$user->email  || !$user->gender  || !$user->birth_place ) {
          MgHelpers::setFlash(MgHelpers::FLASH_TYPE_INFO, 'Proszę uzupełnić dane podstawowe.');
        }

        if (!$user->employment_card_id) {
          MgHelpers::setFlash(MgHelpers::FLASH_TYPE_INFO, 'Brak karty zatrudnienia - prosimy o uzupełnienie.');
        }

        if (!$user->birth_place || !$user->birthdate) {
          MgHelpers::setFlash(MgHelpers::FLASH_TYPE_INFO, 'Brak uzupełnienia danych. Proszę sprawdzić, czy jest podana data i miejsce urodzenia.');
        }
        
        if (sizeof($user->workplaces) == 0) {
          MgHelpers::setFlash(MgHelpers::FLASH_TYPE_INFO, 'Brak uzupełnienia danych. Proszę sprawdzić, czy jest podane jest miejsce zatrudnienia (szkoła).');
        }
        
        if($user->date_email_confirmation == '0000-00-00 00:00:00'){
          MgHelpers::setFlash(MgHelpers::FLASH_TYPE_INFO, 'Email nie jest potwierdzony.');
        }
      }
  }

  /**
   * Finds user by [[username]]
   *
   * @return mgcms\db\User
   */
  public function getUser()
  {
    if ($this->_user === false) {
      $this->_user = mgcms\db\User::find()->andWhere(['or', ['username' => $this->username], ['email' => $this->username]])->one();
    }

    return $this->_user;
  }

  public function attributeLabels()
  {
    return [
        'username' => T::t('Username'),
        'password' => T::t('Password'),
        'rememberMe' => T::t('Remember me'),
    ];
  }
}
