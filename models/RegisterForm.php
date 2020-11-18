<?php
namespace app\models;

use Yii;
use yii\base\Model;
use app\components\mgcms\MgHelpers;
use app\models\mgcms\db\User;
use kartik\password\StrengthValidator;

class RegisterForm extends Model
{

  public $username;
  public $first_name;
  public $last_name;
  public $email;
  public $birthdate;
  public $birth_place;
  public $gender;
  public $password;
  public $passwordRepeat;
  public $acceptTerms;

  /**
   * @return array the validation rules.
   */
  public function rules()
  {
    return [
        // username and password are both required
        [['username', 'password', 'passwordRepeat', 'first_name', 'last_name', 'email', 'birthdate', 'gender','birth_place'], 'required'],
        [['email'], 'email'],
        ['passwordRepeat', 'compare', 'compareAttribute' => 'password', 'message' => Yii::t('app', "Passwords don't match")],
        [['password'], StrengthValidator::className(),
            'min' => (int) MgHelpers::getSetting('hasło minimalna ilość znaków', false, 8),
            'digit' => (int) MgHelpers::getSetting('hasło minimalna ilość cyfr', false, 1),
            'special' => (int) MgHelpers::getSetting('hasło minimalna ilość znaków specjalnych', false, 1),
            'upper' => (int) MgHelpers::getSetting('hasło minimalna ilość wielkich liter', false, 1),
            'lower' => (int) MgHelpers::getSetting('hasło minimalna ilość małych liter', false, 1),
            'userAttribute' => 'username'],
        [['username'], StrengthValidator::className(),
            'hasUser' => false,
            'min' => (int) MgHelpers::getSetting('login minimalna ilość znaków', false, 3),
            'digit' => (int) MgHelpers::getSetting('login minimalna ilość cyfr', false, 0),
            'special' => (int) MgHelpers::getSetting('login minimalna ilość znaków specjalnych', false,0),
            'upper' => (int) MgHelpers::getSetting('login minimalna ilość wielkich liter', false, 0),
            'lower' => (int) MgHelpers::getSetting('login minimalna ilość małych liter', false, 0),
            ],
        ['username', 'checkExistance'],
        ['email', 'checkExistanceMail'],
        ['first_name', 'checkExistance2'],
        [['acceptTerms'], 'checkTerms'],
        ['username', 'usernameValidate'],
//        ['acceptTerms', 'each', 'rule' => ['checkTerms']],
        [['birthdate'], 'compare', 'compareValue' => '1920-01-01', 'operator' => '>'],
        [['birthdate'], 'compare', 'compareValue' => '2010-01-01', 'operator' => '<'],
    ];
  }

  public function attributeLabels()
  {
    return [
        'username' => Yii::t('app', 'Login'),
        'password' => Yii::t('app', 'Password'),
        'email' => 'Adres e-mail',
        'passwordRepeat' => Yii::t('app', 'Repeat password'),
        'acceptTerms' => MgHelpers::getSetting('register_terms_label', false, 'Akceptuje zgodę na przetwarzanie danych osobowych.'),
        'acceptTerms2' => MgHelpers::getSetting('register_terms_label2', false, 'Akceptuje zgodę na przesyłanie informacji o działalności Ośrodka.'),
        'first_name' => Yii::t('app', 'First Name'),
        'last_name' => Yii::t('app', 'Last Name'),
        'gender' => Yii::t('app', 'Gender'),
        'birthdate' => Yii::t('app', 'Birthdate'),
        'passwordRepeat' => 'Powtórz hasło',
        'birth_place' => 'Miejsce urodzenia'
    ];
  }

  public function checkExistance($attribute)
  {
    if (User::find()->where(['username' => $this->username])->one()) {
      $this->addError('username', 'Ten login jest już zajęty.');
    }
  }
  
  public function usernameValidate($attribute)
  {
    if(!preg_match('/^[a-z0-9]+$/', $this->username)){
      $this->addError('username', 'Login nie może zawierać polskich, wielkich liter, znaków diakrytycznych ani znaków specjalnych.');
    }
  }

  public function checkExistance2($attribute)
  {
    if (User::findOne(['first_name' => $this->first_name, 'last_name' => $this->last_name, 'birthdate' => $this->birthdate])) {
      $this->addError('first_name', 'Taki użytkownik już istnieje, możesz skorzystać z odzyskania hasła lub skontaktować się z Działem Obsługi Szkoleń.');
    }
  }

  public function checkExistanceMail($attribute)
  {
    if (User::findOne(['email' => $this->email])) {
      $this->addError('email', 'Taki użytkownik już istnieje, możesz skorzystać z odzyskania hasła lub skontaktować się z Działem Obsługi Szkoleń.');
    }
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

  public function register()
  {
    if ($this->validate()) {
      $user = new mgcms\db\User;
      $user->username = $this->username;
      $user->password = $this->password;
      $user->first_name = $this->first_name;
      $user->last_name = $this->last_name;
      $user->gender = $this->gender;
      $user->birthdate = $this->birthdate;
      $user->birth_place = $this->birth_place;
      $user->email = $this->email;
      $user->role = User::ROLE_USER;
      $user->status = 0;
      $user->create_account_additional_data = 'założone samodzielnie';
      $saved = $user->save();
      if (!$saved) {
        MgHelpers::setFlashError(Yii::t('app', 'Error during registration:') . MgHelpers::getErrorsString($user->getErrors()));
        return false;
      }
      
      foreach ($this->acceptTerms as $id => $checked) {
        $agreement = \app\models\db\Agreement::findOne($id);
        if ($agreement && $checked) {
          $agreementUserModel = new db\UserAgreement;
          $agreementUserModel->user_id = $user->id;
          $agreementUserModel->agreement_id = $id;
          $agreementUserModel->save();
          if (strtolower($agreement->name) == 'newsletter') {
            $user->is_newsletter = 1;
            $saved = $user->save();      
          }
        }
      }

      /* @var $mailer \yii\swiftmailer\Mailer */
      $mailer = Yii::$app->mailer->compose('activation', [
              'model' => $user
          ])
          ->setTo($user->email)
          ->setFrom([MgHelpers::getSetting('register_email') => MgHelpers::getSetting('register_email_name')])
          ->setSubject(MgHelpers::getSetting('register_activation_email_subject',false, 'OEIIZK - aktywacja'));
      $sent = $mailer->send();

      if (!$sent) {
        MgHelpers::setFlashError(Yii::t('app', 'Error during sending activation email'));
      } else {
        MgHelpers::setFlashSuccess(Yii::t('app', 'Account successfully created, check your email for activation link'));
      }

      return true;
    }
    return false;
  }
}
