<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
use yii\helpers\Html;
use app\components\mgcms\yii\ActiveForm;
use \app\models\mgcms\db\User;
use app\components\mgcms\MgHelpers;

$this->getAssetManager()->getBundle('yii\web\JqueryAsset')->jsOptions['position'] = \yii\web\View::POS_END;

/* @var $model User */

$this->title = 'Moje konto';

\mootensai\components\JsBlock::widget(['viewFile' => 'common/_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'Workplace',
        'relID' => 'workplace',
        'value' => \yii\helpers\Json::encode($model->workplaces),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);

\mootensai\components\JsBlock::widget(['viewFile' => 'common/_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'UserSubject',
        'relID' => 'user-subject',
        'value' => \yii\helpers\Json::encode($model->subjects),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);

\mootensai\components\JsBlock::widget(['viewFile' => 'common/_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'UserEducationalLevel',
        'relID' => 'user-educational-level',
        'value' => \yii\helpers\Json::encode($model->userEducationalLevels),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);

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
                                'id' => 'workspace-form',
                                'options' => ['enctype' => 'multipart/form-data'],
//        'layout' => 'horizontal',
                                'fieldConfig' => [
                                ],
                        ]);

                        ?>

                        <? echo $form->errorSummary($model); ?>


                        <?php
                        $forms = [
                            [
                                'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Workplaces')),
                                'content' => $this->render('common/_formWorkplace',
                                    [
                                    'row' => \yii\helpers\ArrayHelper::toArray($model->workplaces),
                                ]),
                            ],
                            [
                                'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Subjects')),
                                'content' => $this->render('common/_formUserSubject',
                                    [
                                    'row' => \yii\helpers\ArrayHelper::toArray($model->userSubjects),
                                ]),
                            ],
                            [
                                'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Educational Levels')),
                                'content' => $this->render('common/_formUserEducationalLevel',
                                    [
                                    'row' => \yii\helpers\ArrayHelper::toArray($model->userEducationalLevels),
                                ]),
                            ],
                        ];
                        echo \yii\bootstrap\Tabs::widget([
                            'items' => $forms,
                            'encodeLabels' => false,
                        ]);

                        ?>


                        <?= $form->field($model, 'position')->dropdownFromSettings('stanowisko') ?>

                        <? if (app\components\mgcms\OeiizkHelpers::isRole(User::ROLE_LECTOR)): ?>
                          <?= $form->field($model, 'academic_title')->textInput() ?>
                        <? endif ?>

                        <div class="row">
                            <div class="col-md-5">
                                <?=
                                Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . 'Generuj potwierdzenie zatrudnienia',
                                    ['generate-employee-card-pdf'],
                                    [
                                    'class' => 'btn btn-success',
                                    'target' => '_blank',
                                    'onclick' => 'return canGenerateEmployeCard()',
                                    'data-toggle' => 'tooltip',
                                    ]
                                )

                                ?>
                            </div>
                            <div class="col-md-7">
                                <label>
                                Proszę wydrukować potwierdzenie, podpisać je, poprosić o pieczęć szkoły oraz o podpis i pieczęć dyrektora. Potwierdzenie należy zeskanować i umieść plik ze skanem na platformie.
                                </label>
                            </div>
                        </div>


                        <div class="row form-group">
                            <div class="col-12">
                                <label for="skan">Skan aktualnego potwierdzenia zatrudnienia
                                    <? if ($model->employmentCard): ?>: 
                                      <?= $model->employmentCard->link ?>
                                    <? endif ?>
                                </label>
                                <input type="hidden" name="User[uploadEmploymentFile]" value="">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="skan" name="User[uploadEmploymentFile]">
                                    <label class="custom-file-label" for="skan">wczytaj plik</label>
                                </div>
                            </div>
                        </div>



                        <?= $form->field($model, 'date_card_verification')->textInput(['disabled' => true])
                                        ->label('<div class="row"><div class="col-md-5">Data weryfikacji potwierdzenia.</div><div class="col-md-7">Zgłoszenie zostanie zweryfikowane przez pracownika Działu Obsługi Szkoleń. W tym miejscu zostanie wpisana data weryfikacji.</div></div>') ?>



                        <div class="row align-items-center form-group ">
                            <div class="col-9">

                            </div>
                            <div class="col-3">
                                <button type="submit" class="btn btn-danger btn-block">Zapisz</button>
                            </div>
                        </div>

                        <?php ActiveForm::end(); ?>


                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- Modal -->
<div class="modal fade wide" id="institutionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Wybierz instytucję</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?=
                $this->render('common/_institutionGrid',
                    [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ])

                ?>
                
                Jeśli brakuje Twojej instytucji, możesz ją dodać <a href="<?=yii\helpers\Url::to('add-institution') ?>" class="btn btn-danger">Tutaj</a>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
  var isFormTouched = false;
  function canGenerateEmployeCard() {
      if (isFormTouched) {
          alert("Zmieniłeś dane bez zapisania – najpierw zapisz, aby wygenerować potwierdzenie.");
          return false;
      } else {
          return true;
      }
  }

  document.addEventListener('DOMContentLoaded', function () {
      $('#workspace-form :input').change(function () {
          isFormTouched = true;
      });
      $('.kv-batch-create, .remove .glyphicon-trash').click(function () {
          isFormTouched = true;
      });


  }, false);

  var indexWorkplaceChosen = false;
  function showInstitutionModal(index) {
      indexWorkplaceChosen = index;
      $('#institutionModal').modal('show')
  }

  function chooseInstitution(id, name) {
      $('input[name="Workplace[' + indexWorkplaceChosen + '][institution_id]"]').val(id);
      $('#institutionName_' + indexWorkplaceChosen).text(name);
      $('#institutionModal').modal('hide');
  }


</script>