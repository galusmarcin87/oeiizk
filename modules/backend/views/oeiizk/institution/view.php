<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\db\Institution */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Institutions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="institution-view">

    <div class="row">
        <div class="col-sm-8">
            <h2><?= Yii::t('app', 'Institution') . ' ' . Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-4" style="margin-top: 15px">
            <?=
            Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . Yii::t('app', 'PDF'), ['pdf', 'id' => $model->id],
                [
                'class' => 'btn btn-danger',
                'target' => '_blank',
                'data-toggle' => 'tooltip',
                'title' => Yii::t('app', 'Will open the generated PDF file in a new window')
                ]
            )

            ?>
            <? $controller = Yii::$app->controller->id;
              if(\app\components\mgcms\MgHelpers::getUserModel()->checkAccess($controller, 'save-as-new')):?>
              <?= Html::a(Yii::t('app', 'Save As New'), ['save-as-new', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
            <?endif?>            
            <? $controller = Yii::$app->controller->id;
              if(\app\components\mgcms\MgHelpers::getUserModel()->checkAccess($controller, 'update')):?>
              <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?endif?>
            <?=
            Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id],
                [
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
            'short_name',
            'code',
            'created_on',
            [
                'attribute' => 'createdBy.username',
                'label' => Yii::t('app', 'Created By'),
            ],
            'patron',
            'city',
            'community',
            'county',
            'province',
            'street',
            'house_no',
            'postcode',
            'post',
            'phone',
            'www',
            'type',
            'is_verified:boolean',
            'territory',
            'school_group_name',
            'delegacy',
            'NIP',
            'email:email',
            'school_governing_body',
        ];
        echo DetailView::widget([
            'model' => $model,
            'attributes' => $gridColumn
        ]);

        ?>
    </div>

    <div class="row">
        <?php
        if ($providerLab->totalCount) {
          $gridColumnLab = [
              ['class' => 'yii\grid\SerialColumn'],
              ['attribute' => 'id', 'visible' => false],
              'name',
              'short_headquarter_name',
              'long_name:ntext',
              'floor',
              'is_our:boolean',
              [
                  'attribute' => 'createdBy.username',
                  'label' => Yii::t('app', 'Created By')
              ],
              'created_on',
          ];
          echo Gridview::widget([
              'dataProvider' => $providerLab,
              'pjax' => true,
              'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-lab']],
              'panel' => [
                  'type' => GridView::TYPE_PRIMARY,
                  'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Labs')),
              ],
              'columns' => $gridColumnLab
          ]);
        }

        ?>
    </div>

    <div class="row">
        <?php
        if ($providerWorkplace->totalCount) {
          $gridColumnWorkplace = [
              ['class' => 'yii\grid\SerialColumn'],
              ['attribute' => 'id', 'visible' => false],
              'position',
              'school_type',
              'educational_level',
              [
                  'attribute' => 'user.username',
                  'label' => Yii::t('app', 'User')
              ],
          ];
          echo Gridview::widget([
              'dataProvider' => $providerWorkplace,
              'pjax' => true,
              'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-workplace']],
              'panel' => [
                  'type' => GridView::TYPE_PRIMARY,
                  'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Workplace')),
              ],
              'columns' => $gridColumnWorkplace
          ]);
        }

        ?>
    </div>
</div>