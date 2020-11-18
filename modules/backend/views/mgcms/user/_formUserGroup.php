<div class="form-group" id="add-user-group">
  <?php
  use kartik\grid\GridView;
  use kartik\builder\TabularForm;
  use yii\data\ArrayDataProvider;
  use yii\helpers\Html;
  use yii\widgets\Pjax;

$dataProvider = new ArrayDataProvider([
      'allModels' => $row,
      'pagination' => [
          'pageSize' => -1
      ]
  ]);
  echo TabularForm::widget([
      'dataProvider' => $dataProvider,
      'formName' => 'UserGroup',
      'checkboxColumn' => false,
      'actionColumn' => false,
      'attributeDefaults' => [
          'type' => TabularForm::INPUT_TEXT,
      ],
      'attributes' => [
          "user_id" => ['type' => TabularForm::INPUT_HIDDEN_STATIC, 'columnOptions'=>['hidden'=>true]],
          'group_id' => [
              'label' => Yii::t('app', 'Group'),
              'type' => TabularForm::INPUT_WIDGET,
              'widgetClass' => \kartik\widgets\Select2::className(),
              'options' => [
                  'data' => \yii\helpers\ArrayHelper::map(\app\models\db\Group::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                  'options' => ['placeholder' => Yii::t('app', 'Choose Group')],
              ],
              'columnOptions' => ['width' => '200px']
          ],
          'del' => [
              'type' => 'raw',
              'label' => '',
              'value' => function($model, $key) {
                return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' => Yii::t('app', 'Delete'), 'onClick' => 'delRowUserGroup(' . $key . '); return false;', 'id' => 'user-group-del-btn']);
              },
          ],
      ],
      'gridSettings' => [
          'panel' => [
              'heading' => false,
              'type' => GridView::TYPE_DEFAULT,
              'before' => false,
              'footer' => false,
              'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'Add Group'), ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowUserGroup()']),
          ]
      ]
  ]);
  echo "    </div>\n\n";

  ?>

