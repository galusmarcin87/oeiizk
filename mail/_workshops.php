<?
/* @var $model \app\models\db\Training */
/* @var $user app\models\mgcms\db\User */
use app\components\mgcms\MgHelpers;

?>


<?if($model->workshops):?>
<h4>Warsztaty</h4>
<?foreach($model->workshops as $workshop):?>
<?if($user->isWorkshopParticipant($workshop)):?>
<p>
  <?=$workshop?>, <?=$workshop->date_start?> - <?=$workshop->date_end?>, sala <?=$workshop->lab?>
</p>
<?endif?>
<? endforeach;?>

<? endif; ?>
