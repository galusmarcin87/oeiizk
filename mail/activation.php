<?

use app\components\mgcms\MgHelpers;

?>
<p><strong>

Witamy na Platformie Obsługi Szkoleń Ośrodka Edukacji Informatycznej i Zastosowań Komputerów w Warszawie.</strong></p>


<p>Prosimy o aktywację konta <a href="<?=
  yii\helpers\Url::to([
      '/site/activate',
      'hash' => app\components\mgcms\MgHelpers::encrypt($model->id)
      ], true)

  ?>"><?= Yii::t('app', 'Click here'); ?></a>.</p>


<p>Zapraszamy na nasze szkolenia.</p>
<p>&nbsp;</p>
<p>Pozdrawiamy,</p>
<p>OEIiZK</p>
<p>&nbsp;</p>
<hr />
<p>Powyższa wiadomość kierowana jest wyłącznie do jej adresata i właściciela powyższego adresu email, a dane w niej zawarte są poufne. Jeżeli powyższy e-mail trafił do Państwa omyłkowo, prosimy o jego usunięcie, nie branie powyższych treści pod uwagę i nie rozpowszechnianie ich.</p>