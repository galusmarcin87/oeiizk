<div class="form-group" id="add-pol-question-answer">
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
    'formName' => 'PolQuestionAnswer',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        'poll_poll_question_poll_id' => [
            'label' => 'Poll poll question',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\mgcms\db\PollPollQuestion::find()->orderBy('poll_id')->asArray()->all(), 'poll_id', 'poll_id'),
                'options' => ['placeholder' => Yii::t('app', 'Choose Poll poll question')],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'poll_poll_question_poll_question_id' => ['type' => TabularForm::INPUT_TEXT],
        'answer' => ['type' => TabularForm::INPUT_TEXT],
        'answer_open' => ['type' => TabularForm::INPUT_TEXTAREA],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  Yii::t('app', 'Delete'), 'onClick' => 'delRowPolQuestionAnswer(' . $key . '); return false;', 'id' => 'pol-question-answer-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'Add Pol Question Answer'), ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowPolQuestionAnswer()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

