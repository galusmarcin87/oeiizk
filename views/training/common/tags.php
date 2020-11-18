<?php
use app\components\mgcms\MgHelpers;
use app\components\mgcms\OeiizkHelpers;

/* @var $model app\models\db\Training */
$template = $model->trainingTemplate;
if (!$template) {
  return false;
}
$educationalLevels = app\models\db\EducationalLevel::find()->all();

?>

<div class="tags">
    <? if ($template->category && isset($template->category->files[0]) && $template->category->files[0]->isImage() && !$model->isWaitingRoom()): ?>
      <img src="<?= $template->category->files[0]->getImageSrc(35, 35) ?>" alt="<?= $model ?>">
    <? endif ?>
    <? foreach ($educationalLevels as $index => $educationalLevel): ?>
      <span 
          class="tag <? if ($model->trainingTemplate->hasEducationalLevel($educationalLevel)): ?>tag-main<? endif ?>"
          <? if (in_array($index, [2, 3])): ?>style="margin-left: 0"<? endif ?>
          title="<?= OeiizkHelpers::getTrainingEducationalLevelTitle($educationalLevel)?>"
          ><?= $educationalLevel ?></span>
        <? endforeach ?>
</div>