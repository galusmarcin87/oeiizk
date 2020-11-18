<?
use yii\helpers\Html;
use \app\components\mgcms\MgHelpers;

/* @var $model app\models\db\Training */
?>



  <div class="row">
  <?=
  $form->field6md($model, 'poll_id')->widget(\kartik\widgets\Select2::classname(),
      [
          'data' => \yii\helpers\ArrayHelper::map(\app\models\db\Poll::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
          'options' => ['placeholder' => Yii::t('app', 'Choose Poll')],
          'pluginOptions' => [
              'allowClear' => true
          ],
  ]);

  ?>

  <?= $form->field6md($model, 'poll_from')->datePicker() ?>

  <?= $form->field6md($model, 'poll_to')->datePicker() ?>

  </div>


    <?=
    Html::a('<i class="fa glyphicon glyphicon-list"></i> ' . Yii::t('app', 'Generuj ankietę'), ['generate-poll', 'id' => $model->id], [
        'class' => 'btn btn-success',
        'target' => '_blank',
        ]
    )

    ?>

    <?=
      $model->isPollActive() ? 
    Html::a('' . Yii::t('app', 'Link do ankiety'), ['/poll/view', 'hash' => MgHelpers::encrypt($model->id)], [
        'class' => 'btn btn-info',
        'target' => '_blank',
        ]
    ) : ''

    ?>

    <?=
    Html::a('' . Yii::t('app', 'Odpowiedzi na ankietę'), ['poll-answers', 'id' => $model->id], [
        'class' => 'btn btn-info',
        'target' => '_blank',
        ]
    )

    ?>



