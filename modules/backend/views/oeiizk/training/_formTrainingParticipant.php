<div class="form-group" id="add-training-participant">
  <?php
  use kartik\grid\GridView;
  use kartik\builder\TabularForm;
  use yii\data\ArrayDataProvider;
  use yii\helpers\Html;
  use yii\widgets\Pjax;
  use app\components\mgcms\OeiizkHelpers;
  use app\models\mgcms\db\User;
  use \app\models\db\Training;

$model = new app\models\db\TrainingParticipant;

  $dataProvider = new ArrayDataProvider([
      'allModels' => $row,
      'pagination' => [
          'pageSize' => -1
      ]
  ]);
  echo TabularForm::widget([
      'dataProvider' => $dataProvider,
      'formName' => 'TrainingParticipant',
      'checkboxColumn' => false,
      'actionColumn' => false,
      'attributeDefaults' => [
          'type' => TabularForm::INPUT_TEXT,
      ],
      'attributes' => [
          "training_id" => ['type' => TabularForm::INPUT_HIDDEN_STATIC, 'columnOptions' => ['hidden' => true]],
          'order' => [
              'type' => TabularForm::INPUT_TEXT,
              'label' => $model->getAttributeLabel('order'),
              'columnOptions' => ['width' => '65px'],
              'options' => ['disabled' => OeiizkHelpers::isRole(User::ROLE_LECTOR)]
          ],
          'user_id' => ['type' => TabularForm::INPUT_HIDDEN_STATIC, 'columnOptions' => ['hidden' => true]],
          'userFirstName' => [
              'type' => 'raw',
              'label' => 'Nazwisko',
              'value' => function($model, $key) {
                if (isset($model) && isset($model['user_id'])) {
                  $user = \app\models\mgcms\db\User::findOne($model['user_id']);
                  if ($user) {
                    return $user->last_name;
                  }
                }
                return '<span id="userFirstName_' . $key . '"></span>';
              },
          ],
          'userLastName' => [
              'type' => 'raw',
              'label' => 'Imię',
              'value' => function($model, $key) {
                if (isset($model) && isset($model['user_id'])) {
                  $user = \app\models\mgcms\db\User::findOne($model['user_id']);
                  if ($user) {
                    return $user->first_name;
                  }
                }
                return '<span id="userLastName_' . $key . '"></span>';
              },
          ],
          'userEmail' => [
              'type' => 'raw',
              'label' => 'Email',
              'value' => function($model, $key) {
                if (isset($model) && isset($model['user_id'])) {
                  $user = \app\models\mgcms\db\User::findOne($model['user_id']);
                  if ($user) {
                    return $user->email;
                  }
                }
                return '<span id="userEmail_' . $key . '"></span>';
              },
          ],
          'surname' => [
              'type' => TabularForm::INPUT_TEXT,
              'label' => $model->getAttributeLabel('surname'),
              'options' => ['disabled' => OeiizkHelpers::isRole(User::ROLE_LECTOR)]
          ],
          'workplace' => [
              'type' => TabularForm::INPUT_TEXT,
              'label' => $model->getAttributeLabel('workplace'),
              'options' => ['disabled' => OeiizkHelpers::isRole(User::ROLE_LECTOR)]
          ],
          'status' => [
              'type' => TabularForm::INPUT_DROPDOWN_LIST,
              'label' => $model->getAttributeLabel('status'),
              'items' => app\components\mgcms\MgHelpers::getSettingOptionArray('uczestnik - status'),
              'options' => [
                  'disabled' => OeiizkHelpers::isRole(User::ROLE_LECTOR),
              ]
          ],
          'creadibility' => [
              'type' => 'raw',
              'label' => 'Wiarygodność',
              'options' => [
                  'disabled' => true,
              ],
              'value' => function($model, $key) {
                if (isset($model) && isset($model['user_id'])) {
                  $user = \app\models\mgcms\db\User::findOne($model['user_id']);
                  if ($user) {
                    return $user->credibilityCalc;
                  }
                }
                return false;
              },
          ],
//          'workplace' => ['type' => TabularForm::INPUT_TEXT, $model->getAttributeLabel('order')],
          'is_reserve' => \app\components\mgcms\MgHelpers::backendGetSwitchColumnSettings($model->getAttributeLabel('is_reserve')),
          'userWorkplace' => [
              'type' => 'raw',
              'label' => 'Miejsce pracy',
              'value' => function($model, $key) {
                if (isset($model) && isset($model['user_id'])) {
                  $user = \app\models\mgcms\db\User::findOne($model['user_id']);
                  if ($user && isset($user->workplaces[0]) && isset($user->workplaces[0]->institution)) {
                    return $user->workplaces[0]->institution->code;
                  }
                }
                return '<span id="userFirstName_' . $key . '"></span>';
              },
          ],
          'paid_missing' => [
              'type' => TabularForm::INPUT_TEXT,
              'label' => $model->getAttributeLabel('paid_missing'),
              'options' => ['disabled' => OeiizkHelpers::isRole(User::ROLE_LECTOR)]
          ],
          'selectUser' => [
              'label' => '',
              'type' => 'raw',
              'value' => function($model, $key) {
                return $model ? '' : Html::a('Wybierz uczestnika', '#', ['title' => Yii::t('app', 'Delete'), 'onClick' => 'showUserModal(' . $key . '); return false;', 'id' => 'workplace-addInstitution-btn', 'class' => 'btn btn-primary']);
              },
          ],
          'edit' => [
              'type' => 'raw',
              'label' => '',
              'value' => function($model, $key) {
                if (!$model) {
                  return false;
                }

                if (OeiizkHelpers::isRole(User::ROLE_LECTOR)) {
                  $user = User::findOne($model['user_id']);
                  $training = Training::findOne($model['training_id']);
                  if (!$user || !$training) {
                    return false;
                  }
                  if ($user->role == User::ROLE_ADMIN || $user->hasRole(User::ROLE_DOS)) {
                    return false;
                  }
                  if ($training->status != Training::STATUS_LAUNCHED) {
                    return false;
                  }
                }
                return Html::a('<i class="glyphicon glyphicon-edit"></i>',
                        ['mgcms/user/update-special', 'hash' => app\components\mgcms\MgHelpers::encrypt($model['user_id'])], ['target' => '_blank']);
              },
          ],
          'del' => [
              'type' => 'raw',
              'label' => '',
              'visible' => !OeiizkHelpers::isRole(User::ROLE_LECTOR),
              'value' => function($model, $key) {
                return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' => Yii::t('app', 'Delete'), 'onClick' => 'delRowTrainingParticipant(' . $key . '); return false;', 'id' => 'training-participant-del-btn']);
              },
          ],
      ],
      'gridSettings' => [
          'panel' => [
              'heading' => false,
              'type' => GridView::TYPE_DEFAULT,
              'before' => false,
              'footer' => false,
              'after' => !OeiizkHelpers::isRole(User::ROLE_LECTOR) ?
                  Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'Add Participant'), ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowTrainingParticipant()']) :
                  ''
          ,
          ]
      ]
  ]);
  echo "    </div>\n\n";

  ?>

