<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use app\components\mgcms\MgHelpers;
use yii\bootstrap\ActiveForm;
use yii\widgets\ListView;
use yii\helpers\Url;

$this->title = 'OEIIZK';

/* @var $searchModel TrainingSearch */

?>

<section class="bg-gray">
  <div class="container">
    <div class="row">

      <div class="<? if (MgHelpers::getUserModel()): ?>col-md-12<? else: ?>col-lg-7 order-2 order-lg-1 mt-3 mt-lg-0<? endif ?>">
        <h3>Filtruj listę szkoleń</h3>
        <?= $this->render('index/searchForm', ['searchModel' => $searchModel]) ?>
      </div>
      <? if (!MgHelpers::getUserModel()): ?>
        <div class="col-lg-5 order-1 order-lg-2">
          <div class="bg-white px-3 py-4">
            <h3 class="border-bottom border-primary-light pb-3 mb-3">Zaloguj się</h3>
            <?= $this->render('index/loginForm', ['modelLogin' => $modelLogin]) ?>
          </div>
        </div>
      <? endif ?>
    </div>
  </div>
</section>

<section class="szkolenia-list switching-list grid">
  <div class="container">
    <div class="row">
      <div class="col">
        <h1>Lista szkoleń</h1>
      </div>
      <div class="col text-right">
        <div class="listing-switcher">
          <a href="#" class="list-grid active"><i class="fa fa-th"></i></a>
          <a href="#" class="list-rows"><i class="fa fa-bars"></i></a>
           <a href="<?= Url::toRoute(['', 'orderName' => 0]) ?>" <? if (!$searchModel->orderName): ?>class="active"<?endif?>><i class="fa fa-calendar"></i></a>
          <a href="<?= Url::toRoute(['', 'orderName' => 1]) ?>" <? if ($searchModel->orderName): ?>class="active"<?endif?>><i class="fa fa-sort-alpha-asc"></i></a>
        </div>
      </div>
    </div>
    <div class="row offer">

      <?= $this->render('index/profiledOffer') ?>
      <?
      echo ListView::widget([
          'dataProvider' => $dataProvider,
          'summary' => '',
          'options' => ['class' => 'list-view', 'tag' => false],
          'itemOptions' => ['class' => 'item', 'tag' => false],
          'emptyTextOptions' => ['class' => '', 'tag' => false],
          'itemView' => function ($model, $key, $index, $widget) {
            return $this->render('/training/_index',
                    ['model' => $model, 'key' => $key, 'index' => $index, 'widget' => $widget, 'view' => $this]);
          },
      ]);

      ?>  
    </div>

  </div>



</section>

