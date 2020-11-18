<?php
use yii\helpers\Html;
use app\components\mgcms\yii\ActiveForm;
use app\components\mgcms\MgHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\mgcms\db\User */

$this->title = 'Podobni użytkownicy';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];

?>
<div class="user-update">

  <h1><?= Html::encode($this->title) ?></h1>

  <?php $form = ActiveForm::begin(); ?>

  <table class="kv-grid-table table table-bordered table-striped kv-table-wrap">
    <tr>
      <th colspan="4">
        Aktualny użytkownik
      </th>
      <th colspan="4">
        Nowy użytkownik
      </th>
      <th>

      </th>
    </tr>
    <tr>
      <th>
        ID
      </th>
      <th>
        Imię
      </th>
      <th>
        Nazwisko
      </th>
      <th>
        Data urodzenia
      </th>
      <th>
        ID
      </th>
      <th>
        Imię
      </th>
      <th>
        Nazwisko
      </th>
      <th>
        Data urodzenia
      </th>
      <th>
        Akceptuj
      </th>
    </tr>

    <? foreach (Yii::$app->session['similarUsers'] as $similarUserRow): ?>
      <?
      $old = \app\models\mgcms\db\User::findOne($similarUserRow['old']);
      $new = \app\models\mgcms\db\User::findOne($similarUserRow['new']);
      if (!$old || !$new) {
        continue;
      }

      ?>
      <tr>
        <td>
          <?= $old->id ?>
        </td>
        <td>
          <?= $old->first_name ?>
        </td>
        <td>
          <?= $old->last_name ?>
        </td>
        <td>
          <?= $old->birthdate ?>
        </td>
        <td>
          <?= $new->id ?>
        </td>
        <td>
          <?= $new->first_name ?>
        </td>
        <td>
          <?= $new->last_name ?>
        </td>
        <td>
          <?= $new->birthdate ?>
        </td>
        <td>
          <input type="hidden" name="SimilarUser[<?=$new->id?>]" value="0"/>
          <input type="checkbox" name="SimilarUser[<?=$new->id?>]" value="1"/>
        </td>
      </tr>


    <? endforeach ?>


  </table>


  <div class="form-group">
    <?=
    Html::submitButton('Zapisz',
        ['class' => 'btn btn-success'])

    ?>

  </div>

  <?php ActiveForm::end(); ?>

</div>
