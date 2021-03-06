<div class="form-group" id="add-poll-poll-question">
  <?php
  use kartik\grid\GridView;
  use kartik\builder\TabularForm;
  use yii\data\ArrayDataProvider;
  use yii\helpers\Html;
  use yii\widgets\Pjax;

$dataProvider = new ArrayDataProvider([
      'allModels' => $row,
      'pagination' => [
          'pageSize' => -1
      ]
  ]);
  echo TabularForm::widget([
      'dataProvider' => $dataProvider,
      'formName' => 'PollPollQuestion',
      'checkboxColumn' => false,
      'actionColumn' => false,
      'attributeDefaults' => [
          'type' => TabularForm::INPUT_TEXT,
      ],
      'attributes' => [
          "poll_id" => ['type' => TabularForm::INPUT_HIDDEN_STATIC, 'columnOptions'=>['hidden'=>true]],
          'order' => ['type' => TabularForm::INPUT_TEXT,'label' => Yii::t('app','Order'),'columnOptions' => ['width' => '200px']],
          'poll_question_id' => [
              'label' => Yii::t('app', 'Question'),
              'type' => TabularForm::INPUT_WIDGET,
              'widgetClass' => \kartik\widgets\Select2::className(),
              'options' => [
                  'data' => \yii\helpers\ArrayHelper::map(\app\models\db\PollQuestion::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                  'options' => ['placeholder' => Yii::t('app', 'Choose question')],
              ],
          ],
          
          'del' => [
              'type' => 'raw',
              'label' => '',
              'value' => function($model, $key) {
                return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' => Yii::t('app', 'Delete'), 'onClick' => 'delRowPollPollQuestion(' . $key . '); return false;', 'id' => 'poll-poll-question-del-btn']);
              },
          ],
      ],
      'gridSettings' => [
          'panel' => [
              'heading' => false,
              'type' => GridView::TYPE_DEFAULT,
              'before' => false,
              'footer' => false,
              'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'Add Question'), ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowPollPollQuestion()']) .
              ' ' . Html::a('<i class="glyphicon glyphicon-plus"></i>Dodaj pytanie indywidualne', isset($model) && $model->id ? ['oeiizk/poll-question/add-individual-question', 'id' => $model->id] : 'javascript:alert("Aby dodać pytanie indywidualne, najpierw musisz stworzyć ankietę")', ['class' => 'btn btn-success kv-batch-create']),
          ]
      ]
  ]);
  echo "    </div>\n\n";

  ?>

