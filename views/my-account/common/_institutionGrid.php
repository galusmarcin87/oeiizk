<?php
use kartik\grid\GridView;
use yii\helpers\Html;


?>
<?php
  $gridColumn = [
      ['attribute' => 'id', 'visible' => false],
      'code',
      'name',
      'postcode',
      'post',
      'street',
      'house_no',
      [
          'class' => yii\grid\ActionColumn::className(),
          'template' => '{choose}',
          'buttons' => [
              'choose' => function ($url, $model) {
                  return '<button class="btn btn-primary" onclick="chooseInstitution('.$model->id.',\''.$model->name.'\')">Wybierz</button>';
              },
          ],
      ],
  ];

  ?>
  <?=
  GridView::widget([
      'dataProvider' => $dataProvider,
      'filterModel' => $searchModel,
      'columns' => $gridColumn,
      'pjax' => true,
      'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-institution']],
      'toolbar' => false
  ]);

  ?>