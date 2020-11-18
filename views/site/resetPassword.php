<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ChangePasswordForm */
use yii\helpers\Html;
use app\components\mgcms\yii\ActiveForm;

$this->title = Yii::t('app', 'Change password');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="container">
    <article class="main">
        <div class="register-block">

            <div class="row">
                <div class="col-md-12 col-lg-5">
                    <div class="bg-white p-4">
                        <h3 class="border-bottom border-primary-light pb-3 mb-3">Zmiana hasła</h3>

                        <div class="article-form">
                            <?php
                            $form = ActiveForm::begin();

                            ?>

                            <?= $form->field($model, 'password')->passwordInput() ?>
                            <?= $form->field($model, 'passwordRepeat')->passwordInput() ?>


                            <div class="form-group">
                                <div class="col-lg-12">
                                    <?=
                                    Html::submitButton(Yii::t('app', 'Change password'),
                                        ['class' => 'btn btn-primary', 'name' => 'login-button'])

                                    ?>
                                </div>
                            </div>

                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
</div>