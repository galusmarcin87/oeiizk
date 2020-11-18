<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use app\components\mgcms\MgHelpers;

$this->title = Yii::t('app', 'Calendar');
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";

?>
<div class="training-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <form>
        <div class="col-md-6">
            <?=
            Html::dropDownList('lab_id', Yii::$app->request->get('lab_id'),
                \yii\helpers\ArrayHelper::map(\app\models\db\Lab::find()->orderBy('id')->andWhere(['is_our' => 1])->all(), 'id', 'shorterName'),
                ['prompt' => '', 'class' => 'form-control'])

            ?>
        </div>
        <button class="btn btn-success">Wybierz salę</button>
    </form>

    <div class="calendar top10">

        <?=
        yii2fullcalendar\yii2fullcalendar::widget([
            'options' => [
                'lang' => 'pl',
            ],
            'events' => yii\helpers\Url::to(['jsoncalendar', 'lab_id' => $lab ? $lab->id : false])
        ]);

        ?>
    </div>


</div>

<script type="text/javascript">

  jQuery('.fullcalendar').on( 'click', '.fc-event', function(e){
    
    e.preventDefault();
    window.open( jQuery(this).attr('href'), '_blank' );
});
</script>