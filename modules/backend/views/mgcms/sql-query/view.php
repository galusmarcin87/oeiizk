<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\mgcms\db\SqlQuery */

$this->title = $model;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sql Query'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="sql-query-view">

  <div class="row">
    <div class="col-sm-8">
      <h2><?= Yii::t('app', 'Sql Query') . ' ' . Html::encode($this->title) ?></h2>
    </div>
    <div class="col-sm-4" style="margin-top: 15px">
      <?= Html::a(kartik\icons\Icon::show('play') . Yii::t('app', 'Execute'), ['view', 'id' => $model->id, 'hash' => $model->hash, 'execute' => 1], ['class' => 'btn btn-success']) ?>     
      <? $controller = Yii::$app->controller->id;
      if (\app\components\mgcms\MgHelpers::getUserModel()->checkAccess($controller, 'save-as-new')):

        ?>
        <?= Html::a(Yii::t('app', 'Save As New'), ['save-as-new', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
      <? endif ?>            
      <? $controller = Yii::$app->controller->id;
      if (\app\components\mgcms\MgHelpers::getUserModel()->checkAccess($controller, 'update')):

        ?>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
      <? endif ?>
      <?
      if (\app\components\mgcms\MgHelpers::getUserModel()->checkAccess($controller, 'delete')):

        ?>
        <?=
        Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ])

        ?>
      <? endif ?>
    </div>
  </div>

  <div class="row">
    <?php
    $gridColumn = [
        'name',
        'query:ntext',
        'params:ntext',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);

    ?>
  </div>

<? if ($result): ?>
    <div class="row">
      

      <div class="col-md-12">
        <h2><?= Yii::t('app', 'Results'); ?></h2>
        <button id="export" class="btn btn-success">export</button>
        <br/><br/>
        <table class="table table-striped table-bordered detail-view dataTable">
            <? foreach ($result as $index => $row): ?>
              <? if ($index === 0): ?>
              <tr>
              <? foreach ($row as $name => $value): ?>
                  <th><?= $name ?></th>
                <? endforeach ?>
              </tr>
              <? endif ?>
            <tr>
            <? foreach ($row as $name => $value): ?>
                <td><?= $value ?></td>
    <? endforeach ?>
            </tr>
  <? endforeach ?>
        </table>
      </div>

    </div>

    <script type="text/javascript">
      $('#export').click(function () {
        var titles = [];
        var data = [];

        /*
         * Get the table headers, this will be CSV headers
         * The count of headers will be CSV string separator
         */
        $('.dataTable th').each(function () {
          titles.push($(this).text());
        });

        /*
         * Get the actual data, this will contain all the data, in 1 array
         */
        $('.dataTable td').each(function () {
          data.push($(this).text());
        });

        /*
         * Convert our data to CSV string
         */
        var CSVString = prepCSVRow(titles, titles.length, '');
        CSVString = prepCSVRow(data, titles.length, CSVString);

        /*
         * Make CSV downloadable
         */
        var downloadLink = document.createElement("a");
        var blob = new Blob(["\ufeff", CSVString]);
        var url = URL.createObjectURL(blob);
        downloadLink.href = url;
        downloadLink.download = "data.csv";

        /*
         * Actually download CSV
         */
        document.body.appendChild(downloadLink);
        downloadLink.click();
        document.body.removeChild(downloadLink);
      });

      /*
       * Convert data array to CSV string
       * @param arr {Array} - the actual data
       * @param columnCount {Number} - the amount to split the data into columns
       * @param initial {String} - initial string to append to CSV string
       * return {String} - ready CSV string
       */
      function prepCSVRow(arr, columnCount, initial) {
        var row = ''; // this will hold data
        var delimeter = ','; // data slice separator, in excel it's `;`, in usual CSv it's `,`
        var newLine = '\r\n'; // newline separator for CSV row

        /*
         * Convert [1,2,3,4] into [[1,2], [3,4]] while count is 2
         * @param _arr {Array} - the actual array to split
         * @param _count {Number} - the amount to split
         * return {Array} - splitted array
         */
        function splitArray(_arr, _count) {
          var splitted = [];
          var result = [];
          _arr.forEach(function (item, idx) {
            if ((idx + 1) % _count === 0) {
              splitted.push(item);
              result.push(splitted);
              splitted = [];
            } else {
              splitted.push(item);
            }
          });
          return result;
        }
        var plainArr = splitArray(arr, columnCount);
        // don't know how to explain this
        // you just have to like follow the code
        // and you understand, it's pretty simple
        // it converts `['a', 'b', 'c']` to `a,b,c` string
        plainArr.forEach(function (arrItem) {
          arrItem.forEach(function (item, idx) {
            row += item + ((idx + 1) === arrItem.length ? '' : delimeter);
          });
          row += newLine;
        });
        return initial + row;
      }
    </script>
<? endif ?>
</div>