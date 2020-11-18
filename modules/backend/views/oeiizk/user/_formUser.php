<div class="form-group" id="add-user">
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
    'formName' => 'User',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        "id" => ['type' => TabularForm::INPUT_HIDDEN, 'visible' => false],
        'username' => ['type' => TabularForm::INPUT_TEXT],
        'password' => ['type' => TabularForm::INPUT_PASSWORD],
        'first_name' => ['type' => TabularForm::INPUT_TEXT],
        'last_name' => ['type' => TabularForm::INPUT_TEXT],
        'role' => ['type' => TabularForm::INPUT_TEXT],
        'status' => ['type' => TabularForm::INPUT_TEXT],
        'email' => ['type' => TabularForm::INPUT_TEXT],
        'created_on' => ['type' => TabularForm::INPUT_TEXT],
        'last_login' => ['type' => TabularForm::INPUT_TEXT],
        'address' => ['type' => TabularForm::INPUT_TEXT],
        'postcode' => ['type' => TabularForm::INPUT_TEXT],
        'birthdate' => ['type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\datecontrol\DateControl::classname(),
            'options' => [
                'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                'saveFormat' => 'php:Y-m-d',
                'ajaxConversion' => true,
                'options' => [
                    'pluginOptions' => [
                        'placeholder' => Yii::t('app', 'Choose Birthdate'),
                        'autoclose' => true
                    ]
                ],
            ]
        ],
        'city' => ['type' => TabularForm::INPUT_TEXT],
        'auth_key' => ['type' => TabularForm::INPUT_TEXT],
        'is_password_change_accepted' => ['type' => TabularForm::INPUT_CHECKBOX,
            'options' => [
                'style' => 'position : relative; margin-top : -9px'
            ]
        ],
        'other_names' => ['type' => TabularForm::INPUT_TEXT],
        'gender' => ['type' => TabularForm::INPUT_TEXT],
        'date_email_confirmation' => ['type' => TabularForm::INPUT_TEXT],
        'birth_place' => ['type' => TabularForm::INPUT_TEXT],
        'position' => ['type' => TabularForm::INPUT_TEXT],
        'educational_level' => ['type' => TabularForm::INPUT_TEXT],
        'employment_card_id' => [
            'label' => 'File',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\mgcms\db\File::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                'options' => ['placeholder' => Yii::t('app', 'Choose File')],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'date_card_verification' => ['type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\datecontrol\DateControl::classname(),
            'options' => [
                'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                'saveFormat' => 'php:Y-m-d',
                'ajaxConversion' => true,
                'options' => [
                    'pluginOptions' => [
                        'placeholder' => Yii::t('app', 'Choose Date Card Verification'),
                        'autoclose' => true
                    ]
                ],
            ]
        ],
        'date_card_submission' => ['type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\datecontrol\DateControl::classname(),
            'options' => [
                'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                'saveFormat' => 'php:Y-m-d',
                'ajaxConversion' => true,
                'options' => [
                    'pluginOptions' => [
                        'placeholder' => Yii::t('app', 'Choose Date Card Submission'),
                        'autoclose' => true
                    ]
                ],
            ]
        ],
        'academic_title' => ['type' => TabularForm::INPUT_TEXT],
        'phone' => ['type' => TabularForm::INPUT_TEXT],
        'is_special_account' => ['type' => TabularForm::INPUT_CHECKBOX,
            'options' => [
                'style' => 'position : relative; margin-top : -9px'
            ]
        ],
        'credibility' => ['type' => TabularForm::INPUT_TEXT],
        'is_newsletter' => ['type' => TabularForm::INPUT_CHECKBOX,
            'options' => [
                'style' => 'position : relative; margin-top : -9px'
            ]
        ],
        'comments' => ['type' => TabularForm::INPUT_TEXTAREA],
        'is_not_logged_account' => ['type' => TabularForm::INPUT_CHECKBOX,
            'options' => [
                'style' => 'position : relative; margin-top : -9px'
            ]
        ],
        'training_preferences' => ['type' => TabularForm::INPUT_TEXTAREA],
        'training_preferences_keywords' => ['type' => TabularForm::INPUT_TEXT],
        'date_last_password_change' => ['type' => TabularForm::INPUT_TEXT],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  Yii::t('app', 'Delete'), 'onClick' => 'delRowUser(' . $key . '); return false;', 'id' => 'user-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'Add User'), ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowUser()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

