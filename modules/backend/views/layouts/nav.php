<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use app\components\mgcms\T;
use \app\components\mgcms\MgHelpers;
$useCache = true;
//$useCache = false;

if (Yii::$app->user->isGuest) {
  $items = [
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
} else {
  
  $itemsCached =  $useCache ? Yii::$app->cache->get('backend_nav_items_' . MgHelpers::getUserModel()->id. app\components\mgcms\OeiizkHelpers::getCurrentBackendRole()) : false;
  if ($itemsCached) {
    $items = $itemsCached;
  } else {
    if (!MgHelpers::isAdmin()) {
      $items = require __DIR__ . '/navDos.php';
      if($useCache){
        Yii::$app->cache->set('backend_nav_items_' . MgHelpers::getUserModel()->id. app\components\mgcms\OeiizkHelpers::getCurrentBackendRole(), $items);
      }
    } else {
      $items = [
          ['label' => T::t('Trainings'), 'visible' => MgHelpers::checkAccess('training', 'menu'), 'items' => [
                  ['label' => T::t('Training Templates'), 'url' => '/backend/oeiizk/training-template', 'visible' => MgHelpers::checkAccess('training-template', 'index')],
                  ['label' => 'Wszystkie szkolenia', 'url' => '/backend/oeiizk/training', 'visible' => MgHelpers::checkAccess('training', 'index')],
                  ['label' => 'Szkolenia bieżące', 'url' => '/backend/oeiizk/training?dateType=2', 'visible' => MgHelpers::checkAccess('training', 'index')],
                  ['label' => 'Szkolenia przyszłe', 'url' => '/backend/oeiizk/training?dateType=3', 'visible' => MgHelpers::checkAccess('training', 'index')],
                  ['label' => 'Szkolenia archiwalne', 'url' => '/backend/oeiizk/training?dateType=1', 'visible' => MgHelpers::checkAccess('training', 'index')],
                  ['label' => 'Szkolenia - lista uczestników', 'url' => '/backend/oeiizk/training-participant', 'visible' => MgHelpers::checkAccess('training-participant', 'index')],
                  ['label' => 'Warsztaty - lista uczestników', 'url' => '/backend/oeiizk/workshop-user', 'visible' => MgHelpers::checkAccess('workshop-user', 'index')],
                  ['label' => T::t('Lessons'), 'url' => '/backend/oeiizk/lesson', 'visible' => MgHelpers::checkAccess('lesson', 'index')],
                  ['label' => T::t('Training Modules'), 'url' => '/backend/oeiizk/training-module', 'visible' => MgHelpers::checkAccess('training-module', 'index')],
                  ['label' => T::t('Training Directions'), 'url' => '/backend/oeiizk/training-direction', 'visible' => MgHelpers::checkAccess('training-direction', 'index')],
                  ['label' => T::t('Calendar'), 'url' => '/backend/oeiizk/training/calendar', 'visible' => MgHelpers::checkAccess('training', 'calendar')],
              ]],
          ['label' => T::t('Polls'), 'visible' => MgHelpers::checkAccess('poll', 'menu'), 'items' => [
                  ['label' => T::t('Polls'), 'url' => '/backend/oeiizk/poll', 'visible' => MgHelpers::checkAccess('poll', 'index')],
                  ['label' => T::t('Poll Templates'), 'url' => '/backend/oeiizk/poll-template', 'visible' => MgHelpers::checkAccess('poll-template', 'index')],
                  ['label' => T::t('Poll Questions'), 'url' => '/backend/oeiizk/poll-question', 'visible' => MgHelpers::checkAccess('poll-question', 'index')],
              ]],
          ['label' => T::t('Dictionaries'), 'visible' => MgHelpers::checkAccess('dictionary', 'menu'), 'items' => [
                  ['label' => T::t('Subjects'), 'url' => '/backend/oeiizk/subject', 'visible' => MgHelpers::checkAccess('subject', 'index')],
                  ['label' => T::t('Institutions'), 'url' => '/backend/oeiizk/institution', 'visible' => MgHelpers::checkAccess('institution', 'index')],
                  ['label' => T::t('Agreements'), 'url' => '/backend/oeiizk/agreement', 'visible' => MgHelpers::checkAccess('agreement', 'index')],
                  ['label' => T::t('Groups'), 'url' => '/backend/oeiizk/group', 'visible' => MgHelpers::checkAccess('group', 'index')],
                  ['label' => T::t('Educational Levels'), 'url' => '/backend/oeiizk/educational-level', 'visible' => MgHelpers::checkAccess('educational-level', 'index')],
              ]],
          ['label' => T::t('Newsletter'), 'url' => '/backend/oeiizk/newsletter', 'visible' => MgHelpers::checkAccess('newsletter', 'index')],
          ['label' => T::t('Events'), 'url' => '/backend/oeiizk/event', 'visible' => MgHelpers::checkAccess('event', 'index')],
          ['label' => T::t('Messages'), 'url' => '/backend/mgcms/message', 'visible' => MgHelpers::checkAccess('message', 'index')],
          ['label' => T::t('CMS'), 'visible' => MgHelpers::checkAccess('menu', 'CMS'), 'items' => [
                  ['label' => T::t('Articles'), 'url' => '/backend/mgcms/article', 'visible' => MgHelpers::checkAccess('article', 'index')],
                  ['label' => T::t('Categories'), 'url' => '/backend/mgcms/category', 'visible' => MgHelpers::checkAccess('category', 'index')],
                  ['label' => T::t('Tags'), 'url' => '/backend/mgcms/tag', 'visible' => MgHelpers::checkAccess('tag', 'index')],
                  ['label' => T::t('Files'), 'url' => '/backend/mgcms/file', 'visible' => MgHelpers::checkAccess('file', 'index')],
              ]],
//        ['label' => T::t('Galleries'), 'url' => '/backend/mgcms/gallery', 'visible' => MgHelpers::checkAccess('gallery', 'index')],
          ['label' => T::t('Users'), 'url' => '/backend/mgcms/user', 'visible' => MgHelpers::checkAccess('user', 'index')],
          ['label' => T::t('Settings'), 'visible' => MgHelpers::checkAccess('setting', 'menu'), 'items' => [
                  ['label' => T::t('Settings'), 'url' => '/backend/mgcms/setting', 'visible' => MgHelpers::checkAccess('setting', 'index')],
//                ['label' => T::t('Translations'), 'url' => '/backend/mgcms/translate', 'visible' => MgHelpers::checkAccess('translate', 'index')],
                  ['label' => T::t('Auths'), 'url' => '/backend/mgcms/auth/manage', 'visible' => MgHelpers::checkAccess('auth', 'manage')],
                  ['label' => T::t('Logs'), 'url' => '/backend/mgcms/log', 'visible' => MgHelpers::checkAccess('log', 'index')],
                  ['label' => T::t('Sql Queries'), 'url' => '/backend/mgcms/sql-query', 'visible' => MgHelpers::checkAccess('sql-query', 'index')],
                  ['label' => T::t('Menu'), 'url' => '/backend/mgcms/menu', 'visible' => MgHelpers::checkAccess('menu', 'index')],
                  ['label' => T::t('Roles'), 'url' => '/backend/oeiizk/role', 'visible' => MgHelpers::checkAccess('role', 'index')],
                  ['label' => T::t('Search Keywords'), 'url' => '/backend/oeiizk/search-keyword', 'visible' => MgHelpers::checkAccess('search-keyword', 'index')],
                  ['label' => T::t('Sms Template'), 'url' => '/backend/oeiizk/sms-template', 'visible' => MgHelpers::checkAccess('sms-template', 'index')],
                  ['label' => T::t('Archiwizuj dane'), 'url' => '/backend/mgcms/setting/archive', 'visible' => MgHelpers::checkAccess('setting', 'archive')],
              ]],
//        \app\components\mgcms\languageSwitcher::getMenuItems(),
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
      if($useCache){
        Yii::$app->cache->set('backend_nav_items_' . MgHelpers::getUserModel()->id. app\components\mgcms\OeiizkHelpers::getCurrentBackendRole(), $items);
      }
    }
  }
}

NavBar::begin([
    'brandLabel' => 'MG CMS',
    'brandUrl' => '/admin',
    'innerContainerOptions' => ['class' => 'container'],
    'options' => [
        'class' => 'navbar-default  navbar-fixed-top',
    ],
]);

echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => $items,
]);
NavBar::end();
