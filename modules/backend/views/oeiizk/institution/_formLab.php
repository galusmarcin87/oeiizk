<div class="form-group" id="add-lab">
  <?php
  use kartik\grid\GridView;
  use kartik\builder\TabularForm;
  use yii\data\ArrayDataProvider;
  use yii\helpers\Html;
  use yii\widgets\Pjax;

$lab = new app\models\db\Lab;

  $dataProvider = new ArrayDataProvider([
      'allModels' => $row,
      'pagination' => [
          'pageSize' => -1
      ]
  ]);
  echo TabularForm::widget([
      'dataProvider' => $dataProvider,
      'formName' => 'Lab',
      'checkboxColumn' => false,
      'actionColumn' => false,
      'attributeDefaults' => [
          'type' => TabularForm::INPUT_TEXT,
      ],
      'attributes' => [
          "id" => ['type' => TabularForm::INPUT_HIDDEN_STATIC, 'columnOptions' => ['hidden' => true]],
          'name' => ['type' => TabularForm::INPUT_TEXT, 'label' => $lab->getAttributeLabel('name')],
          'short_headquarter_name' => ['type' => TabularForm::INPUT_TEXT, 'label' => $lab->getAttributeLabel('short_headquarter_name')],
          'long_name' => ['type' => TabularForm::INPUT_TEXTAREA, 'label' => $lab->getAttributeLabel('long_name')],
          'floor' => ['type' => TabularForm::INPUT_TEXT, 'label' => $lab->getAttributeLabel('floor')],
          'is_our' => \app\components\mgcms\MgHelpers::backendGetSwitchColumnSettings($lab->getAttributeLabel('is_our')),
          'del' => [
              'type' => 'raw',
              'label' => '',
              'value' => function($model, $key) {
                return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' => Yii::t('app', 'Delete'), 'onClick' => 'delRowLab(' . $key . '); return false;', 'id' => 'lab-del-btn']);
              },
          ],
      ],
      'gridSettings' => [
          'panel' => [
              'heading' => false,
              'type' => GridView::TYPE_DEFAULT,
              'before' => false,
              'footer' => false,
              'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'Add Lab'), ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowLab()']),
          ]
      ]
  ]);
  echo "    </div>\n\n";

  ?>

