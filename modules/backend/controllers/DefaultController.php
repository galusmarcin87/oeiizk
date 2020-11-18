<?php
namespace app\modules\backend\controllers;

use app\modules\backend\components\mgcms\MgBackendController;
use Yii;
use app\models\LoginForm;

/**
 * Default controller for the `backend` module
 */
class DefaultController extends MgBackendController
{

  /**
   * Renders the index view for the module
   * @return string
   */
  public function actionIndex()
  {
//    echo '<pre>';
//    var_dump(Yii::$app->session['role']);
//    echo '</pre>';
//    exit;

    return $this->render('index');
  }

  public function actionChooseRole()
  {
    if (Yii::$app->request->post()) {
      $post = Yii::$app->request->post();
      if ($post['role']) {
        Yii::$app->session['role'] = $post['role'];
        return $this->redirect('/admin');
      }
    }
    return $this->render('chooseRole', ['roles' => $this->getUserModel()->roles]);
  }

  public function actionLogin()
  {
    if (!Yii::$app->user->isGuest) {
      return $this->goHome();
    }

    $model = new LoginForm();
    $model->rememberMe = false;
    if ($model->load(Yii::$app->request->post()) && $model->login()) {
      if ($this->getUserModel()->role != \app\models\mgcms\db\User::ROLE_ADMIN) {
        if (sizeof($this->getUserModel()->roles) > 1) {
          return $this->redirect(['choose-role']);
        } elseif (sizeof($this->getUserModel()->roles) == 0) {
          \app\components\mgcms\MgHelpers::setFlashInfo('Użytkownik nie ma przypsianej żadnej roli');
        } else {

          Yii::$app->session['role'] = $this->getUserModel()->roles[0]->slug;
        }
      }

      return $this->goBack();
    }
    return $this->render('login', [
            'model' => $model,
    ]);
  }
}
