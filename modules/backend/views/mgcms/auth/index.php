<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\mgcms\db\AuthSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Auths');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <? $controller = Yii::$app->controller->id;
            if(\app\components\mgcms\MgHelpers::getUserModel()->checkAccess(str_replace(['mgcms/','oeizk/'], '', $controller), 'create')):?><?= Html::a(Yii::t('app', 'Create Auth'), ['create'], ['class' => 'btn btn-success']) ?><?endif?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'controller',
            'action',
            'role',
            'value',

            ['class' => app\components\mgcms\yii\ActionColumn::className()],
        ],
    ]); ?>
</div>
