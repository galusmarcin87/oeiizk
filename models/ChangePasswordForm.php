<?php
namespace app\models;

use Yii;
use yii\base\Model;
use app\components\mgcms\T;
use kartik\password\StrengthValidator;
use \app\components\mgcms\MgHelpers;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class ChangePasswordForm extends Model
{

  public $username;
  public $oldPassword;
  public $password;
  public $passwordRepeat;
  public $is_password_change_accepted;
  public $acceptTerms;
  private $_user = false;

  public function __construct(mgcms\db\User $user)
  {
    $this->_user = $user;
    $this->username = $user->username;
  }

  /**
   * @return array the validation rules.
   */
  public function rules()
  {
    return [
        // username and password are both required
        [['oldPassword', 'password', 'passwordRepeat'], 'required'],
        [['is_password_change_accepted'], 'safe'],
        // rememberMe must be a boolean value
        // password is validated by validatePassword()
        ['oldPassword', 'validateOldPassword'],
        ['password', 'validatePassword'],
        [['password'], StrengthValidator::className(),
            'min' => (int) MgHelpers::getSetting('hasło minimalna ilość znaków', false, 8),
            'digit' => (int) MgHelpers::getSetting('hasło minimalna ilość cyfr', false, 1),
            'special' => (int) MgHelpers::getSetting('hasło minimalna ilość znaków specjalnych', false, 1),
            'upper' => (int) MgHelpers::getSetting('hasło minimalna ilość wielkich liter', false, 1),
            'lower' => (int) MgHelpers::getSetting('hasło minimalna ilość małych liter', false, 1),
            'userAttribute' => 'username'],
        ['passwordRepeat', 'compare', 'compareAttribute' => 'password', 'message' => Yii::t('app', "Passwords don't match")],
        [['acceptTerms'], 'checkTerms', 'on' => 'firstLogin'],
    ];
  }

  /**
   * Validates the password.
   * This method serves as the inline validation for password.
   *
   * @param string $attribute the attribute currently being validated
   * @param array $params the additional name-value pairs given in the rule
   */
  public function validateOldPassword($attribute, $params)
  {
    if (!$this->hasErrors()) {
      $user = $this->getUser();

      try {
        if (!$user || sha1($this->oldPassword) != $user->password) {
          $this->addError($attribute, Yii::t('app', 'Incorrect password.'));
        }
      } catch (yii\base\InvalidArgumentException $e) {
        $this->addError($attribute, Yii::t('app', 'Incorrect password.'));
      }
    }
  }

  public function validatePassword($attribute, $params)
  {
    if (!$this->hasErrors()) {
      $user = $this->getUser();
      $existPasswordInHistory = db\UserPassword::find()->where([
              'password' => sha1($this->password),
              'user_id' => $user->id
          ])->one();
      if ($existPasswordInHistory) {
        $this->addError($attribute, Yii::t('app', 'Password has been already used.'));
      }
    }
  }

  public function changePassword($redirect = true)
  {
    if ($this->validate()) {
      $this->_user->password = $this->password;
      $this->_user->is_password_change_accepted = $this->is_password_change_accepted;
      $this->_user->date_last_password_change = date('Y-m-d H:i:s', strtotime('now'));

      $saved = $this->_user->save();
      if ($saved) {
        if ($this->acceptTerms) {
          foreach ($this->acceptTerms as $id => $checked) {
            $agreement = \app\models\db\Agreement::findOne($id);
            if ($agreement && $checked) {
              $agreementUserModel = new db\UserAgreement;
              $agreementUserModel->user_id = $this->_user->id;
              $agreementUserModel->agreement_id = $id;
              $agreementUserModel->save();
              if (strtolower($agreement->name) == 'newsletter') {
                $this->_user->is_newsletter = 1;
                $saved = $this->_user->save();
              }
            }
          }
        }
        unset(Yii::$app->session['changePasswordUser']);
        if ($redirect) {
          Yii::$app->getResponse()->redirect(['/site/login']);
        } else {
          return true;
        }
      } else {
        MgHelpers::setFlashError(MgHelpers::getErrorsString($this->_user->getErrors()));
        $this->_user = null;
      }

      return false;
    }

    return false;
  }

  public function setUser(mgcms\db\User $user)
  {
    $this->_user = $user;
  }

  public function checkTerms()
  {
    foreach ($this->acceptTerms as $id => $checked) {
      $model = db\Agreement::findOne($id);
      if ($model && $model->is_required && !$checked) {
        $this->addError("acceptTerms[$id]", "Zgoda $model->text jest wymagana.");
      }
    }
  }

  /**
   * Finds user by [[username]]
   *
   * @return User|null
   */
  public function getUser()
  {
    return $this->_user;
  }

  public function attributeLabels()
  {
    return [
        'oldPassword' => Yii::t('app', 'Old password'),
        'password' => Yii::t('app', 'Password'),
        'passwordRepeat' => Yii::t('app', 'Password repeat'),
        'is_password_change_accepted' => 'Brak cyklicznej zmiany hasła.',
        'acceptTerms' => MgHelpers::getSetting('register_terms_label', false, 'Akceptuje zgodę na przetwarzanie danych osobowych.'),
    ];
  }
}
