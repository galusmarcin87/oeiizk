<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\mgcms\db\Gallery */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Galleries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="gallery-view">

  <div class="row">
    <div class="col-sm-9">
      <h2><?= Yii::t('app', 'Gallery') . ' ' . Html::encode($this->title) ?></h2>
    </div>
    <div class="col-sm-3" style="margin-top: 15px">

      <? $controller = Yii::$app->controller->id;
              if(\app\components\mgcms\MgHelpers::getUserModel()->checkAccess($controller, 'update')):?>
              <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?endif?>
      <?=
      Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
          'class' => 'btn btn-danger',
          'data' => [
              'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
              'method' => 'post',
          ],
      ])

      ?>
    </div>
  </div>

  <div class="row">
    <?php
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        'link:html',
        'created_on',
        'order',
        'description:html',
        'promoted',
        'file.thumb:html'
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);

    ?>
  </div>
</div>

<?= $this->render('_images', ['model' => $model]) ?>