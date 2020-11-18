﻿<?
/* @var $model \app\models\db\Training */
use app\components\mgcms\MgHelpers;

?>
<p><strong>Dział Organizacji Szkoleń Ośrodka Edukacji Informatycznej i Zastosowań Komputer&oacute;w w Warszawie</strong></p>

<h1>Szkolenie <?= $model ?></h1>

<?= MgHelpers::getSetting('mail - zmiana statusu szkolenia na potwierdzenia', true, 'Szkolenie jest w fazie potwierdzeń') ?>

<p>Pozdrawiamy,</p>
<p>Dział Organizacji Szkoleń OEIiZK w Warszawie</p>
<p><a href="mailto:szkolenia@oeiizk.waw.pl">szkolenia@oeiizk.waw.pl</a></p>
<p>tel. 22&nbsp;579 41 22 lub 22 579 41 80</p>
<p>&nbsp;</p>
<hr />
<p>Powyższa wiadomość kierowana jest wyłącznie do jej adresata i właściciela powyższego adresu email, a dane w niej zawarte są poufne. Jeżeli powyższy e-mail trafił do Państwa omyłkowo, prosimy o jego usunięcie, nie branie powyższych treści pod uwagę i nie rozpowszechnianie ich.</p>
