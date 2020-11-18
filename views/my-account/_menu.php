<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use app\components\mgcms\MgHelpers;
use yii\helpers\Url;

?>

<div class="border border-light usermenu">
  <h3 class="">
    <a href="<?=Url::to('/my-account')?>">Moje dane</a></h3>
  <ul class="nav flex-column">
    <li class="<?if(Yii::$app->request->url == Url::to('/my-account')):?>active<?endif?> nav-item">
      <a href="<?=Url::to('/my-account')?>" class="nav-link">
        Podstawowe dane
      </a>
    </li>
    <li class="nav-item <?if(Yii::$app->request->url == Url::to('/my-account/workplace')):?>active<?endif?>">
      <a href="<?=Url::to('/my-account/workplace')?>" class="nav-link">
        Zatrudnienie
      </a>
    </li>
    <li class="nav-item <?if(Yii::$app->request->url == Url::to('/my-account/change-password')):?>active<?endif?>">
      <a href="<?=Url::to('/my-account/change-password')?>" class="nav-link">
        Zmiana hasła
      </a>
    </li>
    <li class="nav-item <?if(Yii::$app->request->url == Url::to('/my-account/additional-data')):?>active<?endif?>">
      <a href="<?=Url::to('/my-account/additional-data')?>" class="nav-link">
        Dodatkowe dane
      </a>
    </li>
    <li class="nav-item <?if(Yii::$app->request->url == Url::to('/my-account/trainings')):?>active<?endif?>">
      <a href="<?=Url::to('/my-account/trainings')?>" class="nav-link">
        Szkolenia
      </a>
    </li>
    <li class="nav-item <?if(Yii::$app->request->url == Url::to('/my-account/preferences')):?>active<?endif?>">
      <a href="<?=Url::to('/my-account/preferences')?>" class="nav-link">
        Preferencje szkoleniowe
      </a>
    </li>
  </ul>



  <h3 class="border-light border-top">Wiadomości od DOS</h3>
  <ul class="nav flex-column">
    <li class="nav-item <?if(Yii::$app->request->url == Url::to('/my-account/message-recieved')):?>active<?endif?>">
      <a href="<?=Url::to('/my-account/message-recieved')?>" class="nav-link">
        Odebrane
      </a>
    </li>
  </ul>
</div>
