<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\db\Event;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

class EventController extends \app\components\mgcms\MgCmsController
{

  public function behaviors()
  {
    return [
    ];
  }

  public function actionIndex($archive = false)
  {
    $query = Event::find()->andWhere(['promoted_pos' => 1]);
    if ($archive) {
      $query->orderBy(['date_from' => SORT_DESC]);
      $query->andWhere(['<', 'date_from', new \yii\db\Expression('now()')]);
    } else {
      $query->andWhere(['>', 'date_from', new \yii\db\Expression('now()')]);
      $query->orderBy(['date_from' => SORT_ASC]);
    }
    $dataProvider = new ActiveDataProvider([
        'query' => $query,
    ]);

    return $this->render('index', [
            'dataProvider' => $dataProvider,
    ]);
  }
}
