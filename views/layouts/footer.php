<?
/* @var $this yii\web\View */
use yii\helpers\Html;
use app\components\mgcms\MgHelpers;
use yii\bootstrap\ActiveForm;
use yii\widgets\ListView;

?>

<div class="container">
  <footer class="footer">
    <div class="footer-container">
      <div class="row">
        <div class="col-md-5 col-sm-6">
          <?= MgHelpers::getSetting('text - footer - lewa', true, '<p>
            Ośrodek Edukacji Informatycznej i Zastosowań Komputerów w Warszawie<br />
            ul. Raszyńska 8/10 02-026 Warszawa<br />
            sekretariat@oeiizk.waw.pl  |  22 579 41 00
          </p>') ?>

        </div>
        <div class="col-md-5 col-sm-5 ml-auto">
          <?= MgHelpers::getSetting('text - footer - prawa', true, '<p>
            Dział Organizacji Szkoleń<br />
            pokój 206 w głównej siedzibie Ośrodka<br />
            szkolenia@oeiizk.waw.pl  |  22 579-41-21
          </p>') ?>
         
          <a href="https://www.oeiizk.waw.pl/polityka-prywatnosci" target=_blank> Polityka prywatnosci </a>   
        </div>
        <div class="col-md-2 col-sm-1 text-right">
          <a href="#" class="scroll-top">
            <i class="fa fa-caret-up"></i>
          </a>
        </div>
      </div>
      <div class="footer-bottom">
        <div class="row">
          <div class="col"><?= MgHelpers::getSetting('text - footer - copyright', true, 'Coppyright &copy; OEIIZK 2018') ?></div>
          <div class="col text-right">Realizacja: <a href="#">Vertes Design</a></div>
        </div>
      </div>
    </div>
  </footer>
</div>