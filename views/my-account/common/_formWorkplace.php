<div class="form-group" id="add-workplace">
  <?php
  use kartik\grid\GridView;
  use kartik\builder\TabularForm;
  use yii\data\ArrayDataProvider;
  use yii\helpers\Html;
  use yii\widgets\Pjax;
  use yii\web\JsExpression;

$model = new \app\models\db\Workplace;


  $dataProvider = new ArrayDataProvider([
      'allModels' => $row,
      'pagination' => [
          'pageSize' => -1
      ]
  ]);
  echo TabularForm::widget([
      'dataProvider' => $dataProvider,
      'formName' => 'Workplace',
      'checkboxColumn' => false,
      'actionColumn' => false,
      'attributeDefaults' => [
          'type' => TabularForm::INPUT_TEXT,
      ],
      'attributes' => [
          "id" => ['type' => TabularForm::INPUT_HIDDEN, 'visible' => false],
          'institution_id' => ['type' => TabularForm::INPUT_HIDDEN_STATIC, 'columnOptions' => ['hidden' => true]],
          'instytucja' => [
              'type' => TabularForm::INPUT_HIDDEN_STATIC, 
              'columnOptions' => ['width' => '80%'],
              'value' => function($model, $key) {
                if ($model && isset($model['institution_id'])) {
                  $institution = app\models\db\Institution::findOne($model['institution_id']);
                  return (string) $institution;
                }
                return '<span id="institutionName_'.$key.'"></span>';
              }],
          'selectInstitution' => [
              'label' => 'Wybierz instytucję',
              'type' => 'raw',
              'value' => function($model, $key) {
                return $model ? '' : Html::a('Wybierz instytucję', '#', [
                    'title' => Yii::t('app', 'Delete'), 
                    'onClick' => 'showInstitutionModal(' . $key . '); return false;', 
                    'id' => 'workplace-addInstitution-btn', 
                    'class' => 'btn btn-primary']).'<script>showInstitutionModal(' . $key . ')</script>';
              },
          ],
          'del' => [
              'type' => 'raw',
              'label' => '',
              'value' => function($model, $key) {
                return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' => Yii::t('app', 'Delete'), 'onClick' => 'delRowWorkplace(' . $key . '); return false;', 'id' => 'workplace-del-btn', 'class' => 'remove']);
              },
          ],
      ],
      'gridSettings' => [
          'panel' => [
              'heading' => false,
              'type' => GridView::TYPE_DEFAULT,
              'before' => false,
              'footer' => false,
              'after' =>
	              Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'Add Workplace'), ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowWorkplace()']) . ' ' .
                  Html::a('<i class="glyphicon glyphicon-question-sign"></i>', \app\components\mgcms\MgHelpers::getSetting('url do artykułu z pomocą dotyczącą wyboru miejsca zatrudnienia'), ['title' => Yii::t('app', 'Help'), ])

          ]
      ]
  ]);
  echo "    </div>\n\n";

  $formatJs = <<< 'JS'
var formatRepoSelection = function (repo, container) {
    $.get("/my-account/institutions-ajax?id="+repo.id,function(data){ container.text( data.results.text)})
}

JS;

// Register the formatting script
  $this->registerJs($formatJs, yii\web\View::POS_HEAD);

  ?>

