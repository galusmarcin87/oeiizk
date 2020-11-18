<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\db\Training;
use app\models\db\TrainingTemplate;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use app\models\db\TrainingSearch;
use app\components\mgcms\MgHelpers;
use \app\models\db\TrainingParticipant;
use \app\models\db\WorkshopUser;
use \app\components\mgcms\OeiizkHelpers;

class TrainingController extends \app\components\mgcms\MgCmsController
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
  public function actionView($code, $password = false)
  {
    $model = \app\models\db\Training::findOne(['code' => $code]);
    if (!$model) {
      $this->throw404();
    }
    $model->password = $password;
    if (!$model->checkFrontAccess()) {
      $this->throw404();
    }
    if (!$model) {
      throw new \yii\web\HttpException(404, Yii::t('app', 'Not found'));
    }
    return $this->render('view', ['model' => $model]);
  }

  private function signInWorkshops(Training $training, \app\models\mgcms\db\User $user, $post)
  {
    if (isset($post['workshop'])) {
      if (!$user->isTrainingParticipant($training)) {
        MgHelpers::setFlashError('Musisz być najpierw zapisany na ' . ($training->isConference() ? 'konferencję' : 'szkolenie') . ' aby zapisać się na warsztaty.');
        return false;
      }
      $allTrainingWorkshopsIds = [];
      foreach ($training->workshops as $workshop) {
        $allTrainingWorkshopsIds[] = $workshop->id;
      }
      WorkshopUser::deleteAll(['AND', ['user_id' => $user->id], ['in', 'workshop_id', $allTrainingWorkshopsIds]]);
      foreach ($post['workshop'] as $workshopId) {
        if (WorkshopUser::find()->where(['user_id' => $user->id, 'workshop_id' => $workshopId])->count() == 0) {
          $userWorkshop = new WorkshopUser;
          $userWorkshop->user_id = $user->id;
          $userWorkshop->workshop_id = $workshopId;
          $userWorkshop->save();
        } else {
          MgHelpers::setFlashInfo('Jesteś już zapisany na ten warsztat.');
        }
      }
      MgHelpers::setFlashSuccess('Zapisano pomyślnie na warsztaty.');
    }
  }

  public function actionCooperationNet()
  {
    $searchModel = new TrainingSearch();
    $searchModel->types = [TrainingTemplate::TYPE_SIECI_WSPOLPRACY];
    $searchModel->isDuringTime = true;
    $searchModel->isCooperationNet = true;
    $dataProvider = $searchModel->searchFront(Yii::$app->request->queryParams);
    return $this->render('cooperationNet', [
            'dataProvider' => $dataProvider
    ]);
  }

  public function actionConferences($archive = false)
  {
    $searchModel = new TrainingSearch();
    $searchModel->types = [TrainingTemplate::TYPE_KONFERENCJA];
    $searchModel->schoolYear = (int) substr(OeiizkHelpers::getCurrentSchoolYearStart(), 0, 4);
    $searchModel->isArchive = $archive;
    $dataProvider = $searchModel->searchFront(Yii::$app->request->queryParams);
    return $this->render('conferences', [
            'dataProvider' => $dataProvider
    ]);
  }

  public function actionSignIn($hash)
  {
    $model = Training::findOne(MgHelpers::decrypt($hash));
    if (!$model || !$model->isRegisteringAvailable()) {
      $this->throw404();
    }
    
    if(sizeof($model->trainingParticipants) >= $model->final_maximal_participants_number ){
        MgHelpers::setFlashError('Przekroczona maksymalna liczba uczestników.');
        return $this->back();
    }

    if ($this->getUserModel()) {
      $user = $this->getUserModel();
      if (sizeof($user->workplaces) == 0) {
        MgHelpers::setFlashError('Brak miejsca zatrudnienia - dodaj, aby móc się zapisać na szkolenie.');
        return $this->redirect(['/my-account/workplace']);
      }

      if (!$model->checkIfUserPassedRequiredTrainings($user)) {
        MgHelpers::setFlashError('Aby zapisać się na to szkolenie, trzeba ukończyć inne.');
        return $this->back();
      }

      if (TrainingParticipant::findOne(['user_id' => $user->id, 'training_id' => $model->id])) {
        if(sizeof($model->workshops) > 0){
          $this->signInWorkshops($model, $user, Yii::$app->request->post());
        }else{
          MgHelpers::setFlashInfo('Jesteś już zapisany na to szkolenie.');
        }
        
        return $this->back();
      }

      if (!$model->checkIfUserDontHaveWorkshopsInTime($user)) {
        MgHelpers::setFlashError('Warsztaty pokrywają się z warsztatami, na które jesteś zapisany.');
        return $this->back();
      }

      $trainingParticipant = new TrainingParticipant;
      $trainingParticipant->user_id = $user->id;
      $trainingParticipant->training_id = $model->id;
      $trainingParticipant->status = sizeof($model->trainingParticipants) >= $model->maximal_participants_number ? 'lista rezerwowa' : 'zgłoszenie samodzielne';
      $saved = $trainingParticipant->save();
      if ($saved) {
        $msg = 'Zapisano pomyślnie na ' . ($model->isConference() ? 'konferencję' : 'szkolenie') . (sizeof($model->trainingParticipants) >= $model->maximal_participants_number ? ' na listę rezerwową.' : '.');
        $this->signInWorkshops($model, $user, Yii::$app->request->post());
        MgHelpers::setFlashSuccess($msg);
        return $this->back();
      }
    } else {
      if ($model->is_login_required) {
        Yii::$app->session['trainingToRegister'] = $model->id;
        MgHelpers::setFlashInfo('Szkolenie wymaga logowania.');
        return $this->redirect('/site/login');
      } else {
        $modelRegister = new \app\models\RegisterParticipant();
        $modelRegister->trainingId = $model->id;
        $post = Yii::$app->request->post();
        if(isset($post['workshop'])){
          Yii::$app->session['workshopPostData'] = $post;
        }
        if ($modelRegister->load(Yii::$app->request->post()) && $modelRegister->register($model)) {
          $this->signInWorkshops($model, $modelRegister->user, Yii::$app->session['workshopPostData']);
          unset(Yii::$app->session['workshopPostData']);
          $msg = 'Zapisano pomyślnie na ' . ($model->isConference() ? 'konferencję' : 'szkolenie') . ($modelRegister->isReserveList ? ' na listę rezerwową.' : '.');
          MgHelpers::setFlashSuccess($msg);
          return $this->redirect('/');
        }

        return $this->render('registerParticipant', ['modelRegister' => $modelRegister]);
      }
    }
  }

  public function actionResign($hash)
  {
    $ids = explode(':', MgHelpers::decrypt($hash));

    if (sizeof($ids) != 2) {
      $this->throw404();
    }

    $training = Training::findOne($ids[0]);
    if (!$training) {
      $this->throw404();
    }

    TrainingParticipant::deleteAll(['training_id' => $ids[0], 'user_id' => $ids[1]]);

    MgHelpers::setFlashSuccess('Rezygnacja ' . ($training->isConference() ? 'z konferencji' : 'ze szkolenia') . ' przebiegła pomyślnie.');
    $this->redirect('/');
  }

  public function actionConfirm($hash)
  {
    $part = TrainingParticipant::findOne(['id' => MgHelpers::decrypt($hash)]);

    if ($part) {
      $part->status = 'potwierdzenie samodzielne';
      $saved = $part->save();
      MgHelpers::setFlashSuccess('Potwierdzono obecność na szkoleniu.');
    }
    $this->back();
  }

  public function actionSaveParticipant($hash)
  {
    $ids = explode(':', MgHelpers::decrypt($hash));

    if (sizeof($ids) != 2) {
      $this->throw404();
    }

    $user = \app\models\mgcms\db\User::findOne(['email' => $ids[1]]);
    $training = Training::findOne($ids[0]);
    if (!$training || !$user) {
      $this->throw404();
    }
    if (TrainingParticipant::find()->andWhere(['user_id' => $user->id, 'training_id' => $training->id])->count()) {
      MgHelpers::setFlashInfo('Już jesteś zapisany na to szkolenie.');
      return $this->redirect('/');
    }
    $trainingParticipant = new TrainingParticipant;
    $trainingParticipant->user_id = $user->id;
    $trainingParticipant->training_id = $training->id;
    $trainingParticipant->status = sizeof($training->trainingParticipants) >= $training->maximal_participants_number ? 'lista rezerwowa' : 'przed zajęciami';
    $saved = $trainingParticipant->save();
    if ($saved) {
      $msg = 'Zapisano pomślnie na ' . ($training->isConference() ? 'konferencję' : 'szkolenie') . (sizeof($training->trainingParticipants) >= $training->maximal_participants_number ? ' na listę rezerwową.' : '.');
      if ($training->isConference()) {
        $msg .= ' Teraz wybierz warsztaty na które chcesz się zapisać.';
      }
      MgHelpers::setFlashSuccess($msg);
    }
    return $this->redirect('/');
  }
}
