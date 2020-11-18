<?php
use app\components\mgcms\MgHelpers;
use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;

/* @var $model app\models\db\Training */
$template = $model->trainingTemplate;
if (!$template) {
  return false;
}

$educationalLevels = app\models\db\EducationalLevel::find()->all();

?>

<section class="szkolenie">
  <div class="item">
    <div class="container">
      <div class="row">
        <div class="col">
          <p><?= $template->type ?></p>
          <h1 class="mb-3"><?= $model->name ?></h1>
          <h3><?= $model->subtitle ?></h3>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-6">
          <div class="item-info">
            <div class="row">
              <div class="col-lg-6">

                <?= $this->render('common/tags',['model'=>$model])?>

                <p class="hours"><? if ($template->hours_local): ?>
                    <?= $template->hours_local ?> godz. stacjonarnych
                  <? endif ?>

                  <? if ($template->hours_local && $template->hours_online): ?>
                    +
                  <? endif ?>

                  <? if ($template->hours_online): ?>
                    <?= $template->hours_online ?> godz. online
                  <? endif ?><br />
                <div class="dropdown">
                  <? if ($model->date_start): ?>
                    <?= date('d.m.Y', strtotime($model->date_start)) ?> - <?= date('d.m.Y', strtotime($model->date_end)) ?>
                    <?= $model->city && $model->city != 'Warszawa' ? ', ' . $model->city : '' ?>
                  <? endif ?>
                  <? if (!$model->isWaitingRoom() && sizeof($template->templateFutureTrainings) > 1): ?>
                    <a href="#" class="go" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-caret-right"></i></a></p>
                  <? endif ?>
                  <div class="dropdown-menu">
                    <? foreach ($template->templateFutureTrainings as $training): ?>
                      <a class="dropdown-item" href="<?= $training->url ?>">
                        <?= date('d.m.Y', strtotime($training->date_start)) ?> - <?= date('d.m.Y', strtotime($training->date_end)) ?>
                        <?= $training->city && $training->city != 'Warszawa' ? ', ' . $training->city : '' ?>
                      </a>
                    <? endforeach ?>
                  </div>
                </div>
                <table class="project-info">
                  <? if ($model->lectorsStr): ?>
                    <tr>
                      <td>Prowadzący:</td>
                      <td><?= $model->lectorsStrNewLines ?></td>
                    </tr>
                  <? endif ?>
                  <? if ($model->project): ?>
                    <tr>
                      <td>Projekt:</td>
                      <td><?= $model->project ?></td>
                    </tr>
                  <? endif ?>
                  <? if ($template->training_path): ?>
                    <tr>
                      <td>Ścieżka:</td>
                      <td><?= $template->training_path ?></td>
                    </tr>
                  <? endif ?>
                </table>

              </div>
              <div class="col-lg-6">
                <div class="image">
                  <? if ($template->imageFile && $template->imageFile->isImage()): ?>
                    <img src="<?= $template->imageFile->getImageSrc(275, 130) ?>" class="image-fluid" alt="<?=$model?>">
                  <? endif ?>
                  <span class="badge"><?= $model->code ?></span>
                </div>
              </div>
            </div>

            <? if ($model->comments): ?>
              <div class="text">
                <p class="point">
                  <?= $model->comments ?>
                </p> 
              </div>
            <? endif ?>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="description">
            <?= $template->lead ?>
          </div>

        </div>
      </div>

      <?php
      $form = ActiveForm::begin([
              'id' => 'register-workshops',
              'action' => \yii\helpers\Url::to(['sign-in', 'hash' => \app\components\mgcms\MgHelpers::encrypt($model->id)]),
              'encodeErrorSummary' => false,
//                    'layout' => 'horizontal',
              'options' => [
                  'class' => 'register-form form-light'
              ],
              'fieldConfig' => [
              ],
      ]);

      ?>

      <?=
      $this->render('_workshops', [
          'model' => $model
      ])

      ?>

      <div class="bg-light p-3 mb-4">
        <div class="row">
          <? if ($template->programFile): ?>
            <div class="col-md-6 text-center text-md-left mb-3 mb-md-0">
              <a href="<?= $template->programFile->linkUrl ?>" target="_blank" class="btn btn-outline-primary font-weight-bold">Program</a>
            </div>
          <? endif ?>
          <div class="col-md-6 text-center ml-auto text-md-right">
            <? if ($model->isRegisteringAvailable()): ?>
              <? if (MgHelpers::getUserModel() && MgHelpers::getUserModel()->isTrainingParticipant($model)): ?>
                <?if(sizeof($model->workshops) > 0):?>
                  <button type="submit" class="btn btn-danger btn-signup">
                    Zapisz się<? if ($template->type != 'konferencja'): ?> na szkolenie<? endif ?>
                  </button>
                <?else:?>
                  <span class="btn btn-link">Zapisano</span>
                <?endif?>
              <? else: ?>
                <button type="submit" class="btn btn-danger btn-signup">
                  Zapisz się<? if ($template->type != 'konferencja'): ?> na szkolenie<? endif ?>
                </button>
              <? endif ?>
            <? endif ?>
          </div>
        </div>
      </div>

      <?php ActiveForm::end(); ?>

      <div class="content">

        <? if ($template->preliminary_recommendations): ?>
          <h3>Wymagania wstępne</h3>
          <div>
            <?= $template->preliminary_recommendations ?>
          </div>
        <? endif ?>
        <? if ($model->trainingRequireds): ?>
          <h3>Wymagane szkolenia</h3>
          <ol>
            <? foreach ($model->trainingRequireds as $trainingRequired): ?>
              <li><?= $trainingRequired->trainingRequired ?></li>
            <? endforeach ?>
          </ol>
        <? endif ?>

        <? if ($model->lessons): ?>
          <h3>Zajęcia stacjonarne</h3>
          <div class="table-responsive">

            <table>
              <thead>
                <tr>
                  <th>LP.</th>
                  <th>Termin</th>
                  <th>Miejsce</th>
                </tr>
              </thead>
              <tbody>
                <? foreach ($model->lessons as $index => $lesson): ?>
                  <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= date('d.m.Y', strtotime($lesson->date_start)) ?> (<?= \Yii::$app->formatter->asDate(date('Y-m-d', strtotime($lesson->date_start)), 'EEEE') ?>)<br />w godz. <?= date('H:i', strtotime($lesson->date_start)) ?> - <?= date('H:i', strtotime($lesson->date_end)) ?></td>
                    <td><?= $lesson->lab ? $lesson->lab->fullNameWithoutLabName : '' ?></td>
                  </tr>
                <? endforeach; ?>
              </tbody>
            </table>
          </div>
        <? endif ?>

        <? if ($model->link_to_materials): ?>
          <a href="<?= $model->link_to_materials ?>" class="btn btn-outline-primary" target="_blank">Materiały online</a>
        <? endif ?>

        <h3>Cennik</h3>

        <a href="#" style="display:none" class="btn btn-outline-primary" data-toggle="collapse" data-target="#cennik" aria-expanded="false" aria-controls="cennik">Więcej informacji</a>

        <div class="" id="cennik">
          <div class="pt-4">
            <?= $model->price_category ?>
          </div>

        </div>

      </div>

    </div>
  </div>
</section>

