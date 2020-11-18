<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\mgcms\db\ModificationHistory */

$this->title = Yii::t('app', 'Create Modification History');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Modification Histories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modification-history-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
