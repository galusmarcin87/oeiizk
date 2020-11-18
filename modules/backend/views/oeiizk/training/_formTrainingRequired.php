<div class="form-group" id="add-training-required">
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
      'formName' => 'TrainingRequired',
      'checkboxColumn' => false,
      'actionColumn' => false,
      'attributeDefaults' => [
          'type' => TabularForm::INPUT_TEXT,
      ],
      'attributes' => [
          "training_id" => ['type' => TabularForm::INPUT_HIDDEN_STATIC, 'columnOptions' => ['hidden' => true]],
          'training_2_id' => [
              'label' => Yii::t('app', 'Training'),
              'type' => TabularForm::INPUT_WIDGET,
              'widgetClass' => \kartik\widgets\Select2::className(),
              'options' => [
                  'data' => \yii\helpers\ArrayHelper::map(\app\models\db\Training::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                  'options' => ['placeholder' => Yii::t('app', 'Choose Training')],
              ],
              'columnOptions' => ['width' => '200px']
          ],
          'del' => [
              'type' => 'raw',
              'label' => '',
              'value' => function($model, $key) {
                return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' => Yii::t('app', 'Delete'), 'onClick' => 'delRowTrainingRequired(' . $key . '); return false;', 'id' => 'training-required-del-btn']);
              },
          ],
      ],
      'gridSettings' => [
          'panel' => [
              'heading' => false,
              'type' => GridView::TYPE_DEFAULT,
              'before' => false,
              'footer' => false,
              'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'Add Training Required'), ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowTrainingRequired()']),
          ]
      ]
  ]);
  echo "    </div>\n\n";

  ?>

