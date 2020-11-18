<?php
use app\components\mgcms\MgHelpers;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\db\Role;

/* @var $this yii\web\View */
/* @var $model app\models\mgcms\db\Auth */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('app', 'Auths');
$this->params['breadcrumbs'][] = $this->title;
$roles = Role::find()->all();

?>

<h1>Uprawnienia</h1>

<?php $form = ActiveForm::begin(); ?>


<table class="items table">
  <thead>
    <tr>
      <th>Moduł</th>
      <th>Akcja</th>
        <th><?= 'rola admin' ?></th>
      <? foreach ($roles as $role): ?>
        <th><?= 'rola ' . $role ?></th>
      <? endforeach ?>
    </tr>
  </thead>
  <tbody>
    <? foreach ($auths as $auth): ?>
      <tr>
        <td><?= $auth->controller ?></th>
        <td ><?= $auth->action ?></td>
          <td>
            <input type="checkbox" name="auth[<?= $auth->controller ?>][<?= $auth->action ?>][admin]" value="1" <?
            if ($this->context->getUserModel()->checkRoleAccess($auth->controller, $auth->action, 'admin')):

              ?> checked="checked"<? endif ?>/>
          </td>
        <? foreach ($roles as $role): ?>
          <td>
            <input type="checkbox" name="auth[<?= $auth->controller ?>][<?= $auth->action ?>][<?= $role->id ?>]" value="1" <?
            if ($this->context->getUserModel()->checkRoleAccess($auth->controller, $auth->action, $role->id)):
              ?> checked="checked"<? endif ?>/>
          </td>
        <? endforeach ?>
      </tr>

    <? endforeach; ?>
  </tbody>
</table>

<button type="submit" class="btn-primary btn">Zapisz</button>
<?php ActiveForm::end(); ?>