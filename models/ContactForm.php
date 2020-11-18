<?php
namespace app\models;

use Yii;
use yii\base\Model;
use app\components\mgcms\MgHelpers;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{

  public $name;
  public $email;
  public $subject;
  public $body;
  public $verifyCode;
  public $acceptTerm;

  /**
   * @return array the validation rules.
   */
  public function rules()
  {
    return [
        // name, email, subject and body are required
        [['email', 'body'], 'required'],
        // email has to be a valid email address
        ['email', 'email'],
        ['acceptTerm', 'required', 'requiredValue' => 1, 'message' => 'Musisz zaakceptować']
        // verifyCode needs to be entered correctly
//            ['verifyCode', 'captcha'],
    ];
  }

  /**
   * @return array customized attribute labels
   */
  public function attributeLabels()
  {
    return [
        'body' => 'Treść',
        'verifyCode' => 'Verification Code',
    ];
  }

  /**
   * Sends an email to the specified email address using the information collected by this model.
   * @param string $email the target email address
   * @return bool whether the model passes validation
   */
  public function contact($email)
  {
    if ($this->validate()) {
      Yii::$app->mailer->compose('contact', ['model' => $this])
          ->setTo(MgHelpers::getSetting('kontakt - email'))
          ->setFrom(\app\components\mgcms\OeiizkHelpers::getEmailSettings())
          ->setSubject('POS OEIiZK kontakt')
          ->send();

      return true;
    }
    return false;
  }
}
