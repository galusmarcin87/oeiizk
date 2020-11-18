<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\helpers\Json;
use app\models\db\Training;
use app\models\db\TrainingSearch;
use yii\helpers\Html;
use app\models\db\TrainingTemplate;
use app\components\mgcms\MgHelpers;
use app\components\mgcms\OeiizkHelpers;
use app\models\db\Event;


class ApiController extends \app\components\mgcms\MgCmsController
{

  public function actionTrainings($apiKey)
  {
    if ($apiKey != MgHelpers::getSetting('apiKey', false, 'KdhdyYJ*8dosK**(0Ndmkkgg')) {
      return $this->throw404();
    }
    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

    $searchModel = new TrainingSearch();
    $searchModel->notTypes = [TrainingTemplate::TYPE_KONFERENCJA, TrainingTemplate::TYPE_SIECI_WSPOLPRACY];

    $dataProvider = $searchModel->searchFront([]);
    $dataProvider->pagination->pageSize = 1000;

    $trainings = $dataProvider->getModels();

    $arr = [];
    foreach ($trainings as $model) {

      /* @var $model \app\models\db\Training */
      $item = $model->attributes;
      $template = $model->trainingTemplate;
      if (!$template) {
        continue;
      }
      $item['template'] = $template->attributes;
      $item['educationLevels'] = [];
      foreach ($template->educationalLevels as $educationalLevel) {
        $item['educationLevels'][] = $educationalLevel->attributes;
      }
      $item['link'] = $model->url;
      $item['image'] = $template->imageFile && $template->imageFile->isImage() ? $template->imageFile->getImageSrc(275, 130) : false;
      $arr[] = $item;
    }
    return $arr;
  }

  public function actionEvents($apiKey)
  {
    if ($apiKey != MgHelpers::getSetting('apiKey', false, 'KdhdyYJ*8dosK**(0Ndmkkgg')) {
      return $this->throw404();
    }
    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

    $events = Event::find()->andWhere(['promoted_oeiizk' => 1])->all();
    $arr = [];
    foreach ($events as $model) {

      /* @var $model \app\models\db\Training */
      $item = $model->attributes;

      $arr[] = $item;
    }
    return $arr;
  }
}
