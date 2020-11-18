<?php
use kartik\grid\GridView;
use yii\helpers\Html;


?>
<?php
  $gridColumn = [
      ['attribute' => 'id', 'visible' => false],
      'first_name',
      'last_name',
      'email',
      [
          'class' => yii\grid\ActionColumn::className(),
          'template' => '{choose}',
          'buttons' => [
              'choose' => function ($url, $model) {
                  return '<button class="btn btn-primary" onclick="chooseUser('.$model->id.',\''.$model->first_name.'\',\''.$model->last_name.'\',\''.$model->email.'\')">Wybierz</button>';
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