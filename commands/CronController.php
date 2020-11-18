<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */
namespace app\commands;

use yii\console\Controller;
use \app\models\db\Training;
use app\components\mgcms\MgHelpers;
use Yii;
use \app\models\mgcms\db\User;
use yii\db\Query;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class CronController extends Controller
{

  /**
   * This command echoes what you have entered as the message.
   * @param string $message the message to be echoed.
   */
  public function actionIndex()
  {
    echo "Cron started\n";
    ini_set('max_execution_time', 30000);
    $this->trainingDayBefore();
    $this->trainingSmsDayBefore();
     $this->deleteUsersNotActive();
  }

  private function trainingDayBefore()
  {
    /* @var $trainings Training[] */
    $daysBefore = MgHelpers::getSetting('remind_training_days_before', false, 3);
    if ($daysBefore == 0) {
      return false;
    }
    $trainings = Training::find()
        ->andWhere([
            'date_start' => date('Y-m-d', strtotime('now +' . $daysBefore . 'day')),
            'status' => Training::STATUS_CONFIRMATIONS
            ])
        ->all();
    $emailValidator = new \yii\validators\EmailValidator();
    foreach ($trainings as $training) {
      $template = $training->trainingTemplate;
      if (!$template) {
        continue;
      }
      $emails = [];
      foreach ($training->trainingParticipants as $user) {
          if(in_array($user->status, ['wykreślenie','rezygnacja przed zapisem','rezygnacja zamiast potwierdzenia','lista rezerwowa'])){
              continue;
          }
        if ($emailValidator->validate($user->user->email)) {
          $templateName = 'trainingReminder';
          if ($training->isConference()) {
            $templateName .= 'Conference';
          }

          if ($template->hours_local > 0 && $template->hours_online = 0) {
            $templateName .= 'Local';
          }
          if ($template->hours_local = 0 && $template->hours_online > 0) {
            $templateName .= 'Online';
          }
          if ($template->hours_local > 0 && $template->hours_online > 0) {
            $templateName .= 'Mix';
          }
          /* @var $mailer \yii\swiftmailer\Mailer */
          $mailer = Yii::$app->mailer->compose($templateName, [
                  'model' => $training,
                  'user' => $user->user 
              ])
              ->setTo($user->user->email)
              ->setFrom([MgHelpers::getSetting('register_email') => MgHelpers::getSetting('register_email_name')])
              ->setSubject('OEIIZK - przypomnienie o szkoleniu');
          $sent = $mailer->send();
        }
      }
    }
  }

  private function trainingSmsDayBefore()
  {
    /* @var $trainings Training[] */
    $daysBefore = MgHelpers::getSetting('remind_training_days_before_sms', false, 3);
    if ($daysBefore == 0) {
      return false;
    }
    $trainings = Training::find()
        ->andWhere([
            'date_start' => date('Y-m-d', strtotime('now +' . $daysBefore . 'day')),
            'status' => Training::STATUS_CONFIRMATIONS
            ])
        ->all();
    foreach ($trainings as $training) {
      $template = $training->trainingTemplate;
      if (!$template) {
        continue;
      }
      $messages = [];
      foreach ($training->trainingParticipants as $participant) {
          if(in_array($participant->status, ['wykreślenie','rezygnacja przed zapisem','rezygnacja zamiast potwierdzenia','lista rezerwowa'])){
              continue;
          }

        if ($participant->user->phone) {
          
          $templateName = 'sms - przypomnienie szablon ';
          if ($training->isConference()) {
            $templateName .= 'Conference';
          }

          if ($template->hours_local > 0 && $template->hours_online = 0) {
            $templateName .= 'Local';
          }
          if ($template->hours_local = 0 && $template->hours_online > 0) {
            $templateName .= 'Online';
          }
          if ($template->hours_local > 0 && $template->hours_online > 0) {
            $templateName .= 'Mix';
          }
          $content = MgHelpers::getSetting($templateName, false, 'Przypominamy o nadchodzącym szkoleniu {training.name}');
          $message = \app\components\mgcms\OeiizkHelpers::replaceCertificate($content, $training, $participant);
          $messages[] = [
              'Number' => \app\components\mgcms\OeiizkHelpers::normalizePhoneNumber($participant->user->phone),
              'Message' => $message];
        }
      }
      $res = \app\components\mgcms\OeiizkHelpers::sendSmsCampaign($messages);
        }
  }

  private function deleteUsersNotActive()
  {

    $users = User::find()
        ->andWhere(['<', 'created_on', date('Y-m-d', strtotime('now -2 day'))])
        ->andWhere(['created_by' => null])
        ->andWhere(['NOT IN','status',[User::STATUS_TEMPORARY_USER,User::STATUS_ACTIVE]])
        ->all();


    foreach ($users as $user) {
      try {
        (new Query)
            ->createCommand()
            ->delete('user', ['id' => $user->id])
            ->execute();
      } catch (\yii\db\Exception $e) {
        echo $e->getMessage();
      }
    }
  }
}
