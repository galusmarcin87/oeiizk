<div class="form-group" id="add-user-educational-level">
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
    'formName' => 'UserEducationalLevel',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        "training_template_id" => ['type' => TabularForm::INPUT_HIDDEN_STATIC, 'columnOptions'=>['hidden'=>true]],
        'educational_level_id' => [
            'label' => '<div class="row"><div class="col-md-3">Poziom edukacyjny</div> '.'<div class="col-md-9"> <small>Proszę wybrać wszystkie poziomy, na których Państwo uczą:<br/>P - przedszkole, 1-3, 4-6, 7-8 - szkoła podstawowa, PP - szkoła ponadpodstawowa.</span></div></div>',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                
                'data' => \yii\helpers\ArrayHelper::map(app\models\db\EducationalLevel::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
                'options' => ['placeholder' => 'Wybierz poziom edukacyjny'],
            ],
            'columnOptions' => ['width' => '90%','encodeLabel' => false,]
        ],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  Yii::t('app', 'Delete'), 'onClick' => 'delRowUserEducationalLevel(' . $key . '); return false;', 'id' => 'user-educational-level-del-btn','class' => 'remove']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>Dodaj poziom edukacyjny', ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowUserEducationalLevel()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

