<?php
use \yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $model app\models\mgcms\db\Article */

?>

<a class="row articleLink" href="<?= $model->linkUrl ?>">
    <div class="wrapper">
        <? if ($model->file): ?>
          <div class="col-md-3">
              <?= $model->file->getImage(255, 255, ['class' => 'img-responsive'], \Imagine\Image\ManipulatorInterface::THUMBNAIL_OUTBOUND) ?>
          </div>
        <? endif ?>
        <div class="col-md-<?= $model->file ? 9 : 12 ?>">
            <span class="pull-right"><?= $model->created_on ?></span>
            <h2><?= $model->title ?></h2>
            <div class="desc"><?= $model->excerpt ?></div>
        </div>
    </div>
</a>

