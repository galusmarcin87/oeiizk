<?php

use app\components\mgcms\MgHelpers;
use yii\helpers\Url;
use \app\models\db\Training;

/* @var $model Training */

$template = $model->trainingTemplate;
if (!$template) {
    return false;
}
$educationalLevels = app\models\db\EducationalLevel::find()->all();
/* @var $currentUserParticipant app\models\db\TrainingParticipant */
$currentUserParticipant = MgHelpers::getUserModel() ? MgHelpers::getUserModel()->isTrainingParticipant($model) : false;
$isFromMyAccount = isset($fromMyAccount) && $fromMyAccount;

//$storedTeplateIds = Yii::$app->globalVariable->get('trainingTemplates', []);
//
//if (in_array($model->training_template_id, $storedTeplateIds)) {
//    return false;
//} else {
//    $storedTeplateIds[] = $model->training_template_id;
//    Yii::$app->globalVariable->set('trainingTemplates', $storedTeplateIds);
//}

?>

<div class="item">
    <div class="item-inner " id="id_<?= $model->id ?>">
        <div class="info-title">
            <h5><?= $template->type ?></h5>
            <h3><?= $model->name ?></h3>
        </div>
        <div class="main">
            <div class="item-info">
                <?= $this->render('common/tags', ['model' => $model]) ?>

                <p class="hours">
                    <? if ($template->hours_local): ?>
                        <?= $template->hours_local ?> godz. stacjonarnych
                    <? endif ?>

                    <? if ($template->hours_local && $template->hours_online): ?>
                        +
                    <? endif ?>

                    <? if ($template->hours_online): ?>
                        <?= $template->hours_online ?> godz. online
                    <? endif ?><br/>
                </p>
                <div class="dropdown">
                    <? if ($model->date_start): ?>
                        <?= date('d.m.Y', strtotime($model->date_start)) ?> - <?= date('d.m.Y', strtotime($model->date_end)) ?>
                    <? endif ?>
                    <?= $model->city && $model->city != 'Warszawa' ? ', ' . $model->city : '' ?>
                    <? if (!$model->isWaitingRoom() && sizeof($template->templateFutureTrainings) > 1): ?>
                        <a href="#" class="go" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                    class="fa fa-caret-right"></i></a>
                    <? endif ?>
                    <div class="dropdown-menu">
                        <? foreach ($template->templateFutureTrainings as $training): ?>
                            <a class="dropdown-item" href="<?= $training->url ?>">
                                <?= date('d.m.Y', strtotime($training->date_start)) ?>
                                - <?= date('d.m.Y', strtotime($training->date_end)) ?>
                                <?= $training->city && $training->city != 'Warszawa' ? ', ' . $training->city : '' ?>
                            </a>
                        <? endforeach ?>
                    </div>
                </div>

                <div class="image">
                    <? if ($template->imageFile && $template->imageFile->isImage()): ?>
                        <img src="<?= $template->imageFile->getImageSrc(275, 130) ?>" class="image-fluid"
                             alt="<?= $model ?>">
                    <? endif ?>
                    <span class="badge"><?= $model->code ?></span>
                </div>
                <? if ($currentUserParticipant && $isFromMyAccount): ?>
                    status: <?= $currentUserParticipant->status ?>
                <? endif ?>
            </div>

            <? if (!$model->isWaitingRoom()): ?>
                <div class="description">
                    <?= $template->lead ?>
                    <? if ($model->comments): ?>
                        <div class="text list-comments">
                            <p class="point"><?= $model->comments ?></p>
                        </div>
                    <? endif ?>
                </div>
            <? endif ?>
            <div class="more">
                <div class="more-wrap">
                    <? if ($model->comments): ?>
                        <div class="text">
                            <p class="point"><?= $model->comments ?></p>
                        </div>
                    <? endif ?>
                    <div class="link">
                        <p class="text-center">
	                        <a href="<?= $model->url ?>"
                                                  class="btn btn-outline-primary"
                               title="Szkolenie <?=$model->name?> - szczegóły"
	                        >Szczegóły</a></p>
                        <? if ($currentUserParticipant && $isFromMyAccount): ?>
                            <?
                            if (in_array($model->status,
                                [Training::STATUS_PROJECT, Training::STATUS_SIGN_TIME, Training::STATUS_AFTER_SIGNS, Training::STATUS_CONFIRMATIONS])):

                                ?>
                                <p class="text-center"><a
                                            href="<?= Url::to(['/training/resign', 'hash' => MgHelpers::encrypt($model->id . ':' . MgHelpers::getUserModel()->id)]) ?>"
                                            onclick="return confirm('Jesteś pewien?')" class="btn btn-outline-primary">Wypisz
                                        się</a></p>
                            <? endif ?>
                            <? if ($model->status == 'potwierdzenia' && $currentUserParticipant->canConfirm()): ?>
                                <p class="text-center"><a
                                            href="<?= Url::to(['/training/confirm', 'hash' => MgHelpers::encrypt($currentUserParticipant->id)]) ?>"
                                            class="btn btn-outline-primary">Potwierdź udział</a></p>
                            <? endif; ?>
                            <? if ($model->isPollActive()): ?>
                                <p class="text-center"><a
                                            href="<?= Url::to(['/poll/view', 'hash' => MgHelpers::encrypt($model->id)]) ?>"
                                            class="btn btn-outline-primary">Ankieta</a></p>
                            <? endif ?>
                            <? if ($model->is_certificate_issued && $model->certificate_template && $currentUserParticipant->is_passed): ?>
                                <p class="text-center"><a
                                            href="<?= Url::to(['generate-certificate', 'hash' => MgHelpers::encrypt($model->id)]) ?>"
                                            class="btn btn-outline-primary" target="_blank">Zaświadczenie</a></p>
                            <? endif ?>
                        <? endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
