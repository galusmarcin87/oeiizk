<?php
use yii\helpers\Html;
use app\components\mgcms\yii\ActiveForm;
use app\components\mgcms\MgHelpers;
use app\models\mgcms\db\Article;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\mgcms\db\Article */
/* @var $form app\components\mgcms\yii\ActiveForm */

?>

<div class="article-form">

  <?php $form = ActiveForm::begin(); ?>

  <?= $form->errorSummary($model); ?>

  <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

  <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('title')]) ?>

  <?= $form->field($model, 'content')->tinyMce(['height' => 480]) ?>

  <?= $form->field($model, 'excerpt')->tinyMce() ?>

  <?= $form->field($model, 'status')->dropDownList(MgHelpers::translatedSBValueFromArray(Article::STATUSES)) ?>

  <div class="row">
    <div class="col-md-3">
       <?= $form->field($model, 'language')->dropDownList(array_combine(MgHelpers::getConfigParam('languages'), MgHelpers::getConfigParam('languages'))) ?>
    </div>

    <div class="col-md-3">
      <?=
      $form->field($model, 'category_id')->widget(\kartik\widgets\Select2::classname(), [
          'data' => \yii\helpers\ArrayHelper::map(\app\models\mgcms\db\Category::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
          'options' => ['placeholder' => Yii::t('app', 'Choose Category')],
          'pluginOptions' => [
              'allowClear' => true
          ],
      ]);

      ?>
    </div>

    <div class="col-md-3">
      <?=
      $form->field($model, 'parent_id')->widget(\kartik\widgets\Select2::classname(), [
          'data' => \yii\helpers\ArrayHelper::map(\app\models\mgcms\db\Article::find()->where($model->isNewRecord ? [] : ['<>','id',$model->id])->orderBy('id')->asArray()->all(), 'id', 'title'),
          'options' => ['placeholder' => Yii::t('app', 'Choose Article')],
          'pluginOptions' => [
              'allowClear' => true
          ],
      ]);

      ?>
    </div>

    <div class="col-md-3">
      <?= $form->field($model, 'file_id')->hiddenInput(); ?>

      <?
      Modal::begin([
          'header' => '<h2>' . Yii::t('app', 'Choose file') . '</h2>',
          'toggleButton' => ['label' => Yii::t('app', 'Choose file'), 'class' => 'btn btn-primary'],
          'size' => Modal::SIZE_LARGE,
          'options' => ['id' => 'fileModal']
      ]);

      ?>
      <iframe src="<?= Url::to(['mgcms/file/choose-file']) ?>" style="width:100%; height: 500px;" frameborder="0"></iframe>
      <?
      Modal::end();

      ?>
      <div id="imageFileWrapper" class="width100">
        <? if ($model->file): ?>
          <? if ($model->file->isImage()): ?>
            <?= $model->file->thumb ?>
          <? else: ?>
            <a class="top10" href="<?= $model->file->webPath ?>"><?= $model->file ?></a>
          <? endif ?>
        <? endif ?>
      </div>
    </div>

  </div>



  <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('meta_title')]) ?>

  <?= $form->field($model, 'meta_description')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('meta_description')]) ?>

  <?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('meta_keywords')]) ?>
  
  
  
  <div class="row">
    <div class="col-md-3">
      <?= $form->field($model, 'promoted')->switchInput() ?>
    </div>
    <div class="col-md-3">
      <?= $form->relatedFileInput($model, true, true) ?>
    </div>
  </div>
  

  <div class="hidden">

    <?= $form->field($model, 'order')->textInput(['placeholder' => $model->getAttributeLabel('order')]) ?>

    
    <?= $form->field($model, 'custom')->textarea(['rows' => 6]) ?>

    <?=
    $form->field($model, 'type')->dropDownList(app\components\mgcms\MgHelpers::arrayKeyValueFromArray(\app\models\mgcms\db\Article::TYPES, true), ['maxlength' => true, 'placeholder' => 'Type', 'prompt' => ''])

    ?>
  </div>
  
  <?= $form->field($model, 'tagString')->widget(\mgcms\tokenfield\Tokenfield::className(), [
    'pluginOptions' => [
        'delimiter' => ',', // default ',' (comma)
        'showAutocompleteOnFocus' => true,
        'autocomplete' => [
            'source' => \app\models\mgcms\db\Tag::getTagsNamesArray(),
            'delay' => 100,
        ],
    ],
]); ?>
  
  <div class="well">
    <legend><?= Yii::t('app', 'Images');?></legend>
    <?= $this->render('/common/_images', ['model' => $model, 'editable' => true]) ?>
  </div>
  
  <div class="form-group">
    <?=
    Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])

    ?>
    <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer, ['class' => 'btn btn-danger']) ?>
  </div>

  <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">
  function chooseFile(fileId, fileSrc, isImage) {
    $('#article-file_id').val(fileId);
    $('#imageFileWrapper').html(isImage ? '<img src="' + fileSrc + '"/>' : '<a href="' + fileSrc + '">' + fileSrc + '</a>');
    $('#fileModal').modal('toggle');
  }
</script>