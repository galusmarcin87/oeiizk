<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use app\components\mgcms\MgHelpers;
use yii\bootstrap\ActiveForm;
use app\models\mgcms\db\Category;
use app\models\db\TrainingSearch;

?>


<?php
$form = ActiveForm::begin([
        'method' => 'get',
        'action' => \yii\helpers\Url::to('/site/index'),
        'id' => 'HPTrainingSearch'
    ]);

function getCheckboxListOptions($offset){
    $checkboxListOptions = [
        'tag' => false,
        'item' => function ($index, $label, $name, $checked, $value) {
            $uid = uniqid();
            return '<div class="col-12 col-sm-4 col-md-4 col-lg-2">
                    <input type="checkbox" tabindex="'.($uid. $index).'" id="' . $name . $uid . '" name="' . $name . '" value="' . $value . '" ' . ($checked ? 'checked="checked"' : '') . '>
                    <label tabindex="'.$uid . $index.'"  for="' . $name . $uid . '">' . $label . '</label>
                  </div>';
        }
    ];

    return $checkboxListOptions;
}




?>

<?=
$form->field($searchModel, 'orderName')->hiddenInput()->label(false)

?>
<div class="row mb-3">
  <div class="col">
    <div class="input-group mb-3">
      <?=
      $form->field($searchModel, 'queryString', ['options' => [
              'tag' => false
      ]])->textInput(['class' => 'form-control', 'placeholder' => 'Treść szukanej frazy'])->label(false)

      ?>
      <div class="input-group-append">
        <button class="btn btn-outline-secondary" id="button-addon2" type="submit">SZUKAJ</button>
      </div>
    </div>
    <div class="text-right">
      <a class="btn p-0" data-toggle="collapse" href="#filtersCollapse" role="button" aria-expanded="false" aria-controls="filtersCollapse">
        <span class="open-text">Pokaż filtrowanie zaawansowane <i class="fa fa-angle-down"></i></span>
        <span class="close-text d-none">Zwiń filtrowanie zaawansowane <i class="fa fa-angle-up"></i></span>
      </a>
    </div>
  </div>

</div>


<div class="collapse" id="filtersCollapse">
  <div class="row form-group checkboxes align-items-start">


    <div class="col-12 col-lg-2">
      <p>Grupa szkoleń:</p>
    </div>

    <div class="col-12 col-lg-10">
      <div class="row">
        <?
        $parentPategories = app\models\mgcms\db\Category::find()->orderBy('name')
            ->andWhere(['type' => app\models\mgcms\db\Category::TYPE_TRAINING])
            ->withoutParent()
            ->all();

        ?>

        <? foreach ($parentPategories as $category): ?>
          <?=
              $form->field($searchModel, 'category_ids', ['options' => [
                      'tag' => false
              ]])
              ->checkboxList(\yii\helpers\ArrayHelper::map($category->categories, 'id', 'name'), getCheckboxListOptions(0))
              ->label(false)

          ?>
        <? endforeach ?>
      </div>
    </div>

  </div>


  <div class="row form-group checkboxes align-items-start">

    <div class="col-12 col-lg-2">
      <p>Poziom edukacyjny:</p>
    </div>
    <div class="col-12 col-lg-10">
      <div class="row">

        <?=
            $form->field($searchModel, 'educationalLevels', ['options' => [
                    'tag' => false
            ]])
            ->checkboxList(\yii\helpers\ArrayHelper::map(\app\models\db\EducationalLevel::find()->orderBy('id')->asArray()->all(), 'id',
                    'name'), getCheckboxListOptions(0))->label(false)

        ?>
      </div>
    </div>
  </div>

  <div class="row form-group checkboxes align-items-start">

    <div class="col-12 col-lg-2">
      <p>Forma szkolenia:</p>
    </div>

    <div class="col-12 col-lg-10">
      <div class="row">
        <?=
            $form->field($searchModel, 'trainingForms', ['options' => [
                    'tag' => false
            ]])
            ->checkboxList([TrainingSearch::FORM_LOCAL => 'stacjonarne', TrainingSearch::FORM_ONLINE => 'online', TrainingSearch::FORM_MIXED => 'mieszane'],
                getCheckboxListOptions(0))->label(false)

        ?>
      </div>
    </div>
  </div>

  <div class="row form-group checkboxes">

    <div class="col-3 col-lg-3">
      <p>Dzień tygodnia:</p>
      <?=
          $form->field($searchModel, 'startDayOfWeek')
          ->dropDownList(['', 'poniedziałek', 'wtorek', 'środa', 'czwartek', 'piątek', 'sobota', 'niedziela'])->label(false)

      ?>
    </div>

    <div class="col-3 col-lg-3">
      <p>Ścieżka:</p>
      <?=
          $form->field($searchModel, 'trainingTemplatePath')
          ->dropDownList(MgHelpers::getSettingOptionArray('szablon szkolenia - ścieżki szkoleniowe'), ['prompt' => ''])->label(false)

      ?>
    </div>

    <div class="col-3 col-lg-3">
      <p>Projekt:</p>
      <?=
          $form->field($searchModel, 'project')
          ->dropDownList(MgHelpers::getSettingOptionArray('szkolenie - projekty'), ['prompt' => ''])->label(false)

      ?>
    </div>

    <div class="col-3 col-lg-3">
      <p>Delegatura:</p>
      <?=
          $form->field($searchModel, 'delegacies')
          ->dropDownList(MgHelpers::getSettingOptionArray('delegatura'), ['prompt' => ''])->label(false)

      ?>
    </div>


  </div>

  <button type="submit" class="btn bt-danger float-right">Filtruj</button>
</div>
<?php ActiveForm::end(); ?>


<script type="text/javascript">
  var oldCategory = false;

  $('input[name="TrainingSearch[category_ids][]"]').change(function () {
    var that = $(this);
    $('input[name="TrainingSearch[category_ids][]"]').each(function () {
      $(this).prop('checked', false)
    });
    setTimeout(function () {
      if (oldCategory != that.val()) {
        oldCategory = that.val();
        that.prop('checked', true);
      } else {
        oldCategory = false;
      }

      $('input[name="TrainingSearch[category_ids]"]').remove();
    }, 1)

  });

  $('input[name="TrainingSearch[category_ids][]"]:checked').change();

  $('#filtersCollapse [type=checkbox]').each(function(index){

    var label = $(this).parent().find('label');
    if(label){
      $(label).attr('tabindex',index);
      $(this).attr('tabindex',index);
    }
    console.log(label);
  })
</script>
