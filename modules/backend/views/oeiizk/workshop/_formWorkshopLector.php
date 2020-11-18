<div class="form-group" id="add-workshop-lector">
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
      'formName' => 'WorkshopLector',
      'checkboxColumn' => false,
      'actionColumn' => false,
      'attributeDefaults' => [
          'type' => TabularForm::INPUT_TEXT,
      ],
      'attributes' => [
          "workshop_id" => ['type' => TabularForm::INPUT_HIDDEN_STATIC, 'columnOptions'=>['hidden'=>true]],
          'user_id' => [
              'label' => Yii::t('app', 'Lector'),
              'type' => TabularForm::INPUT_WIDGET,
              'widgetClass' => \kartik\widgets\Select2::className(),
              'options' => [
                  'data' => \yii\helpers\ArrayHelper::map(\app\models\mgcms\db\User::find()->orderBy('id')->all(), 'id', 'toString'),
                  'options' => ['placeholder' => Yii::t('app', 'Choose User')],
              ],
              'columnOptions' => ['width' => '200px']
          ],
          'del' => [
              'type' => 'raw',
              'label' => '',
              'value' => function($model, $key) {
                return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' => Yii::t('app', 'Delete'), 'onClick' => 'delRowWorkshopLector(' . $key . '); return false;', 'id' => 'workshop-lector-del-btn']);
              },
          ],
      ],
      'gridSettings' => [
          'panel' => [
              'heading' => false,
              'type' => GridView::TYPE_DEFAULT,
              'before' => false,
              'footer' => false,
              'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'Dodaj prowadzącego'), ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowWorkshopLector()']),
          ]
      ]
  ]);
  echo "    </div>\n\n";

  ?>

