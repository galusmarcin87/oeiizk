<?php
namespace app\components\mgcms;

use Yii;
use app\models\mgcms\db\Setting;
use app\components\mgcms\MgHelpers;
use \app\models\mgcms\db\User;

/**
 * Helpers class
 * @author marcin
 */
class OeiizkHelpers extends \yii\base\Component
{

  static function getCurrentSchoolYearStart()
  {
    $startTime = strtotime(date('Y') . '-09-01');
    if (strtotime('now') < $startTime) {
      return date('Y-m-d', strtotime(((int) date('Y') - 1) . '-09-01'));
    } else {
      return date('Y-m-d', strtotime(date('Y') . '-09-01'));
    }
  }

  static function getCurrentBackendRole()
  {
    return Yii::$app->session['role'];
  }

  static function isRole($role)
  {
    return self::getCurrentBackendRole() == $role;
  }

  static function isInRoles($roles)
  {
    return in_array(self::getCurrentBackendRole(), $roles);
  }

  static function getEmailSettings()
  {
    return [MgHelpers::getSetting('email') => MgHelpers::getSetting('email nazwa')];
  }

  static function generateSchoolYears($yearsBack)
  {
    $currentYear = (int) substr(self::getCurrentSchoolYearStart(), 0, 4);

    $retArr = [];
    for ($i = 0; $i < $yearsBack; $i++) {
      $retArr[] = ($currentYear - $i) . '/' . ($currentYear + 1 - $i);
    }
    return $retArr;
  }

  static function sendReactivationMail()
  {
    $user = MgHelpers::getUserModel();
    /* @var $mailer \yii\swiftmailer\Mailer */
    $emailValidator = new \yii\validators\EmailValidator;
    $sent = false;
    if ($emailValidator->validate($user->email)) {
      $mailer = Yii::$app->mailer->compose('reactivation', [
              'model' => $user
          ])
          ->setTo($user->email)
          ->setFrom([MgHelpers::getSetting('register_email') => MgHelpers::getSetting('register_email_name')])
          ->setSubject(MgHelpers::getSetting('register_activation_email_subject', false, 'OEIiZK - aktywacja'));
      $sent = $mailer->send();
    } else {
      MgHelpers::setFlashError('Nie możemy wysłać maila aktywacyjnego - Twój email jest nieprawidłowy.');
    }
    return $sent;
  }

  static function sendSms($number, $message)
  {
    $login = 'oeiizk';
    $pass = 'Kgf5#azbN';

    $client = new \SoapClient("https://redlink.pl/ws/v1/Soap/SmsCampaigns/SmsCampaigns.asmx?WSDL");



    $data = array();
    $data['CampaignId'] = 'szkOnline';
    $data['Name'] = 'Name';
    $data['Message'] = $message;
    $data['Numbers'] = array(self::normalizePhoneNumber($number));
    $data['SenderId'] = 'OEIiZK';
    $data['Priority'] = true;

    $param = new \stdClass();
    $param->strUserName = $login;
    $param->strPassword = $pass;
    $param->data = $data;
    $res = $client->CreateSmsCampaign2_0($param);
    return $res;
  }

  static function sendSmsCampaign($messages)
  {
    $login = 'oeiizk';
    $pass = 'Kgf5#azbN';

    $client = new \SoapClient("https://redlink.pl/ws/v1/Soap/SmsCampaigns/SmsCampaigns.asmx?WSDL");

    $messagesToSend = [];

    foreach ($messages as $message) {
      $message['SenderId'] = 'OEIiZK';
      $messagesToSend[] = $message;
    }

//    $data = array();
//    $data['CampaignId'] = 'szkOnline';
//    $data['Name'] = 'Name';
//    $data['Message'] = $message;
//    $data['Numbers'] = array(self::normalizePhoneNumber($number));
//    $data['SenderId'] = 'OEIiZK';
//    $data['Priority'] = true;

    $param = new \stdClass();
    $param->strUserName = $login;
    $param->strPassword = $pass;
    $param->data = $messagesToSend;
    $res = $client->CreateMultiSmsCampaigns($param);
    return $res;
  }

  static function normalizePhoneNumber($number)
  {
    if (substr($number, 0, 4) == '0048') {
      return $number;
    }


    return '0048' . str_replace('+48', '', $number);
  }

  static function genderTranslate($content, User $user)
  {

    if ($user->gender == User::GENDER_FEMALE) {
      $genderTranslations = MgHelpers::getSettingOptionArray('tłumaczenie słów płci');
      foreach ($genderTranslations as $genderTranslation) {
        $translation = explode('/', $genderTranslation);
        if (sizeof($translation) == 2) {
          $content = str_replace($translation[0], $translation[1], $content);
        }
      }
    }

    return $content;
  }

  static function getPolishMonthNameGenitive($date)
  {
    $month = substr($date, 5, 2);
    $months = ['', 'stycznia', 'lutego', 'marca', 'kwietnia', 'maja', 'czerwca', 'lipca', 'sierpnia', 'września', 'października', 'listopada', 'grudnia'];
    if ($month) {
      return isset($months[(int) $month]) ? $months[(int) $month] : false;
    }
    return false;
  }

  static function replaceCertificate($content, \app\models\db\Training $model, \app\models\db\TrainingParticipant $trainingParticipant)
  {
    $user = $trainingParticipant->user;
    if (!$user) {
      return $content;
    }



    foreach ($user->getAttributes() as $attr => $value) {
      if ($attr == 'last_name') {
        $value = $trainingParticipant->surname ?: $user->last_name;
      }
      if (strpos($attr, 'date') !== false) {
        $value = date('d.m.Y', strtotime($value));
      }
      $content = str_replace('{user.' . $attr . '}', $value, $content);
    }





    foreach ($model->getAttributes() as $attr => $value) {
      if (strpos($attr, 'date') !== false) {
        $value = date('d.m.Y', strtotime($value));
      }
      if ($attr == 'city' && !$value) {
        $value = 'Warszawa';
      }
      $content = str_replace('{training.' . $attr . '}', $value, $content);
    }



    foreach ($model->trainingTemplate->getAttributes() as $attr => $value) {
      if (strpos($attr, 'date') !== false) {
        $value = date('d.m.Y', strtotime($value));
      }
      $content = str_replace('{training_template.' . $attr . '}', $value, $content);
    }




    foreach ($trainingParticipant->getAttributes() as $attr => $value) {
      if (strpos($attr, 'date') !== false) {
        $value = date('d.m.Y', strtotime($value));
      }
      $content = str_replace('{training_participant.' . $attr . '}', $value, $content);
    }


    $content = str_replace('{user.institution}', $trainingParticipant->workplace, $content);
    $content = str_replace('{training.lectors}', $model->lectorsStrNewLines, $content);
    $content = str_replace('{training_template.hour_sum}',
        (int) $model->trainingTemplate->hours_local + (int) $model->trainingTemplate->hours_online, $content);


    $content = str_replace('{user.birthDateMonthGenitive}', OeiizkHelpers::getPolishMonthNameGenitive($user->birthdate), $content);
    $content = str_replace('{user.birthDateDay}', date('d', strtotime($user->birthdate)), $content);
    $content = str_replace('{user.birthDateYear}', date('Y', strtotime($user->birthdate)), $content);
    $content = str_replace('{training.dateEndMonthGenitive}', OeiizkHelpers::getPolishMonthNameGenitive($model->date_end), $content);
    $content = str_replace('{training.end_year}', date('Y', strtotime($model->date_end)), $content);
    $content = str_replace('{training.end_day}', date('d', strtotime($model->date_end)), $content);

    if (isset($model->lessons[0])) {
      $lesson = $model->lessons[0];
      $content = str_replace("{lesson.start_hour}", date('H:i', strtotime($lesson->date_start)), $content);
      $content = str_replace("{lesson.end_hour}", date('H:i', strtotime($lesson->date_end)), $content);
      foreach ($lesson->getAttributes() as $attr => $value) {
        $content = str_replace("{lesson.$attr}", $value, $content);
      }
    }


    $content = OeiizkHelpers::genderTranslate($content, $user);

    return $content;
  }

  static function getTrainingEducationalLevelTitle($tag)
  {
    switch ($tag) {
      case 'P':
        return 'przedszkole';
      case '1-3':
      case '4-6':
      case '7-8':
        return 'szkoła podstawowa';
      case 'PP':
        return 'szkoła ponadpodstawowa';
    }

    return false;
  }
}
