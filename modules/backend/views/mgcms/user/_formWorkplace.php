<div class="form-group" id="add-workplace">
<?php
use kartik\grid\GridView;
use kartik\builder\TabularForm;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use yii\widgets\Pjax;

$model = new \app\models\db\Workplace;

$dataProvider = new ArrayDataProvider([
    'allModels' => $row,
    'pagination' => [
        'pageSize' => -1
    ]
]);
echo TabularForm::widget([
    'dataProvider' => $dataProvider,
    'formName' => 'Workplace',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        "id" => ['type' => TabularForm::INPUT_HIDDEN, 'visible' => false],
        'institution_id' => [
            'label' => $model->getAttributeLabel('institution_id'),
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\db\Institution::find()->orderBy('name')->all(), 'id', 'fullName'),
                'options' => ['placeholder' => Yii::t('app', 'Choose Institution')],
            ],
            'columnOptions' => ['width' => '90%']
        ],
        'edit' => [
                'type' => 'raw',
                'label' => '',
                'value' => function($model, $key) {
                  return isset($model) && isset($model['id']) ? Html::a('<i class="glyphicon glyphicon-edit"></i>',
                          ['oeiizk/workplace/update', 'id' => $model['id']]) : false;
                },
            ],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  Yii::t('app', 'Delete'), 'onClick' => 'delRowWorkplace(' . $key . '); return false;', 'id' => 'workplace-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'Add Workplace'), ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowWorkplace()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

