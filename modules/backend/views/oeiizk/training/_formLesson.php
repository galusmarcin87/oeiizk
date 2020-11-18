<div class="form-group" id="add-lesson">
  <?php
  use kartik\grid\GridView;
  use kartik\builder\TabularForm;
  use yii\data\ArrayDataProvider;
  use yii\helpers\Html;
  use yii\widgets\Pjax;
  use app\components\mgcms\OeiizkHelpers;
  use app\models\mgcms\db\User;

$model = new \app\models\db\Lesson;

  $dataProvider = new ArrayDataProvider([
      'allModels' => $row,
      'pagination' => [
          'pageSize' => -1
      ]
  ]);
  echo TabularForm::widget([
      'dataProvider' => $dataProvider,
      'formName' => 'Lesson',
      'checkboxColumn' => false,
      'actionColumn' => false,
      'attributeDefaults' => [
          'type' => TabularForm::INPUT_TEXT,
      ],
      'attributes' => [
          "id" => ['type' => TabularForm::INPUT_HIDDEN_STATIC, 'columnOptions' => ['hidden' => true]],
          'date_start' => [
              'type' => TabularForm::INPUT_WIDGET,
              'label' => $model->getAttributeLabel('date_start'),
              'widgetClass' => \kartik\widgets\DateTimePicker::className(),
              'options' => [
                  'disabled' => OeiizkHelpers::isRole(User::ROLE_LECTOR),
                  'pluginOptions' => [
                      'format' => 'yyyy-mm-dd hh:ii:ss',
                      'autoclose' => true
                  ],]
          ],
          'date_end' => [
              'type' => TabularForm::INPUT_WIDGET,
              'label' => $model->getAttributeLabel('date_end'),
              'widgetClass' => \kartik\widgets\DateTimePicker::classname(),
              'options' => [
                  'disabled' => OeiizkHelpers::isRole(User::ROLE_LECTOR),
                  'pluginOptions' => [
                      'format' => 'yyyy-mm-dd hh:ii:ss',
                      'autoclose' => true,
                  ],]
          ],
          'lab_id' => [
              'label' => $model->getAttributeLabel('lab_id'),
              'type' => TabularForm::INPUT_WIDGET,
              'widgetClass' => \kartik\widgets\Select2::className(),
              'options' => [
                  'data' => \yii\helpers\ArrayHelper::map(\app\models\db\Lab::find()->orderBy('name')->all(), 'id', 'shorterName'),
                  'options' => [
                      'placeholder' => Yii::t('app', 'Choose Lab'),
                      'disabled' => OeiizkHelpers::isRole(User::ROLE_LECTOR)
                  ],
              ],
              'columnOptions' => ['width' => '200px']
          ],
          'hours_count' => [
              'type' => TabularForm::INPUT_TEXT,
              'label' => $model->getAttributeLabel('hours_count'),
              'options' => ['disabled' => OeiizkHelpers::isRole(User::ROLE_DOS)]],
          'subject' => [
              'type' => TabularForm::INPUT_TEXTAREA,
              'label' => $model->getAttributeLabel('subject'),
              'options' => ['disabled' => OeiizkHelpers::isRole(User::ROLE_DOS),'rows'=>10,'cols'=>100],   
              'columnOptions' => ['hidden' => OeiizkHelpers::isRole(User::ROLE_DOS)]
          ],
          'del' => [
              'type' => 'raw',
              'label' => '',
              'value' => function($model, $key) {
                return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#',
                        ['title' => Yii::t('app', 'Delete'), 'onClick' => 'delRowLesson(' . $key . '); return false;', 'id' => 'lesson-del-btn']);
              },
          ],
          'edit' => [
              'type' => 'raw',
              'label' => '',
              'value' => function($model, $key) {
                return isset($model) && isset($model['id']) ? Html::a('<i class="glyphicon glyphicon-edit"></i>',
                        ['oeiizk/lesson/update', 'id' => $model['id']]) : false;
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
              !OeiizkHelpers::isRole(User::ROLE_LECTOR) ?
                  Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'Add Lesson'),
                      ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowLesson()']) . ' ' .
                  (!empty($parentModel) ?
                      Html::a('<i class="glyphicon glyphicon-cog"></i>' . Yii::t('app', 'Generuj cykliczne zajęcia'),
                          ['oeiizk/lesson/generate-lessons', 'id' => $parentModel->id],
                          ['class' => 'btn btn-success kv-batch-create']) : '') :
                  "",
          ]
      ]
  ]);
  echo "    </div>\n\n";

  ?>

