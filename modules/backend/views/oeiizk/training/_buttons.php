<?

use yii\helpers\Html;
use \app\components\mgcms\MgHelpers;

?>

<div class="col-sm-12" style="margin-top: 15px; margin-bottom: 15px;">

      <?=
      $model->status == app\models\db\Training::STATUS_CLOSED ?
          Html::a(Yii::t('app', 'Zmień status'), ['status-edit', 'id' => $model->id], [
              'class' => 'btn btn-danger',
              'target' => '_blank',
              ]
          ) : ''

      ?>


     
      <?=
      Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . Yii::t('app', 'PDF'), ['pdf', 'id' => $model->id], [
          'class' => 'btn btn-danger',
          'target' => '_blank',
          'data-toggle' => 'tooltip',
          'title' => Yii::t('app', 'Will open the generated PDF file in a new window')
          ]
      )

      ?>
      <?
      $controller = Yii::$app->controller->id;
      if (\app\components\mgcms\MgHelpers::getUserModel()->checkAccess($controller, 'save-as-new')):

        ?>   
        <?= Html::a(Yii::t('app', 'Save As New'), ['save-as-new', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
      <? endif ?>          


      <?
      $controller = Yii::$app->controller->id;
      if (\app\components\mgcms\MgHelpers::getUserModel()->checkAccess($controller, 'update') && $model->status != app\models\db\Training::STATUS_CLOSED):

        ?>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
      <? endif ?>
      <?
      $controller = Yii::$app->controller->id;
      if (\app\components\mgcms\MgHelpers::getUserModel()->checkAccess($controller, 'delete')):

        ?>
        <?=
        Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ])

        ?>
      <? endif ?>

      <?=
      Html::a('<i class="fa glyphicon glyphicon-lock"></i> ' . 'Link z hasłem', ['/training/view', 'code' => $model->code,'password'=> MgHelpers::encrypt($model->id)], [
          'class' => 'btn btn-success',
          'target' => '_blank',
          ]
      )

      ?>
    </div>