<?
/* @var $model \app\models\db\Newsletter */
use app\components\mgcms\MgHelpers;

?>
<?= MgHelpers::getSetting('newsletter_header', true) ?>
<?=$model->text?>
<?= MgHelpers::getSetting('newsletter_footer', true) ?>