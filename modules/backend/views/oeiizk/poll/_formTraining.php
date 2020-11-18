<div class="form-group" id="add-training">
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
    'formName' => 'Training',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        'name' => ['type' => TabularForm::INPUT_TEXT],
        'subtitle' => ['type' => TabularForm::INPUT_TEXT],
        'training_template_id' => [
            'label' => 'Training template',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\db\TrainingTemplate::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                'options' => ['placeholder' => Yii::t('app', 'Choose Training template')],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'code' => ['type' => TabularForm::INPUT_TEXT],
        'meeting_number' => ['type' => TabularForm::INPUT_TEXT],
        'module_number' => ['type' => TabularForm::INPUT_TEXT],
        'date_start' => ['type' => TabularForm::INPUT_TEXT],
        'date_end' => ['type' => TabularForm::INPUT_TEXT],
        'technical_requirements' => ['type' => TabularForm::INPUT_TEXTAREA],
        'social_requirements' => ['type' => TabularForm::INPUT_TEXTAREA],
        'visibility' => ['type' => TabularForm::INPUT_TEXT],
        'certificate_lines' => ['type' => TabularForm::INPUT_TEXTAREA],
        'minimal_participants_number' => ['type' => TabularForm::INPUT_TEXT],
        'maximal_participants_number' => ['type' => TabularForm::INPUT_TEXT],
        'final_maximal_participants_number' => ['type' => TabularForm::INPUT_TEXT],
        'is_login_required' => ['type' => TabularForm::INPUT_CHECKBOX,
            'options' => [
                'style' => 'position : relative; margin-top : -9px'
            ]
        ],
        'status' => ['type' => TabularForm::INPUT_TEXT],
        'is_card_required' => ['type' => TabularForm::INPUT_CHECKBOX,
            'options' => [
                'style' => 'position : relative; margin-top : -9px'
            ]
        ],
        'is_certificate_issued' => ['type' => TabularForm::INPUT_TEXTAREA],
        'additional_information' => ['type' => TabularForm::INPUT_TEXTAREA],
        'comments' => ['type' => TabularForm::INPUT_TEXTAREA],
        'sign_status' => ['type' => TabularForm::INPUT_TEXT],
        'is_promoted_oeiizk' => ['type' => TabularForm::INPUT_CHECKBOX,
            'options' => [
                'style' => 'position : relative; margin-top : -9px'
            ]
        ],
        'is_promoted_pos' => ['type' => TabularForm::INPUT_CHECKBOX,
            'options' => [
                'style' => 'position : relative; margin-top : -9px'
            ]
        ],
        'file_id' => [
            'label' => 'File',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\mgcms\db\File::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                'options' => ['placeholder' => Yii::t('app', 'Choose File')],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'link_to_materials' => ['type' => TabularForm::INPUT_TEXT],
        'article_id' => [
            'label' => 'Article',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\mgcms\db\Article::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
                'options' => ['placeholder' => Yii::t('app', 'Choose Article')],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'subject_id' => [
            'label' => 'Subject',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\db\Subject::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                'options' => ['placeholder' => Yii::t('app', 'Choose Subject')],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'project' => ['type' => TabularForm::INPUT_TEXT],
        'is_display_on_screen' => ['type' => TabularForm::INPUT_CHECKBOX,
            'options' => [
                'style' => 'position : relative; margin-top : -9px'
            ]
        ],
        'lab_id' => [
            'label' => 'Lab',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\db\Lab::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                'options' => ['placeholder' => Yii::t('app', 'Choose Lab')],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  Yii::t('app', 'Delete'), 'onClick' => 'delRowTraining(' . $key . '); return false;', 'id' => 'training-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'Add Training'), ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowTraining()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

