<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\mgcms\db\User */

?>
<div class="user-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->username) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'username',
        'password',
        'first_name',
        'last_name',
        'role',
        'status',
        'email:email',
        'created_on',
        'last_login',
        [
            'attribute' => 'createdBy.username',
            'label' => Yii::t('app', 'Created By'),
        ],
        'address',
        'postcode',
        'birthdate',
        'city',
        'auth_key',
        'is_password_change_accepted',
        'other_names',
        'gender',
        'date_email_confirmation:email',
        'birth_place',
        'position',
        'educational_level',
        [
            'attribute' => 'employmentCard.name',
            'label' => Yii::t('app', 'Employment Card'),
        ],
        'date_card_verification',
        'date_card_submission',
        'academic_title',
        'phone',
        'is_special_account',
        'credibility',
        'is_newsletter',
        'comments:ntext',
        'is_not_logged_account',
        'training_preferences:ntext',
        'training_preferences_keywords',
        'date_last_password_change',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>