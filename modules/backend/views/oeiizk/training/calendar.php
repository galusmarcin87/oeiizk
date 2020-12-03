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

	<form class="row ">
		<div class="col-md-6">
            <?=
            Html::dropDownList('lab_id', Yii::$app->request->get('lab_id'),
                \yii\helpers\ArrayHelper::map(\app\models\db\Lab::find()->orderBy('id')->andWhere(['is_our' => 1])->all(), 'id', 'shorterName'),
                ['prompt' => '', 'class' => 'col-md-6 form-control'])

            ?>
			<button class="btn btn-success">Wybierz salę</button>
		</div>

		<div class="col-md-6">
            <?=
            Html::dropDownList('institution_id', Yii::$app->request->get('institution_id'),
                \yii\helpers\ArrayHelper::map(\app\models\db\Institution::find()->joinWith('labs')->andWhere(['lab.is_our' => 1])->orderBy('id')->all(), 'id', 'street'),
                ['prompt' => '', 'class' => 'col-md-6 form-control'])

            ?>
			<button class="btn btn-success">Wybierz instytucję</button>
		</div>

	</form>

	<div class="row top10">
		<div class="col-md-6"><button class="btn btn-success" onclick="exportToCsv()">Eksportuj</button></div>

	</div>

	<div class="calendar top10">

        <?=
        yii2fullcalendar\yii2fullcalendar::widget([
            'options' => [
                'lang' => 'pl',
            ],
            'eventRender' => "afterCalendarRender",
            'events' => yii\helpers\Url::to(['jsoncalendar', 'lab_id' => $lab ? $lab->id : false, 'institution_id' =>Yii::$app->request->get('institution_id')])
        ]);

        ?>
	</div>


</div>

<script type="text/javascript">



    function exportToCsv(){
        let csvContent = "data:text/csv;charset=utf-8,";

        csvContent += 'Data szkolenia od, Data szkolenia do, Kod szkolenia, Sala, Prowadzący'+ "\r\n";
        events.forEach(function(event) {
            var addInfo = JSON.parse(event.nonstandard);
            var rowData = [
                addInfo.dateFrom,
                addInfo.dateTo,
                addInfo.code,
                addInfo.lab,
                addInfo.lector,
            ];


            let row = rowData.join(",");
            csvContent += row + "\r\n";
        });

        var encodedUri = encodeURI(csvContent);
        window.open(encodedUri);
    }
    var events = [];
    function afterCalendarRender(){
        events = $('.fullcalendar').fullCalendar('clientEvents');
    }

    jQuery('.fullcalendar').on('click', '.fc-event', function (e) {
        e.preventDefault();
        window.open(jQuery(this).attr('href'), '_blank');
    });

</script>