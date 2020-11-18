<div class="form-group" id="add-training-template">
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
    'formName' => 'TrainingTemplate',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        'name' => ['type' => TabularForm::INPUT_TEXT],
        'subtitle' => ['type' => TabularForm::INPUT_TEXT],
        'type' => ['type' => TabularForm::INPUT_TEXT],
        'code_start' => ['type' => TabularForm::INPUT_TEXT],
        'educational_level' => ['type' => TabularForm::INPUT_TEXT],
        'training_gruop' => ['type' => TabularForm::INPUT_TEXT],
        'training_path' => ['type' => TabularForm::INPUT_TEXT],
        'category_id' => [
            'label' => 'Category',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\mgcms\db\Category::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
                'options' => ['placeholder' => Yii::t('app', 'Choose Category')],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'subcategory_id' => [
            'label' => 'Category',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\mgcms\db\Category::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
                'options' => ['placeholder' => Yii::t('app', 'Choose Category')],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'hours_local' => ['type' => TabularForm::INPUT_TEXT],
        'hours_online' => ['type' => TabularForm::INPUT_TEXT],
        'meeting_default_number' => ['type' => TabularForm::INPUT_TEXT],
        'modules_default_number' => ['type' => TabularForm::INPUT_TEXT],
        'lead' => ['type' => TabularForm::INPUT_TEXTAREA],
        'program_file_id' => [
            'label' => 'File',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\mgcms\db\File::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
                'options' => ['placeholder' => Yii::t('app', 'Choose File')],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'date_program_submission' => ['type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\datecontrol\DateControl::classname(),
            'options' => [
                'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                'saveFormat' => 'php:Y-m-d',
                'ajaxConversion' => true,
                'options' => [
                    'pluginOptions' => [
                        'placeholder' => Yii::t('app', 'Choose Date Program Submission'),
                        'autoclose' => true
                    ]
                ],
            ]
        ],
        'date_last_program_modification' => ['type' => TabularForm::INPUT_TEXT],
        'preliminary_recommendations' => ['type' => TabularForm::INPUT_TEXTAREA],
        'default_technical_requirements' => ['type' => TabularForm::INPUT_TEXTAREA],
        'default_social_requirements' => ['type' => TabularForm::INPUT_TEXTAREA],
        'image_id' => [
            'label' => 'File',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\mgcms\db\File::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
                'options' => ['placeholder' => Yii::t('app', 'Choose File')],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'image_2_id' => [
            'label' => 'File',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\mgcms\db\File::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
                'options' => ['placeholder' => Yii::t('app', 'Choose File')],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'keywords' => ['type' => TabularForm::INPUT_TEXTAREA],
        'default_price_category' => ['type' => TabularForm::INPUT_TEXT],
        'visibility' => ['type' => TabularForm::INPUT_TEXT],
        'default_certificate_lines' => ['type' => TabularForm::INPUT_TEXTAREA],
        'default_minimal_participants_number' => ['type' => TabularForm::INPUT_TEXT],
        'default_maximal_participants_number' => ['type' => TabularForm::INPUT_TEXT],
        'is_login_required' => ['type' => TabularForm::INPUT_CHECKBOX,
            'options' => [
                'style' => 'position : relative; margin-top : -9px'
            ]
        ],
        'is_card_required' => ['type' => TabularForm::INPUT_CHECKBOX,
            'options' => [
                'style' => 'position : relative; margin-top : -9px'
            ]
        ],
        'is_certificate_issued' => ['type' => TabularForm::INPUT_TEXTAREA],
        'additional_information' => ['type' => TabularForm::INPUT_TEXTAREA],
        'comments' => ['type' => TabularForm::INPUT_TEXTAREA],
        'poll_id' => [
            'label' => 'Poll',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\db\Poll::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
                'options' => ['placeholder' => Yii::t('app', 'Choose Poll')],
            ],
            'columnOptions' => ['width' => '200px']
        ],
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
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  Yii::t('app', 'Delete'), 'onClick' => 'delRowTrainingTemplate(' . $key . '); return false;', 'id' => 'training-template-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'Add Training Template'), ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowTrainingTemplate()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

