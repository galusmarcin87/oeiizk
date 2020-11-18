<?php
use yii\helpers\Html;
use app\components\mgcms\MgHelpers;

/* @var $this yii\web\View */


$this->title = 'Archiwizuj dane';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="setting-view">

  <div class="row">
    <div class="col-sm-12">
      <h2><?= Html::encode($this->title) ?></h2>
      <?=
      Html::beginForm([''], 'post')
          . Html::submitButton(
              'Archiwizuj', ['class' => 'btn btn-warning']
          )
          . Html::endForm()

      ?>
    </div>
  </div>

</div>