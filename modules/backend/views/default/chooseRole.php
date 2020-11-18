<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Wybierz rolę dla tej sesji';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-login">
  <h1><?= Html::encode($this->title) ?></h1>


  <?php echo $form = Html::beginForm(); ?>

  <?= Html::dropDownList('role', '', yii\helpers\ArrayHelper::map($roles, 'slug', 'name'), ['class' => 'form-control']) ?>
  <div class="form-group top10">
    <div class="">
      <?= Html::submitButton('Wybierz rolę', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
    </div>
  </div>

  <?php Html::endForm(); ?>

</div>
