<?php
use app\components\mgcms\MgHelpers;

/* @var $model app\models\db\Event */

?>

<div class="item-inner">

  <div class="main">

    <div class="item-info">
      <div class="info-title">
        <h3><?= $model->name ?></h3>
      </div>

      <div class="time">
        <p class="hours">
          <? if ($model->date_from): ?>
            <?= date('d.m.Y H:i', strtotime($model->date_from)) ?> - <?= date('d.m.Y H:i', strtotime($model->date_to)) ?>
          <? endif ?>
          <br />
          <?= $model->lab ? $model->lab->fullName : '' ?>
        </p>
      </div>
    </div>

    <div class="image">
      <? if ($model->file && $model->file->isImage()): ?>
        <img src="<?= $model->file->getImageSrc(275, 130) ?>" class="image-fluid" alt="<?= (string)$model?>">
      <? endif ?>
    </div>

    <div class="description">
      <p><?= $model->info ?><p>
        <? if ($model->coments): ?>
        <p class="point"><?= $model->coments ?></p>
        <? endif ?>
    </div>
    <?if(strtotime($model->date_from) > strtotime('now')):?>
    <div class="more">
      <div class="more-wrap">
        <div class="link text-center">
          <p>
            <a href="<?= $model->link ?>" class="btn btn-outline-primary d-lg-block" title="Wydarzenie <?=$model->name?> - szczegóły">Szczegóły</a>
          </p>
          <p>
            <a href="<?= $model->link_to_registration ?>" class="btn btn-outline-primary d-lg-block">Rejestracja</a>
          </p>
        </div>
      </div>
    </div>
    <?endif?>
  </div>
</div>
