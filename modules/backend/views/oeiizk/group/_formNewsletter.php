<div class="form-group" id="add-newsletter">
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
    'formName' => 'Newsletter',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        'name' => ['type' => TabularForm::INPUT_TEXT],
        'header' => ['type' => TabularForm::INPUT_TEXTAREA],
        'footer' => ['type' => TabularForm::INPUT_TEXTAREA],
        'text' => ['type' => TabularForm::INPUT_TEXTAREA],
        'add_incoming_training_info' => ['type' => TabularForm::INPUT_CHECKBOX,
            'options' => [
                'style' => 'position : relative; margin-top : -9px'
            ]
        ],
        'status' => ['type' => TabularForm::INPUT_TEXT],
        'keywords' => ['type' => TabularForm::INPUT_TEXTAREA],
        'date_sent' => ['type' => TabularForm::INPUT_TEXT],
        'is_required_answer' => ['type' => TabularForm::INPUT_CHECKBOX,
            'options' => [
                'style' => 'position : relative; margin-top : -9px'
            ]
        ],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  Yii::t('app', 'Delete'), 'onClick' => 'delRowNewsletter(' . $key . '); return false;', 'id' => 'newsletter-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'Add Newsletter'), ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowNewsletter()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

