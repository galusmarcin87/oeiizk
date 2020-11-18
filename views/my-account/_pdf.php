<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\mgcms\db\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="user-view">

  <div class="row">
    <div class="col-sm-9">
      <h2><?= Yii::t('app', 'User') . ' ' . Html::encode($this->title) ?></h2>
    </div>
  </div>

  <div class="row">
    <?php
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'username',
        'first_name',
        'last_name',
        'role:translate',
        'statusStr',
        'email:email',
        'created_on',
        'last_login',
        'address',
        'postcode',
        'birthdate',
        'birth_place',
        'city',
        'credibilityCalc',
        'employmentCard:raw',
        'date_card_verification',
        'date_card_submission',
        'created_on',
        'date_last_password_change',
        'date_email_confirmation',
        'training_preferences',
        'is_password_change_accepted:boolean',
        'is_special_account:boolean',
        'is_newsletter:boolean',
        'other_names',
        'position',
        'educational_level',
        'academic_title',
        'phone',
        'training_preferences_keywords',
        'genderStr'
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);

    ?>
  </div>
  
   <div class="row">
    <?php
    if ($providerWorkplace->totalCount) {
      $gridColumnWorkplace = [
          ['class' => 'yii\grid\SerialColumn'],
          ['attribute' => 'id', 'visible' => false],
          [
              'attribute' => 'institution.name',
              'label' => Yii::t('app', 'Institution')
          ],
      ];
      echo GridView::widget([
          'dataProvider' => $providerWorkplace,
          'toggleData' => false,
          'export' => false,
          'panel' => [
              'type' => GridView::TYPE_PRIMARY,
              'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Workplaces')),
          ],
          'columns' => $gridColumnWorkplace
      ]);
    }

    ?>
  </div>

  <div class="row">
    <?php
    if ($providerUserAgreement->totalCount) {
      $gridColumnUserAgreement = [
          ['class' => 'yii\grid\SerialColumn'],
          [
              'attribute' => 'agreement.text',
              'label' => Yii::t('app', 'Agreement')
          ],
          'created_on',
          'expiry_date',
      ];
      echo Gridview::widget([
          'dataProvider' => $providerUserAgreement,
          'panel' => [
              'type' => GridView::TYPE_PRIMARY,
              'heading' => Html::encode(Yii::t('app', 'Agreements')),
          ],
          'toggleData' => false,
          'export' => false,
          'columns' => $gridColumnUserAgreement
      ]);
    }

    ?>
  </div>

  <div class="row">
    <?php
    if ($providerUserSubject->totalCount) {
      $gridColumnUserSubject = [
          ['class' => 'yii\grid\SerialColumn'],
          [
              'attribute' => 'subject.name',
              'label' => Yii::t('app', 'Subject')
          ],
      ];
      echo GridView::widget([
          'dataProvider' => $providerUserSubject,
          'toggleData' => false,
          'export' => false,
          'panel' => [
              'type' => GridView::TYPE_PRIMARY,
              'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Subjects')),
          ],
          'columns' => $gridColumnUserSubject
      ]);
    }

    ?>
  </div>

 

  <div class="row"> 
    <?php
    if ($providerUserEducationalLevel->totalCount) {
      $gridColumnUserEducationalLevel = [
          ['class' => 'yii\grid\SerialColumn'],
          [
              'attribute' => 'educationalLevel.name',
              'label' => Yii::t('app', 'Educational Level')
          ],
      ];
      echo GridView::widget([
          'dataProvider' => $providerUserEducationalLevel,
          'toggleData' => false,
          'export' => false,
          'panel' => [
              'type' => GridView::TYPE_PRIMARY,
              'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Educational Levels')),
          ],
          'columns' => $gridColumnUserEducationalLevel
      ]);
    }

    ?>
  </div>
</div>
