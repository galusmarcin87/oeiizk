<?php
use yii\helpers\Html;
use app\components\mgcms\yii\ActiveForm;
use app\components\mgcms\MgHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\mgcms\db\User */
/* @var $form app\components\mgcms\yii\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'User',
        'relID' => 'user',
        'value' => \yii\helpers\Json::encode($model->users),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);

?>

<div class="user-form">

    <?php
    $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data'],
    ]);

    ?>

    <?= $form->errorSummary($model); ?>

    <div class="row">
        <legend>Podstawowe dane</legend>

        <div class="col-md-4">
            <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('username')]) ?>

        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('username')]) ?>

        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('first_name')]) ?>

        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('last_name')]) ?>

        </div>
        <? if (MgHelpers::isAdmin()): ?>
          <div class="col-md-4">
              <?=
              $form->field($model, 'role')->dropDownList(MgHelpers::arrayCombineFromOneArray(Yii::$app->params['roles']),
                  ['maxlength' => true])

              ?>

          </div>
        <? endif ?>
        <div class="col-md-4">
            <?=
            $form->field($model, 'status')->dropDownList(MgHelpers::arrayTranslateValues(\app\models\mgcms\db\User::STATUSES),
                ['maxlength' => true])

            ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'is_special_account')->switchInput() ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'is_password_change_accepted')->switchInput() ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('email')]) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'date_email_confirmation')->textInput(['disabled' => true]) ?>
        </div>

        <div class="col-md-4">
            <?=
            $form->field($model, 'gender')->dropDownList(MgHelpers::arrayTranslateValues(\app\models\mgcms\db\User::GENDERS),
                ['maxlength' => true, 'prompt' => ''])

            ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'birthdate')->datePicker(); ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'birth_place')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('birth_place')]) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'create_account_additional_data')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('create_account_additional_data')]) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'credibility')->textInput(['disabled' => true, 'value' => $model->getCredibilityCalc()]) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'is_newsletter')->checkbox(['disabled' => true]) ?>
        </div>


        <div class="col-md-4">
            <?=
            Html::a(' ' . Yii::t('app', 'Pobierz swoje dane'), ['pdf', 'id' => $model->id],
                [
                'class' => 'btn btn-danger',
                'target' => '_blank',
                'data-toggle' => 'tooltip',
                ]
            )

            ?>

        </div>
    </div>
    <div class="row">
        <legend>Zatrudnienie</legend>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4">
                    <?= $form->field($model, 'academic_title')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('academic_title')])->label('Tytuł naukowy (dla wykładowców)') ?>
                </div>

                <?= $form->field4md($model, 'position')->dropdownFromSettings('stanowisko') ?>



                <div class="col-md-4">
                    <div class="form-group field-user-employmentCard">
                        <label class="control-label" for="user-employmentCard">Karta potwierdzenia zatrudnienia</label>
                        <div>
                            <? if ($model->employmentCard): ?>
                              <?= $model->employmentCard->link ?>
                            <? endif ?>
                            <br/><br/>
                        </div>

                        <input type="hidden" name="User[uploadEmploymentFile]" value="">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="skan" name="User[uploadEmploymentFile]">
                            <label class="custom-file-label" for="skan">wczytaj plik</label>
                        </div>
                        <div class="help-block"></div>
                    </div>
                </div>

                <div class="col-md-4">
                    <?=
                    Html::a(' ' . 'Generuj potwierdzenie zatrudnienia', ['generate-employee-card-pdf', 'id' => $model->id],
                        [
                        'class' => 'btn btn-success',
                        'target' => '_blank',
                        'data-toggle' => 'tooltip',
                        'title' => Yii::t('app', 'Will open the generated PDF file in a new window')
                        ]
                    )

                    ?>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-success" type="button" onclick="setTodayDateInput('#user-date_card_verification')">
                        Potwierdz zatrudnienie
                    </button>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'date_card_verification')->datePicker() ?>

                </div>
            </div>
        </div>



        <legend>Dodatkowe dane</legend>

        <?= $form->field4md($model, 'other_names')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('other_names')]) ?>


        <?= $form->field4md($model, 'address')->textInput()->label('Adres (do korespondencji)') ?>

        <?= $form->field4md($model, 'postcode')->textInput()->label('Kod pocztowy (do korespondencji)') ?>

        <?= $form->field4md($model, 'city')->textInput()->label('Miasto (do korespondencji)') ?>

        <?= $form->field4md($model, 'phone')->textInput() ?>

        <?= $form->field4md($model, 'comments')->textarea() ?>

        <legend>Preferencje szkoleniowe</legend>

        <div class="col-md-4">
            <?= $form->field($model, 'training_preferences_keywords')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('training_preferences_keywords')]) ?>

        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'training_preferences')->textarea() ?>

        </div>
        
        <div class="col-md-4">
            <?= $form->field($model, 'is_profiled_offer_enabled')->switchInput() ?>
        </div>

    </div>

    <? if (!$model->isNewRecord): ?>
      <div class="row">
          <div class="col-md-6">
              <p><?= Html::a('Aktualizuj dane relacyjne', ['update-related', 'id' => $model->id], ['class' => 'btn btn-info']) ?></p>
          </div>
      </div>
    <? endif ?>


    <div class="form-group">
        <?=
        Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])

        ?>
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer, ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
  function setTodayDateInput(selector) {
      var today = new Date();
      var phpDate = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
      $(selector).val(phpDate);
      $(selector+'-disp').val(phpDate);
  }
</script>