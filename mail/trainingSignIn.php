<?
/* @var $model app\models\db\Training */
/* @var $user \app\models\mgcms\db\User */
use app\components\mgcms\MgHelpers;

?>

<p><strong>Dział Organizacji Szkoleń Ośrodka Edukacji Informatycznej i Zastosowań Komputerów w Warszawie</strong></p>
<p>&nbsp;</p>
<p>Uprzejmie informujemy, że zostałeś pomyślnie zapisany na <?if($model->isConference()):?>konferencję<?else:?>szkolenie<?endif?>:&nbsp;</p>
<?= $model ?>, 
<p>&nbsp;</p>
<?= $this->render('_workshops',['model'=>$model, 'user'=>$user])?>

<p>Jeśli chcesz zrezygnować z <?if($model->isConference()):?>powyższej konferencji<?else:?>powyższego szkolenia<?endif?> kliknij w poniższy link:</p>
<?=
\yii\helpers\Html::a('ZREZYGNUJ', \yii\helpers\Url::to(['/training/resign', 'hash' => MgHelpers::encrypt($model->id.':'.$user->id)], true))?>
<p>&nbsp;</p>
<p>Pozdrawiamy,</p>
<p>Dział Organizacji Szkoleń OEIiZK w Warszawie</p>
<p><a href="mailto:szkolenia@oeiizk.waw.pl">szkolenia@oeiizk.waw.pl</a></p>
<p>tel. 22&nbsp;579 41 22 lub 22 579 41 80</p>
<p>&nbsp;</p>
<hr />
<p>Powyższa wiadomość kierowana jest wyłącznie do jej adresata i właściciela powyższego adresu email, a dane w niej zawarte są poufne. Jeżeli powyższy e-mail trafił do Państwa omyłkowo, prosimy o jego usunięcie, nie branie powyższych treści pod uwagę i nie rozpowszechnianie ich.</p>