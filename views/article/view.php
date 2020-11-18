<?php
/* @var $model app\models\mgcms\db\Article */
$this->registerLinkTag(['rel' => 'canonical', 'href' => \yii\helpers\Url::canonical()]);

?>

<section>
  <div class="item">
    <div class="container">
      <div class="row">
        <div class="col">
          <h1 class="mb-3"><?= $model->title ?></h1>
          <? if ($model->file): ?>
            <div class="atricleImage">
              <?= $model->file->getImage(1140, 0, ['class' => 'img-responsive']) ?>
            </div>
          <? endif ?>

          <div class="articleBody">
            <?= $model->content ?>
          </div>

          <div class="articleTags">
            <? foreach ($model->tags as $tag): ?>
              <a class="tag badge badge-default" href="<?= $tag->linkUrl ?>">
                <?= $tag ?>
              </a>
            <? endforeach ?>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>