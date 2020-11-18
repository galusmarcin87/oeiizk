<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use app\components\mgcms\MgHelpers;


?>

<div class="row align-items-center form-group ">
  <div class="col text-center">
    <? if (app\components\mgcms\MgHelpers::getUserModel()->is_newsletter): ?>
      <?= Html::a('Wypisz się z newslettera', ['site/unsave-from-newsletter'], ['class' => 'btn btn-danger']) ?>
    <? else: ?>
      <?= Html::a('Zapisz się na newsletter', ['site/save-to-newsletter'], ['class' => 'btn btn-danger']) ?>
    <? endif ?>
  </div>
</div>