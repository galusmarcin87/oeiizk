<?php
namespace app\components\mgcms;

use yii\web\Controller;
use Yii;

/**
 * Default controller for the `backend` module
 */
class MgCmsController extends Controller
{

  public $language;
  public function beforeAction($action)
  {
    $this->language = Yii::$app->language;
    $this->_setContainerParams();
    if(Yii::$app->session['changePasswordUser']){
      if($action->actionMethod != 'actionChangePassword'){
        return $this->redirect(['/site/change-password', 'firstLogin' => true]);
      }
      
    }
    return parent::beforeAction($action);
  }

  /**
   * 
   * @return \app\models\mgcms\db\User
   */
  public function getUserModel()
  {
    return Yii::$app->user ? Yii::$app->user->identity : false;
  }

  private function _setContainerParams()
  {
    foreach (Yii::$app->params['containerComponents'] as $class => $config) {
      Yii::$container->set($class, $config);
    }
  }
  
  public function back()
  {
    return $this->redirect(Yii::$app->request->referrer);
  }

  public function throw404()
  {
    MgHelpers::throw404();
  }
  
  public function refreshUserModel(){
    if($this->getUserModel()){
      Yii::$app->user->identity = \app\models\mgcms\db\User::findOne($this->getUserModel()->id);
    }
  }
}
