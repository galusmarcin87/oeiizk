<?php
use yii\helpers\Html;
use app\components\mgcms\yii\ActiveForm;
use app\components\mgcms\MgHelpers;

$this->title = Yii::t('app', 'Update User') . ' ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');


/* @var $this yii\web\View */
/* @var $model app\models\mgcms\db\User */
/* @var $form app\components\mgcms\yii\ActiveForm */


\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'SqlQuery',
        'relID' => 'sql-query',
        'value' => \yii\helpers\Json::encode($model->sqlQueries),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'UserGroup',
        'relID' => 'user-group',
        'value' => \yii\helpers\Json::encode($model->userGroups),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'UserRole',
        'relID' => 'user-role',
        'value' => \yii\helpers\Json::encode($model->userRoles),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'Workplace',
        'relID' => 'workplace',
        'value' => \yii\helpers\Json::encode($model->workplaces),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'UserSubject',
        'relID' => 'user-subject',
        'value' => \yii\helpers\Json::encode($model->subjects),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'UserEducationalLevel',
        'relID' => 'user-educational-level',
        'value' => \yii\helpers\Json::encode($model->userEducationalLevels),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);

?>
<div class="user-update">

  <h1><?= Html::encode($this->title) ?></h1>



  <div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <div class="hidden">
      <?= $form->field($model, 'id')->hiddenInput() ?>
    </div>


    <?php
    $forms = [
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Roles')),
            'content' => $this->render('_formUserRole', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->userRoles),
            ]),
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Groups')),
            'content' => $this->render('_formUserGroup', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->userGroups),
            ]),
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Workplaces')),
            'content' => $this->render('_formWorkplace', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->workplaces),
            ]),
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Subjects')),
            'content' => $this->render('_formUserSubject', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->userSubjects),
            ]),
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Educational Levels')),
            'content' => $this->render('_formUserEducationalLevel', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->userEducationalLevels),
            ]),
        ],
    ];
    echo kartik\tabs\TabsX::widget([
        'items' => $forms,
        'position' => kartik\tabs\TabsX::POS_ABOVE,
        'encodeLabels' => false,
        'pluginOptions' => [
            'bordered' => true,
            'sideways' => true,
            'enableCache' => false,
        ],
    ]);

    ?>
    <div class="form-group">
      <?php if (Yii::$app->controller->action->id != 'save-as-new'): ?>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
      <?php endif; ?>
      <?php if (Yii::$app->controller->action->id != 'create'): ?>
        <?= Html::submitButton(Yii::t('app', 'Save As New'), ['class' => 'btn btn-info', 'value' => '1', 'name' => '_asnew']) ?>
      <?php endif; ?>
      <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer, ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

  </div>


</div>
