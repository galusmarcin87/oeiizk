<?
/* @var $model \app\models\mgcms\db\Message */

?>
<p><strong>OEIiZK - NOWA WIADOMOŚĆ</strong></p>
Otrzymałeś nową wiadomość od <?= $model->sender ?>, aby ją odczytać 
 <a href="<?=
  yii\helpers\Url::to([
      '/my-account/message-answer',
      'hash' => app\components\mgcms\MgHelpers::encrypt($model->id)
      ], true)

  ?>">Kliknij TUTAJ</a>

<p>&nbsp;</p>
<p>Pozdrawiamy,</p>
<p>OEIiZK</p>
<p>&nbsp;</p>
<hr />
<p>Powyższa wiadomość kierowana jest wyłącznie do jej adresata i właściciela powyższego adresu email, a dane w niej zawarte są poufne. Jeżeli powyższy e-mail trafił do Państwa omyłkowo, prosimy o jego usunięcie, nie branie powyższych treści pod uwagę i nie rozpowszechnianie ich.</p>