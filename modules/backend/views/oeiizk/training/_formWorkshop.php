<div class="form-group" id="add-workshop">
  <?php
  use kartik\grid\GridView;
  use kartik\builder\TabularForm;
  use yii\data\ArrayDataProvider;
  use yii\helpers\Html;
  use yii\widgets\Pjax;

$model = new \app\models\db\Workshop;

  $dataProvider = new ArrayDataProvider([
      'allModels' => $row,
      'pagination' => [
          'pageSize' => -1
      ]
  ]);
  echo TabularForm::widget([
      'dataProvider' => $dataProvider,
      'formName' => 'Workshop',
      'checkboxColumn' => false,
      'actionColumn' => false,
      'attributeDefaults' => [
          'type' => TabularForm::INPUT_TEXT,
      ],
      'attributes' => [
          "id" => ['type' => TabularForm::INPUT_HIDDEN_STATIC, 'columnOptions'=>['hidden'=>true]],
          'order' => ['type' => TabularForm::INPUT_TEXT, 'label' => $model->getAttributeLabel('order')],
          'date_start' => [
              'type' => TabularForm::INPUT_WIDGET,
              'label' => $model->getAttributeLabel('date_start'),
              'widgetClass' => \kartik\widgets\DateTimePicker::className(),
              'options' => [
                  'pluginOptions' => [
                      'format' => 'yyyy-mm-dd hh:ii:ss',
                      'autoclose' => true
                  ],]
          ],
          'date_end' => [
              'type' => TabularForm::INPUT_WIDGET,
              'label' => $model->getAttributeLabel('date_end'),
              'widgetClass' => \kartik\widgets\DateTimePicker::classname(),
              'options' => [
                  'pluginOptions' => [
                      'format' => 'yyyy-mm-dd hh:ii:ss',
                      'autoclose' => true
                  ],]
          ],
          
          'lab_id' => [
              'label' => $model->getAttributeLabel('lab'),
              'type' => TabularForm::INPUT_WIDGET,
              'widgetClass' => \kartik\widgets\Select2::className(),
              'options' => [
                  'data' => \yii\helpers\ArrayHelper::map(\app\models\db\Lab::find()->orderBy('name')->all(), 'id', 'shorterName'),
                  'options' => ['placeholder' => Yii::t('app', 'Choose Lab')],
              ],
              'columnOptions' => ['width' => '200px']
          ],
          'title' => ['type' => TabularForm::INPUT_TEXT, 'label' => $model->getAttributeLabel('title')],
          'description' => ['type' => TabularForm::INPUT_TEXTAREA, 'label' => $model->getAttributeLabel('description')],
          
          
          'del' => [
              'type' => 'raw',
              'label' => '',
              'value' => function($model, $key) {
                return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' => Yii::t('app', 'Delete'), 'onClick' => 'delRowWorkshop(' . $key . '); return false;', 'id' => 'workshop-del-btn']);
              },
          ],
          'edit' => [
              'type' => 'raw',
              'label' => '',
              'value' => function($model, $key) {
                return isset($model) && isset($model['id']) ? Html::a('<i class="glyphicon glyphicon-edit"></i>', ['oeiizk/workshop/update', 'id' => $model['id']]) : false;
              },
          ],
           'users' => [
              'type' => 'raw',
              'label' => '',
              'value' => function($model, $key) {
                return isset($model) && isset($model['id']) ? Html::a('<i class="glyphicon glyphicon-user"></i>', ['oeiizk/workshop-user', 'WorkshopUserSearch[workshop_id]' => $model['id']]) : false;
              },
          ],
      ],
      'gridSettings' => [
          'panel' => [
              'heading' => false,
              'type' => GridView::TYPE_DEFAULT,
              'before' => false,
              'footer' => false,
              'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'Add Workshop'), ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowWorkshop()']),
          ]
      ]
  ]);
  echo "    </div>\n\n";

  ?>

