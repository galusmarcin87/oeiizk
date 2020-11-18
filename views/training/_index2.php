<?php
use app\components\mgcms\MgHelpers;

/* @var $model app\models\db\Training */
$template = $model->trainingTemplate;
if (!$template) {
  return false;
}

?>


<div class="item-inner">
  <div class="info-title">
    <h3><?= $model->name ?></h3>
  </div>
  <div class="main">
    <div class="item-info">

      <? if ($type == 'cn'): ?>
        <?= $this->render('common/tags',['model'=>$model])?>


        <p class="hours">
          <? if ($template->hours_local): ?>
            <?= $template->hours_local ?> godz. stacjonarnych
          <? endif ?>

          <? if ($template->hours_local && $template->hours_online): ?>
            +
          <? endif ?>

          <? if ($template->hours_online): ?>
            <?= $template->hours_online ?> godz. online
          <? endif ?><br />
          <? if ($model->date_start): ?>
            <?= date('d.m.Y', strtotime($model->date_start)) ?> - <?= date('d.m.Y', strtotime($model->date_end)) ?>
          <? endif ?>
          <?= $model->city && $model->city !=  'Warszawa' ? ', '.$model->city : ''?>
          <a href="<?= $model->url ?>" class="go"><i class="fa fa-caret-right"></i></a>
        </p>
      <? endif ?>
      <? if ($type == 'c'): ?>
        <div class="time">
          <p class="hours">
            <? if ($model->date_start): ?>
              <?= date('d.m.Y', strtotime($model->date_start)) ?> - <?= date('d.m.Y', strtotime($model->date_end)) ?>
            <? endif ?><br />
            <? if ($model->lab) : ?>
              <?= $model->lab->institution->street ?> <?= $model->lab->institution->house_no ?>, <?= $model->lab->institution->city ?>
            <? endif ?>
          </p>
        </div>
      <? endif ?>


    </div>
    <div class="image">
      <? if ($template->imageFile && $template->imageFile->isImage()): ?>
        <img src="<?= $template->imageFile->getImageSrc(275, 130) ?>" class="image-fluid" alt="<?=$model?>">
      <? endif ?>
    </div>

    <div class="description">
      <?= $template->lead ?>
      <? if ($model->comments): ?>
        <p class="point"><?= $model->comments ?></p>
      <?endif?>
    </div>

    <div class="more">
      <div class="more-wrap">
        <? if ($model->comments): ?>
        <div class="text">
          <p class="point"><?= $model->comments ?></p>
        </div>
        <?endif?>
        <div class="link">
          <a href="<?= $model->url ?>" class="btn btn-outline-primary">Szczegóły</a>
        </div>
      </div>
    </div>
  </div>
</div>
