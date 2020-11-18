<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use app\components\mgcms\MgHelpers;
use yii\bootstrap\ActiveForm;
use yii\widgets\ListView;
use yii\helpers\Url;

$this->title = 'Konferencje - OEIIZK';

?>

<section class="events-list list">
    <div class="container">
        <div class="row">
            <div class="col-md-10 order-2 order-md-1">
                <h1>Konferencje</h1>
            </div>
            <div class="col-md-2 order-1 order-md-2">
                <?if(Yii::$app->request->get('archive')):?>
                  <a href="<?=Url::toRoute(['','archive' => 0])?>" class="btn btn-outline-primary">Konferencje aktualne</a>
                <?else:?>
                  <a href="<?=Url::toRoute(['','archive' => 1])?>" class="btn btn-outline-primary">Konferencje archiwalne</a>
                <?endif?>
            </div>

        </div>
        <?=
        ListView::widget([
            'dataProvider' => $dataProvider,
            'options' => ['class' => 'list-view row'],
            'itemOptions' => ['class' => 'item'],
            'emptyTextOptions' => ['class' => 'col-md-12'],
            'itemView' => function ($model, $key, $index, $widget) {
              return $this->render('/training/_index2',
                      ['model' => $model, 'key' => $key, 'index' => $index, 'widget' => $widget, 'view' => $this, 'type' => 'c']);
            },
        ])

        ?> 
    </div>
</section>