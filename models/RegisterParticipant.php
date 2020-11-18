<?php
namespace app\models;

use Yii;
use yii\base\Model;
use app\components\mgcms\MgHelpers;
use app\models\mgcms\db\User;
use kartik\password\StrengthValidator;

class RegisterParticipant extends Model
{

  public $first_name;
  public $last_name;
  public $email;
  public $phone;
  public $acceptTerms;
  public $accountExist = false;
  public $trainingId;
  public $isReserveList = false;
  
  public $user;

  /**
   * @return array the validation rules.
   */
  public function rules()
  {
    return [
        // username and password are both required
        [['first_name', 'last_name', 'email'], 'required'],
        [['email'], 'email'],
        ['phone', 'safe'],
        ['email', 'checkExistanceMail'],
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
        'birth_place' => 'Miejsce urodzenia',
        'phone' => 'Telefon',
    ];
  }

  public function checkExistanceMail($attribute)
  {
    if (User::findOne(['email' => $this->email])) {
      $this->accountExist = true;
      Yii::$app->session['trainingToRegister'] = $this->trainingId;
      $this->addError('email', 'Posiadasz już konto na Platformie Obsługi Szkoleń. Możesz się zalogować na swoje konto. <br/>'
          . '<a href="'.\yii\helpers\Url::to(['/site/login']).'" class="btn btn-danger">Zaloguj się</a> '
          . ' <a href="'.\yii\helpers\Url::to(['/training/save-participant','hash'=> MgHelpers::encrypt($this->trainingId.':'.$this->email)]).'" class="btn btn-danger">KONTYNUUJ BEZ LOGOWANIA</a>');
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

  /**
   * 
   * @param db\Training $training
   * @return boolean
   */
  public function register($training)
  {
    if ($this->validate()) {
      $user = new mgcms\db\User;
      $user->username = str_replace('-','', MgHelpers::slug($this->first_name . $this->last_name . uniqid()));
      $user->password = uniqid();
      $user->first_name = $this->first_name;
      $user->last_name = $this->last_name;
      $user->email = $this->email;
      $user->role = User::ROLE_USER;
      $user->status = User::STATUS_TEMPORARY_USER;
      $user->phone = $this->phone;
      $saved = $user->save();
      $this->user = $user;
      if (!$saved) {
        MgHelpers::setFlashError(Yii::t('app', 'Error during registration:') . MgHelpers::getErrorsString($user->getErrors()));
        return false;
      }

      $trainingParticipant = new db\TrainingParticipant;
      $trainingParticipant->user_id = $user->id;
      $trainingParticipant->training_id = $training->id;
      $trainingParticipant->status = sizeof($training->trainingParticipants) >= $training->maximal_participants_number ? 'lista rezerwowa' : 'zgłoszenie z formularza';
      $saved = $trainingParticipant->save();
      if(sizeof($training->trainingParticipants) >= $training->maximal_participants_number){
        $this->isReserveList = true;
      }
      if ($saved) {
        /* @var $mailer \yii\swiftmailer\Mailer */
        $mailer = Yii::$app->mailer->compose('trainingSignIn', [
                'model' => $training,
                'user' => $user
            ])
            ->setTo($user->email)
//            ->setTo('galusmarcin87@gmail.com')
            ->setFrom([MgHelpers::getSetting('register_email') => MgHelpers::getSetting('register_email_name')])
            ->setSubject('POS OEIiZK - zapisano na '.($training->isConference() ? 'konferencję' : 'szkolenie'));
        $sent = $mailer->send();
      }
      return true;
    }
    return false;
  }
}
