<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use \app\models\mgcms\db\Article;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use \app\models\mgcms\db\Tag;

class NewsletterController extends \app\components\mgcms\MgCmsController
{

  public function behaviors()
  {
    return [
    ];
  }


  /**
   * Displays homepage.
   *
   * @return string
   */
  public function actionView($id)
  {
    $model = \app\models\db\Newsletter::findOne($id);
    if (!$model) {
      throw new \yii\web\HttpException(404, Yii::t('app', 'Not found'));
    }

    return $this->render('view', ['model' => $model]);
  }
}
