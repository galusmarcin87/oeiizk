<div class="form-group" id="add-user-role">
  <?php
  use kartik\grid\GridView;
  use kartik\builder\TabularForm;
  use yii\data\ArrayDataProvider;
  use yii\helpers\Html;
  use yii\widgets\Pjax;
  use app\models\mgcms\db\User;

$dataProvider = new ArrayDataProvider([
      'allModels' => $row,
      'pagination' => [
          'pageSize' => -1
      ]
  ]);
  $rolesQuery = \app\models\db\Role::find()->orderBy('name');
  if (app\components\mgcms\OeiizkHelpers::isRole(User::ROLE_DOS)) {
    $rolesQuery->andWhere(['in', 'slug', [User::ROLE_LECTOR, User::ROLE_WORKER, User::ROLE_COACH]]);
  }


  echo TabularForm::widget([
      'dataProvider' => $dataProvider,
      'formName' => 'UserRole',
      'checkboxColumn' => false,
      'actionColumn' => false,
      'attributeDefaults' => [
          'type' => TabularForm::INPUT_TEXT,
      ],
      'attributes' => [
          "user_id" => ['type' => TabularForm::INPUT_HIDDEN_STATIC, 'columnOptions' => ['hidden' => true]],
          'role_id' => [
              'label' => 'Rola',
              'type' => TabularForm::INPUT_WIDGET,
              'widgetClass' => \kartik\widgets\Select2::className(),
              'options' => [
                  'data' => \yii\helpers\ArrayHelper::map($rolesQuery->asArray()->all(), 'id', 'name'),
                  'options' => ['placeholder' => Yii::t('app', 'Choose Role')],
              ],
              'columnOptions' => ['width' => '200px']
          ],
          'del' => [
              'type' => 'raw',
              'label' => '',
              'value' => function($model, $key) {
                return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' => Yii::t('app', 'Delete'), 'onClick' => 'delRowUserRole(' . $key . '); return false;', 'id' => 'user-role-del-btn']);
              },
          ],
      ],
      'gridSettings' => [
          'panel' => [
              'heading' => false,
              'type' => GridView::TYPE_DEFAULT,
              'before' => false,
              'footer' => false,
              'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'Add User Role'), ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowUserRole()']),
          ]
      ]
  ]);
  echo "    </div>\n\n";

  ?>

