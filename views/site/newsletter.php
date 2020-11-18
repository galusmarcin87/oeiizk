<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use app\components\mgcms\MgHelpers;

$this->title = 'Newsletter';

?>


<div class="container">
  <article class="main">
    <div class="text-block">
      <h3>Newsletter</h3>
      <?= MgHelpers::getSetting('newsletter tekst nad formularzem WYSYWIG', true) ?>

      <h3 class="mt-0">&nbsp;</h3>
      <? if (app\components\mgcms\MgHelpers::getUserModel()): ?>
        <div class="row align-items-center form-group ">
          <div class="col text-center">
            <? if (app\components\mgcms\MgHelpers::getUserModel()->is_newsletter): ?>
              <?= Html::a('Wypisz się z newslettera', ['site/unsave-from-newsletter'], ['class' => 'btn btn-danger']) ?>
            <? else: ?>
              <?= Html::a('Zapisz się na newsletter', ['site/save-to-newsletter'], ['class' => 'btn btn-danger']) ?>
            <? endif ?>
          </div>
        </div>
      <? else: ?>

        <?php
        echo $form = Html::beginForm('', 'post', [
            'class' => 'newsletter-form form-light'
            ]
        );

        ?>
        <div class="row form-group">
          <div class="col-12">

            <?= Html::textInput('newsletter-email', '', ['class' => 'form-control', 'placeholder' => 'podaj email']) ?>

          </div>
        </div>
        <div class="row align-items-center form-group ">

          <div class="col text-right">
            <button type="submit" class="btn btn-danger">Prenumeruję newsletter</button>
          </div>

        </div>

        <?php echo Html::endForm(); ?>
      <? endif ?>
<!--      <h3>RODO</h3> -->
      <?= MgHelpers::getSetting('newsletter tekst rodo', true) ?>

      <h3>Archiwum rozesłanych wiadomości</h3>
      <div class="newsletter-archive">
        <div class="newsletter-archive-list">
          <? foreach (app\models\db\Newsletter::find()->andWhere(['not', ['date_sent' => null]])->orderBy(['created_on' => SORT_DESC])->all() as $index => $newsletter): ?>
            <p><strong><?= $index + 1 ?>:</strong> <?= $newsletter->link ?> </p>
          <? endforeach ?>
        </div>
        <div class="text-center py-3">
          <a href="#" class="newsletter-list-toggle btn btn-outline-primary">
            <span class="text-open">rozwiń</span>
            <span class="text-close">zwiń</span>
          </a>
        </div>
      </div>



      <?php
      echo $form = Html::beginForm('', 'post', [
          'class' => 'search-form form-light'
      ]);

      ?>
      <div class="row form-group">
        <div class="col-12">

          <?= Html::textInput('newsletter-search', '', ['class' => 'form-control', 'placeholder' => 'Wyszukaj']) ?>
        </div>
      </div>

      <div class="row align-items-center form-group ">

        <div class="col text-right">
          <button type="submit" class="btn btn-danger">Szukaj</button>
        </div>

      </div>
      <?php echo Html::endForm(); ?>
      <? if ($searchModels): ?>
        <div class="newsletter-archive-list">
          <? foreach ($searchModels as $index => $searchModel): ?>
            <p><strong><?= $index + 1 ?>:</strong> <?= $newsletter->link ?> </p>
          <? endforeach ?>
        </div>
      <? endif ?>

    </div>
  </article>
</div>






