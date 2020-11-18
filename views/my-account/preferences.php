<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \app\models\mgcms\db\User;
use app\components\mgcms\MgHelpers;
use yii\widgets\ListView;

/* @var $model User */

$this->title = 'Moje konto';

?>

<section class="profile">
    <div class="container">

        <?= $this->render('_header') ?>

        <div class="row">
            <div class="col-lg-3">
                <?= $this->render('_menu') ?>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-12">

                        <?php
                        $form = ActiveForm::begin([
                                'id' => 'register-form',
                                'options' => ['enctype' => 'multipart/form-data'],
//        'layout' => 'horizontal',
                                'fieldConfig' => [
                                ],
                        ]);

                        ?>

                        <?= $form->field($model, 'training_preferences')->textarea() ?>

                        <? // $form->field($model, 'training_preferences_keywords')->textInput(['disabled' => true]) ?>




                        <div class="row align-items-center form-group ">
                            <div class="col-9">

                            </div>
                            <div class="col-3">
                                <button type="submit" class="btn btn-danger btn-block">Zapisz</button>
                            </div>
                        </div>

                        <?php ActiveForm::end(); ?>




                        <section class="szkolenia-list switching-list list">

                            <?php
                            $tabs = [
                                [
                                    'label' => '<i class="glyphicon glyphicon-book"></i> Preferencje szkoleniowe uczestnika',
                                    'content' => ListView::widget([
                                        'dataProvider' => $dataProviderMy,
                                        'options' => ['class' => 'list-view row'],
                                        'itemOptions' => ['class' => 'item', 'tag' => false],
                                        'emptyTextOptions' => ['class' => 'col-md-12'],
                                        'itemView' => function ($model, $key, $index, $widget) {
                                          return $this->render('/training/_index',
                                                  ['model' => $model, 'key' => $key, 'index' => $index, 'widget' => $widget, 'view' => $this]);
                                        },
                                    ]),
                                ],
                                [
                                    'label' => '<i class="glyphicon glyphicon-book"></i> Poczekalnia' ,
                                    'content' => ListView::widget([
                                        'dataProvider' => $dataProvider,
                                        'options' => ['class' => 'list-view row'],
                                        'itemOptions' => ['class' => 'item', 'tag' => false],
                                        'emptyTextOptions' => ['class' => 'col-md-12'],
                                        'itemView' => function ($model, $key, $index, $widget) {
                                          return $this->render('/training/_index',
                                                  ['model' => $model, 'key' => $key, 'index' => $index, 'widget' => $widget, 'view' => $this]);
                                        },
                                    ]),
                                ],
                            ];
                            echo \yii\bootstrap\Tabs::widget([
                                'items' => $tabs,
                                'encodeLabels' => false,
                            ]);

                            ?>

                        </section>




                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
