<?
/* @var $model app\models\ForgotPasswordForm */
use app\components\mgcms\MgHelpers;

?>
<p><strong>POS OEIiZK - ZMIANA HASŁA</strong></p>
Jeśli nie pamiętasz swojego hasła, kliknij w poniższy link, aby nadać nowe hasło do systemu:
<?=
\yii\helpers\Html::a('RESETUJ HASŁO', \yii\helpers\Url::to(['site/forgot-password-change', 'hash' => MgHelpers::encrypt($model->email)], true))?>
<p>&nbsp;</p>
<p>Pozdrawiamy,</p>
<p>OEIiZK</p>
<p>&nbsp;</p>
<hr />
<p>Powyższa wiadomość kierowana jest wyłącznie do jej adresata i właściciela powyższego adresu email, a dane w niej zawarte są poufne. Jeżeli powyższy e-mail trafił do Państwa omyłkowo, prosimy o jego usunięcie, nie branie powyższych treści pod uwagę i nie rozpowszechnianie ich.</p>