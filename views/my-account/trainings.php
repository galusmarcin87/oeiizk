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
$this->getAssetManager()->getBundle('yii\web\JqueryAsset')->jsOptions['position'] = \yii\web\View::POS_END;

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
            <section class="szkolenia-list switching-list list">
              <div class="container">

                <?php
                $forms = [
                    [
                        'label' => 'Aktualne',
                        'content' => ListView::widget([
                            'dataProvider' => $dataProviderNow,
                            'options' => ['class' => 'list-view row'],
                            'itemOptions' => ['class' => 'item', 'tag' => false],
                            'emptyTextOptions' => ['class' => 'col-md-12'],
                            'itemView' => function ($model, $key, $index, $widget) {
                              return $this->render('/training/_index', 
                                  [
                                      'model' => $model, 
                                      'key' => $key,
                                      'index' => $index, 
                                      'widget' => $widget, 
                                      'view' => $this,
                                      'fromMyAccount' => true
                                  ]);
                            },
                        ]),
                    ],
                    [
                        'label' => 'Nadchodzące',
                        'content' => ListView::widget([
                            'dataProvider' => $dataProviderFuture,
                            'options' => ['class' => 'list-view row'],
                            'itemOptions' => ['class' => 'item', 'tag' => false],
                            'emptyTextOptions' => ['class' => 'col-md-12'],
                            'itemView' => function ($model, $key, $index, $widget) {
                              return $this->render('/training/_index', 
                                  [
                                      'model' => $model, 
                                      'key' => $key,
                                      'index' => $index, 
                                      'widget' => $widget, 
                                      'view' => $this,
                                      'fromMyAccount' => true
                                  ]);
                            },
                        ]),
                    ],
                    [
                        'label' => 'Zakończone',
                        'content' => ListView::widget([
                            'dataProvider' => $dataProviderPrevious,
                            'options' => ['class' => 'list-view row'],
                            'itemOptions' => ['class' => 'item', 'tag' => false],
                            'emptyTextOptions' => ['class' => 'col-md-12'],
                            'itemView' => function ($model, $key, $index, $widget) {
                              return $this->render('/training/_index', 
                                  [
                                      'model' => $model, 
                                      'key' => $key,
                                      'index' => $index, 
                                      'widget' => $widget, 
                                      'view' => $this,
                                      'fromMyAccount' => true
                                  ]);
                            },
                        ]),
                    ],
                ];
                echo \yii\bootstrap\Tabs::widget([
                    'items' => $forms,
                    'encodeLabels' => false,
                ]);

                ?>

              </div>

            </section>


          </div>
        </div>
      </div>
    </div>
  </div>

</section>
