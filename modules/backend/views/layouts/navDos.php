<?php
use \app\components\mgcms\MgHelpers;
use app\components\mgcms\T;
use yii\helpers\Html;

return [
    ['label' => 'Użytkownicy', 'visible' => MgHelpers::checkAccess('user', 'menu'), 'items' => [
            ['label' => T::t('Użytkownicy'), 'url' => '/backend/mgcms/user', 'visible' => MgHelpers::checkAccess('user', 'index')],
            ['label' => T::t('Zatrudnienie'), 'url' => '/backend/mgcms/user/index-employment', 'visible' => MgHelpers::checkAccess('user', 'index-employment')],
            ['label' => T::t('Role i grupy'), 'url' => '/backend/mgcms/user/index-roles-and-groups', 'visible' => MgHelpers::checkAccess('user', 'index-roles-and-groups')],
            ['label' => T::t('Messages'), 'url' => '/backend/mgcms/message', 'visible' => MgHelpers::checkAccess('message', 'index')],
            ['label' => T::t('Groups'), 'url' => '/backend/oeiizk/group', 'visible' => MgHelpers::checkAccess('group', 'index')],
            ['label' => 'Wyślij SMS', 'url' => '/backend/mgcms/message/send-sms', 'visible' => MgHelpers::checkAccess('message', 'send-sms')],
            ['label' => T::t('Messages'), 'url' => '/backend/mgcms/message', 'visible' => MgHelpers::checkAccess('message', 'index')],
        ]],
    ['label' => T::t('Training Templates'), 'url' => '/backend/oeiizk/training-template', 'visible' => MgHelpers::checkAccess('training-template', 'index')],
    ['label' => T::t('Trainings'), 'visible' => MgHelpers::checkAccess('training', 'menu'), 'items' => [
            ['label' => 'Wszystkie szkolenia', 'url' => '/backend/oeiizk/training', 'visible' => MgHelpers::checkAccess('training', 'index')],
            ['label' => 'Szkolenia bieżące', 'url' => '/backend/oeiizk/training?dateType=2', 'visible' => MgHelpers::checkAccess('training', 'index')],
            ['label' => 'Szkolenia przyszłe', 'url' => '/backend/oeiizk/training?dateType=3', 'visible' => MgHelpers::checkAccess('training', 'index')],
            ['label' => 'Szkolenia archiwalne', 'url' => '/backend/oeiizk/training?dateType=1', 'visible' => MgHelpers::checkAccess('training', 'index')],
            ['label' => 'Lista uczestników', 'url' => '/backend/oeiizk/training-participant', 'visible' => MgHelpers::checkAccess('training-participant', 'index')],
            ['label' => 'Warsztaty - lista uczestników', 'url' => '/backend/oeiizk/workshop-user', 'visible' => MgHelpers::checkAccess('workshop-user', 'index')],
        ]],
    ['label' => T::t('Terminarz'), 'visible' => MgHelpers::checkAccess('calendar', 'menu'), 'items' => [
            ['label' => T::t('Events'), 'url' => '/backend/oeiizk/event', 'visible' => MgHelpers::checkAccess('event', 'index')],
            ['label' => T::t('Calendar'), 'url' => '/backend/oeiizk/training/calendar', 'visible' => MgHelpers::checkAccess('training', 'calendar')],
            ['label' => 'Raszyńska', 'url' => '/site/screen-display?institutionId=1', 'visible' => 1, 'linkOptions' => array(
                    'target' => '_blank'
                ),],
            ['label' => 'Nowogrodzka', 'url' => '/site/screen-display?institutionId=2', 'visible' => 1, 'linkOptions' => array(
                    'target' => '_blank'
                ),],
        ]],
    ['label' => T::t('Institutions'), 'url' => '/backend/oeiizk/institution', 'visible' => MgHelpers::checkAccess('institution', 'index')],
    ['label' => 'Różne', 'visible' => MgHelpers::checkAccess('various', 'menu'), 'items' => [
            ['label' => T::t('Newsletter'), 'url' => '/backend/oeiizk/newsletter', 'visible' => MgHelpers::checkAccess('newsletter', 'index')],
            ['label' => T::t('Polls'), 'url' => '/backend/oeiizk/poll', 'visible' => MgHelpers::checkAccess('poll', 'index')],
            ['label' => T::t('Poll Templates'), 'url' => '/backend/oeiizk/poll-template', 'visible' => MgHelpers::checkAccess('poll-template', 'index')],
            ['label' => T::t('Poll Questions'), 'url' => '/backend/oeiizk/poll-question', 'visible' => MgHelpers::checkAccess('poll-question', 'index')],
            ['label' => T::t('Agreements'), 'url' => '/backend/oeiizk/agreement', 'visible' => MgHelpers::checkAccess('agreement', 'index')],
        ]],
    ['label' => T::t('Settings'), 'visible' => MgHelpers::checkAccess('settings', 'menu'), 'items' => [
            ['label' => T::t('Settings'), 'url' => '/backend/mgcms/setting', 'visible' => MgHelpers::checkAccess('setting', 'index')],
            ['label' => T::t('Subjects'), 'url' => '/backend/oeiizk/subject', 'visible' => MgHelpers::checkAccess('subject', 'index')],
            ['label' => T::t('Training Directions'), 'url' => '/backend/oeiizk/training-direction', 'visible' => MgHelpers::checkAccess('training-direction', 'index')],
            ['label' => T::t('Articles'), 'url' => '/backend/mgcms/article', 'visible' => MgHelpers::checkAccess('article', 'index')],
        ]],
    ['label' => 'Statystyki', 'visible' => MgHelpers::checkAccess('statistics', 'menu'), 'items' => [
            ['label' => T::t('Logs'), 'url' => '/backend/mgcms/log', 'visible' => MgHelpers::checkAccess('log', 'index')],
            ['label' => T::t('Sql Queries'), 'url' => '/backend/mgcms/sql-query', 'visible' => MgHelpers::checkAccess('sql-query', 'index')],
            ['label' => T::t('Search Keywords'), 'url' => '/backend/oeiizk/search-keyword', 'visible' => MgHelpers::checkAccess('search-keyword', 'index')],
        ]],
    Yii::$app->user->isGuest ? (
    ['label' => 'Login', 'url' => ['/backend/default/login']]
    ) : (
    '<li>'
    . Html::beginForm(['/site/logout'], 'post')
    . Html::submitButton(
        'Logout (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link logout']
    )
    . Html::endForm()
    . '</li>'
    )
];
