<?php
namespace app\modules\backend\controllers\mgcms;

use Yii;
use app\models\mgcms\db\Message;
use app\models\mgcms\db\MessageSearch;
use \app\modules\backend\components\mgcms\MgBackendController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \app\components\mgcms\OeiizkHelpers;

/**
 * MessageController implements the CRUD actions for Message model.
 */
class MessageController extends MgBackendController
{

  public function behaviors()
  {
    return [
        'verbs' => [
            'class' => VerbFilter::className(),
            'actions' => [
                'delete' => ['post'],
            ],
        ],
    ];
  }

  /**
   * Lists all Message models.
   * @return mixed
   */
  public function actionIndex()
  {
    $searchModel = new MessageSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
    ]);
  }

  /**
   * Displays a single Message model.
   * @param integer $id
   * @return mixed
   */
  public function actionView($id)
  {
    $model = $this->findModel($id);
    $providerMessage = new \yii\data\ArrayDataProvider([
        'allModels' => $model->messages,
    ]);
    return $this->render('view', [
            'model' => $this->findModel($id),
            'providerMessage' => $providerMessage,
    ]);
  }

  /**
   * Creates a new Message model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
   */
  public function actionCreate($userId = false)
  {
    ini_set('max_execution_time', 3000);
    $model = new Message();
    $model->sender_id = $this->getUserModel()->id;
    if ($userId) {
      $model->recipient_id = [$userId];
    }

    if ($model->load(Yii::$app->request->post())) {
      foreach ($model->recipient_id as $recipientId) {
        $newModel = clone $model;
        $newModel->recipient_id = $recipientId;
        if ($newModel->save()) {
          $newModel->sendEmail();
        } else {
          \app\components\mgcms\MgHelpers::setFlashError('Błąd wysyłąnia wiadomości');
        }
      }
      \app\components\mgcms\MgHelpers::setFlashSuccess('Wiadomość wysłana');
      return $this->refresh();
    }



    return $this->render('create', [
            'model' => $model,
    ]);
  }

  /**
   * Creates a new Message model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
   */
  public function actionCreateForTraining($trainingId)
  {
    ini_set('max_execution_time', 3000);
    $model = new Message();
    $model->sender_id = $this->getUserModel()->id;



    $training = \app\models\db\Training::findOne(Yii::$app->request->getQueryParam('trainingId'));
    $userIds = [];
    foreach ($training->trainingParticipants as $participant) {
        if(in_array($participant->status, ['wykreślenie','rezygnacja przed zapisem','rezygnacja zamiast potwierdzenia','lista rezerwowa'])){
            continue;
        }
      $userIds[] = $participant->user_id;
    }
    foreach ($training->trainingLectors as $lector) {
      $userIds[] = $lector->user_id;
    }
    $model->recipient_id = $userIds;
    $this->view->params['userIds'] = $userIds;


    if ($model->load(Yii::$app->request->post())) {
      $genderTranslations = \app\components\mgcms\MgHelpers::getSettingOptionArray('tłumaczenie słów płci');
      foreach ($model->recipient_id as $recipientId) {
        $newModel = clone $model;
        $newModel->recipient_id = $recipientId;
        $user = \app\models\mgcms\db\User::findOne($recipientId);
        if ($model->template && $user) {
          foreach ($user->getAttributes() as $attr => $value) {
            if (strpos($attr, 'date') !== false) {
              $value = date('d.m.Y', strtotime($value));
            }
            $newModel->message = str_replace("{user.$attr}", $value, $newModel->message);
          }

          foreach ($training->getAttributes() as $attr => $value) {
            if (strpos($attr, 'date') !== false) {
              $value = date('d.m.Y', strtotime($value));
            }
            $newModel->subject = str_replace("{training.$attr}", $value, $newModel->subject);
            $newModel->message = str_replace("{training.$attr}", $value, $newModel->message);
          }

          $lab = $training->lab;
          if (!$lab && isset($training->lessons[0]) && $training->lessons[0]->lab) {
            $lab = $training->lessons[0]->lab;
          }
          if ($lab) {
            foreach ($lab->getAttributes() as $attr => $value) {
              $newModel->message = str_replace("{lab.$attr}", $value, $newModel->message);
            }
            $newModel->message = str_replace("{lab.shorterName}", $lab->shorterName, $newModel->message);

            if ($lab->institution) {
              foreach ($lab->institution->getAttributes() as $attr => $value) {
                $newModel->message = str_replace("{institution.$attr}", $value, $newModel->message);
              }
            }
          } else {
            $newModel->message = str_replace("{lab.shorterName}", '', $newModel->message);
          }

          if (isset($training->lessons[0])) {
            $lesson = $training->lessons[0];
            $newModel->message = str_replace("{lesson.start_hour}", date('H:i', strtotime($lesson->date_start)), $newModel->message);
            $newModel->message = str_replace("{lesson.end_hour}", date('H:i', strtotime($lesson->date_end)), $newModel->message);
            foreach ($lesson->getAttributes() as $attr => $value) {
              $newModel->message = str_replace("{lesson.$attr}", $value, $newModel->message);
            }
          }

          $newModel->message = str_replace("{training.day_of_week}",
              \Yii::$app->formatter->asDate(date('Y-m-d', strtotime($training->date_start)), 'EEEE'), $newModel->message);

          $newModel->message = OeiizkHelpers::genderTranslate($newModel->message, $user);
        }


        if ($newModel->save()) {
          $newModel->sendEmail();
        } else {
          \app\components\mgcms\MgHelpers::setFlashError('Błąd wysyłąnia wiadomości');
        }
      }
      \app\components\mgcms\MgHelpers::setFlashSuccess('Wiadomość wysłana');
      return $this->refresh();
    }


    return $this->render('createForTraining', [
            'model' => $model,
    ]);
  }

  /**
   * Creates a new Message model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
   */
  public function actionSendSms($trainingId = false)
  {
    ini_set('max_execution_time', 3000);
    $model = new Message();
    $model->sender_id = $this->getUserModel()->id;


    $userIds = [];
    if ($trainingId) {
      $training = \app\models\db\Training::findOne(Yii::$app->request->getQueryParam('trainingId'));

      foreach ($training->trainingParticipants as $participant) {
          if(in_array($participant->status, ['wykreślenie','rezygnacja przed zapisem','rezygnacja zamiast potwierdzenia','lista rezerwowa'])){
              continue;
          }
        $userIds[] = $participant->user_id;
      }
      foreach ($training->trainingLectors as $lector) {
        $userIds[] = $lector->user_id;
      }
      $this->view->params['userIds'] = $userIds;
    }
    $model->recipient_id = $userIds;


    if ($model->load(Yii::$app->request->post())) {
      $messages = [];
      foreach ($model->recipient_id as $recipientId) {
        $newModel = clone $model;
        $newModel->recipient_id = $recipientId;
        $user = \app\models\mgcms\db\User::findOne($recipientId);

        if ($model->template && $user) {
          foreach ($user->getAttributes() as $attr => $value) {
            $newModel->message = str_replace("{user.$attr}", $value, $newModel->message);
          }

          foreach ($training->getAttributes() as $attr => $value) {
            $newModel->message = str_replace("{training.$attr}", $value, $newModel->message);
          }
          $newModel->message = str_replace("{training.day_of_week}",
              \Yii::$app->formatter->asDate(date('Y-m-d', strtotime($training->date_start)), 'EEEE'), $newModel->message);
          
          $lab = $training->lab;
          if (!$lab && isset($training->lessons[0]) && $training->lessons[0]->lab) {
            $lab = $training->lessons[0]->lab;
          }
          if ($lab) {
            foreach ($lab->getAttributes() as $attr => $value) {
              $newModel->message = str_replace("{lab.$attr}", $value, $newModel->message);
            }
            $newModel->message = str_replace("{lab.shorterName}", $lab->shorterName, $newModel->message);

            if ($lab->institution) {
              foreach ($lab->institution->getAttributes() as $attr => $value) {
                $newModel->message = str_replace("{institution.$attr}", $value, $newModel->message);
              }
            }
          } else {
            $newModel->message = str_replace("{lab.shorterName}", '', $newModel->message);
          }
          
          if (isset($training->lessons[0])) {
            $lesson = $training->lessons[0];
            $newModel->message = str_replace("{lesson.start_hour}", date('H:i', strtotime($lesson->date_start)), $newModel->message);
            $newModel->message = str_replace("{lesson.end_hour}", date('H:i', strtotime($lesson->date_end)), $newModel->message);
            foreach ($lesson->getAttributes() as $attr => $value) {
              $newModel->message = str_replace("{lesson.$attr}", $value, $newModel->message);
            }
          }
        }
        if ($user && $user->phone) {
          $messages[] = ['Number' => OeiizkHelpers::normalizePhoneNumber($user->phone), 'Message' => $newModel->message];
        }
      }
      $res = OeiizkHelpers::sendSmsCampaign($messages);
      \app\components\mgcms\MgHelpers::setFlashSuccess('Wiadomość wysłana');
      return $this->refresh();
    }


    return $this->render('sendSms', [
            'model' => $model,
    ]);
  }

  /**
   * Creates a new Message model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
   */
  public function actionAnswer($hash)
  {
    $model = new Message();
    $model->sender_id = $this->getUserModel()->id;
    $messageId = \app\components\mgcms\MgHelpers::decrypt($hash);
    if (!$messageId) {
      \app\components\mgcms\MgHelpers::throw404();
    }
    $previousMessage = Message::findOne(['id' => $messageId]);

    if (!$previousMessage) {
      \app\components\mgcms\MgHelpers::throw404();
    }
    $model->message_id = $messageId;
    $model->recipient_id = $previousMessage->sender_id;
    $model->subject = 'Re: ' . $previousMessage->subject;

    if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
      if ($model->sendEmail()) {
        return $this->redirect(['view', 'id' => $model->id]);
      } else {
        $this->back();
      }
      return $this->redirect(['view', 'id' => $model->id]);
    } else {
      $previousMessage->is_read = 1;
      $previousMessage->save();
      return $this->render('answer', [
              'model' => $model,
      ]);
    }
  }

  /**
   * Updates an existing Message model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id
   * @return mixed
   */
  public function actionUpdate($id)
  {
    $model = $this->findModel($id);

    if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
      return $this->redirect(['view', 'id' => $model->id]);
    } else {
      return $this->render('update', [
              'model' => $model,
      ]);
    }
  }

  /**
   * Deletes an existing Message model.
   * If deletion is successful, the browser will be redirected to the 'index' page.
   * @param integer $id
   * @return mixed
   */
  public function actionDelete($id)
  {
    $this->findModel($id)->deleteWithRelated();

    return $this->redirect(['index']);
  }

  /**
   * Finds the Message model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return Message the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = Message::findOne($id)) !== null) {
      return $model;
    } else {
      throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
  }

  /**
   * Action to load a tabular form grid
   * for Message
   * @author Yohanes Candrajaya <moo.tensai@gmail.com>
   * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
   *
   * @return mixed
   */
  public function actionAddMessage()
  {
    if (Yii::$app->request->isAjax) {
      $row = Yii::$app->request->post('Message');
      if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
        $row[] = [];
      return $this->renderAjax('_formMessage', ['row' => $row]);
    } else {
      throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
  }
}
