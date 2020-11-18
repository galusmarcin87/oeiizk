<div class="form-group" id="add-modification-history">
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
    'formName' => 'ModificationHistory',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        "id" => ['type' => TabularForm::INPUT_HIDDEN, 'visible' => false],
        'created_on' => ['type' => TabularForm::INPUT_TEXT],
        'model_class' => ['type' => TabularForm::INPUT_TEXT],
        'model_id' => ['type' => TabularForm::INPUT_TEXT],
        'previous_model' => ['type' => TabularForm::INPUT_TEXTAREA],
        'model' => ['type' => TabularForm::INPUT_TEXTAREA],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  Yii::t('app', 'Delete'), 'onClick' => 'delRowModificationHistory(' . $key . '); return false;', 'id' => 'modification-history-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'Add Modification History'), ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowModificationHistory()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

