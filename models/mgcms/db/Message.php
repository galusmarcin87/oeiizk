<?php
namespace app\models\mgcms\db;

use Yii;
use \app\components\mgcms\MgHelpers;

/**
 * This is the base model class for table "message".
 *
 * @property integer $id
 * @property string $subject
 * @property string $message
 * @property integer $sender_id
 * @property integer $recipient_id
 * @property integer $message_id
 * @property string $email
 * @property string $created_on
 * @property integer $is_read
 *
 * @property \app\models\mgcms\db\Message $messageParent
 * @property \app\models\mgcms\db\Message[] $messages
 * @property \app\models\mgcms\db\User $sender
 * @property \app\models\mgcms\db\User $recipient
 */
class Message extends \app\models\mgcms\db\AbstractRecord
{

  public $template;
  use \app\components\mgcms\RelationTrait;

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
        [['message'], 'string'],
        [['recipient_id','message'], 'required'],
        [['sender_id', 'recipient_id', 'message_id'], 'integer'],
        [['created_on','template'], 'safe'],
        [['subject', 'email'], 'string', 'max' => 245],
        [['is_read'], 'integer', 'max' => 1]
    ];
  }

  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'message';
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
        'id' => Yii::t('app', 'ID'),
        'subject' => Yii::t('alt', 'Subject'),
        'message' => Yii::t('app', 'Message'),
        'sender_id' => Yii::t('app', 'Sender'),
        'recipient_id' => Yii::t('app', 'Recipient'),
        'message_id' => Yii::t('app', 'Message'),
        'email' => Yii::t('app', 'Email'),
        'created_on' => Yii::t('app', 'Created On'),
        'is_read' => Yii::t('app', 'Is Read'),
        'template' => 'Szablon',
    ];
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getMessageParent()
  {
    return $this->hasOne(\app\models\mgcms\db\Message::className(), ['id' => 'message_id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getMessages()
  {
    return $this->hasMany(\app\models\mgcms\db\Message::className(), ['message_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getSender()
  {
    return $this->hasOne(\app\models\mgcms\db\User::className(), ['id' => 'sender_id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getRecipient()
  {
    return $this->hasOne(\app\models\mgcms\db\User::className(), ['id' => 'recipient_id']);
  }

  /**
   * @inheritdoc
   * @return \app\models\mgcms\db\MessageQuery the active query used by this AR class.
   */
  public static function find()
  {
    return new \app\models\mgcms\db\MessageQuery(get_called_class());
  }

  public function sendEmail()
  {
    if (!$this->recipient->email) {
      $this->delete();
      MgHelpers::setFlashError('Brak emaila użytkownika odbiorcy');
      return false;
    }
    if (!$this->email && !$this->sender->email) {
      $this->delete();
      MgHelpers::setFlashError('Brak emaila użytkownika nadawcy');
      return false;
    }
    $validator = new \yii\validators\EmailValidator;
    if(!$validator->validate($this->recipient->email)){
      return false;
    }

    /* @var $mail \yii\swiftmailer\Mailer */
    $mail = Yii::$app->mailer->compose('message', ['model' => $this])
        ->setTo($this->recipient->email)
        ->setFrom([MgHelpers::getSetting('email') => MgHelpers::getSetting('email nazwa')])
        ->setSubject($this->subject)
        ->setTextBody($this->message);
    
    $sent = $mail->send();
    if (!$sent) {
      $this->delete();
      MgHelpers::setFlashError('Błąd wysyłania maila');
    }
    return $sent;
  }
}
