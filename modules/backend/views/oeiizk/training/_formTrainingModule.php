<div class="form-group" id="add-training-module">
  <?php
  use kartik\grid\GridView;
  use kartik\builder\TabularForm;
  use yii\data\ArrayDataProvider;
  use yii\helpers\Html;
  use yii\widgets\Pjax;

$model = new app\models\db\TrainingModule;

  $dataProvider = new ArrayDataProvider([
      'allModels' => $row,
      'pagination' => [
          'pageSize' => -1
      ]
  ]);
  echo TabularForm::widget([
      'dataProvider' => $dataProvider,
      'formName' => 'TrainingModule',
      'checkboxColumn' => false,
      'actionColumn' => false,
      'attributeDefaults' => [
          'type' => TabularForm::INPUT_TEXT,
      ],
      'attributes' => [
          "id" => ['type' => TabularForm::INPUT_HIDDEN_STATIC, 'columnOptions'=>['hidden'=>true]],
                    'date_start' => ['type' => TabularForm::INPUT_WIDGET,
              'widgetClass' => \kartik\datecontrol\DateControl::classname(),
              'label' => $model->getAttributeLabel('date_start'),
              'options' => [
                  'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                  'saveFormat' => 'php:Y-m-d',
                  'ajaxConversion' => true,
                  'options' => [
                      'pluginOptions' => [
                          'placeholder' => Yii::t('app', 'Choose Date Start'),
                          'autoclose' => true
                      ]
                  ],
              ]
          ],
          'date_end' => ['type' => TabularForm::INPUT_WIDGET,
              'widgetClass' => \kartik\datecontrol\DateControl::classname(),
              'label' => $model->getAttributeLabel('date_end'),
              'options' => [
                  'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                  'saveFormat' => 'php:Y-m-d',
                  'ajaxConversion' => true,
                  'options' => [
                      'pluginOptions' => [
                          'placeholder' => Yii::t('app', 'Choose Date End'),
                          'autoclose' => true
                      ]
                  ],
              ]
          ],
          'hours' => ['type' => TabularForm::INPUT_TEXT, 'label' => $model->getAttributeLabel('hours'),],
          'description' => [
              'type' => TabularForm::INPUT_TEXTAREA, 
              'label' => $model->getAttributeLabel('description'),
              'options' => ['rows'=>10,'cols'=>100],        
              ],
          
          'del' => [
              'type' => 'raw',
              'label' => '',
              'value' => function($model, $key) {
                return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' => Yii::t('app', 'Delete'), 'onClick' => 'delRowTrainingModule(' . $key . '); return false;', 'id' => 'training-module-del-btn']);
              },
          ],
          'edit' => [
              'type' => 'raw',
              'label' => '',
              'value' => function($model, $key) {
                return isset($model) && isset($model['id']) ? Html::a('<i class="glyphicon glyphicon-edit"></i>', ['oeiizk/training-module/update', 'id' => $model['id']]) : false;
              },
          ],
      ],
      'gridSettings' => [
          'panel' => [
              'heading' => false,
              'type' => GridView::TYPE_DEFAULT,
              'before' => false,
              'footer' => false,
              'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'Add Training Module'), ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowTrainingModule()']),
          ]
      ]
  ]);
  echo "    </div>\n\n";

  ?>

