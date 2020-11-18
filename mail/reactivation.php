<?

use app\components\mgcms\MgHelpers;

?>

W celu aktywacji swojego konta, potwierdź je klikając w poniższy link:<br/>
<a href="<?=
  yii\helpers\Url::to([
      '/site/activate',
      'hash' => app\components\mgcms\MgHelpers::encrypt($model->id)
      ], true)

  ?>"><?= Yii::t('app', 'Click here'); ?></a>.

Zapraszamy na nasze szkolenia.
Pozdrawiamy
OEIiZK

