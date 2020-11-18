<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \app\models\mgcms\db\User;
use app\components\mgcms\MgHelpers;

/* @var $model User */

?>


<h4>Wiadomość do DOS</h4>
<?php
$form = ActiveForm::begin([
        'id' => 'register-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
        ],
    ]);

?>

<?= Html::textarea('messageToDos') ?>


<div class="form-group">
  <div class="col-lg-offset-1 col-lg-11">
    <?= Html::submitButton('Wyślij', ['class' => 'btn btn-primary']) ?>
  </div>
</div>

<?php ActiveForm::end(); ?>