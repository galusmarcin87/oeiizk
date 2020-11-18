<div class="form-group" id="add-institution">
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
    'formName' => 'Institution',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        "id" => ['type' => TabularForm::INPUT_HIDDEN, 'visible' => false],
        'name' => ['type' => TabularForm::INPUT_TEXT],
        'short_name' => ['type' => TabularForm::INPUT_TEXT],
        'code' => ['type' => TabularForm::INPUT_TEXT],
        'created_on' => ['type' => TabularForm::INPUT_TEXT],
        'patron' => ['type' => TabularForm::INPUT_TEXT],
        'city' => ['type' => TabularForm::INPUT_TEXT],
        'community' => ['type' => TabularForm::INPUT_TEXT],
        'county' => ['type' => TabularForm::INPUT_TEXT],
        'province' => ['type' => TabularForm::INPUT_TEXT],
        'street' => ['type' => TabularForm::INPUT_TEXT],
        'house_no' => ['type' => TabularForm::INPUT_TEXT],
        'postcode' => ['type' => TabularForm::INPUT_TEXT],
        'post' => ['type' => TabularForm::INPUT_TEXT],
        'phone' => ['type' => TabularForm::INPUT_TEXT],
        'www' => ['type' => TabularForm::INPUT_TEXT],
        'type' => ['type' => TabularForm::INPUT_TEXT],
        'is_verified' => ['type' => TabularForm::INPUT_CHECKBOX,
            'options' => [
                'style' => 'position : relative; margin-top : -9px'
            ]
        ],
        'territory' => ['type' => TabularForm::INPUT_TEXT],
        'school_group_name' => ['type' => TabularForm::INPUT_TEXT],
        'delegacy' => ['type' => TabularForm::INPUT_TEXT],
        'NIP' => ['type' => TabularForm::INPUT_TEXT],
        'email' => ['type' => TabularForm::INPUT_TEXT],
        'school_governing_body' => ['type' => TabularForm::INPUT_TEXT],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  Yii::t('app', 'Delete'), 'onClick' => 'delRowInstitution(' . $key . '); return false;', 'id' => 'institution-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'Add Institution'), ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowInstitution()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

