<?
/* @var $model \app\models\db\Newsletter */
use app\components\mgcms\MgHelpers;

?>
<p><strong>Platforma Obsługi Szkoleń Ośrodka Edukacji Informatycznej i Zastosowań Komputer&oacute;w w Warszawie. </strong></p>

<h1>DODAJ SIĘ DO NEWSLETTERA</h1>
<p>Aby subskrybować newsletter, kliknij poniższy link: </p>
<?= yii\helpers\Html::a('Subskrybuj', \yii\helpers\Url::to(['/site/subscribe-newsletter', 'hash' => MgHelpers::encrypt($email)], true)) ?>


<p>Aby wypisać się ze subskrypcji, kliknij w poniższy link: </p>
<?= yii\helpers\Html::a('Wyłącz subskrypcje', \yii\helpers\Url::to(['/site/unsubscribe-newsletter', 'hash' => MgHelpers::encrypt($email)], true)) ?>

<p>&nbsp;</p>
<p>Pozdrawiamy,</p>
<p>OEIiZK</p>
<p>&nbsp;</p>
<hr />
<p>Powyższa wiadomość kierowana jest wyłącznie do jej adresata i właściciela powyższego adresu email, a dane w niej zawarte są poufne. Jeżeli powyższy e-mail trafił do Państwa omyłkowo, prosimy o jego usunięcie, nie branie powyższych treści pod uwagę i nie rozpowszechnianie ich.</p>