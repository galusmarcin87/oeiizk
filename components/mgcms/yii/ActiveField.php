<?php
namespace app\components\mgcms\yii;

use Yii;
use dosamigos\ckeditor\CKEditor;
use app\extensions\mgcms\yii2TinymceWidget\TinyMce;
use kartik\file\FileInput;
use \app\components\mgcms\MgHelpers;
use kartik\switchinput\SwitchInput;
use \yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use app\models\mgcms\db\File;

class ActiveField extends \yii\widgets\ActiveField
{

  public function datePicker()
  {
    return $this->widget(\kartik\datecontrol\DateControl::classname(), [
            'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
            'saveFormat' => 'php:Y-m-d',
            'ajaxConversion' => true,
            'options' => [
                'pluginOptions' => [
                    'placeholder' => Yii::t('app', Yii::t('app', 'Choose ' . $this->model->getAttributeLabel($this->attribute))),
                    'autoclose' => true
                ]
            ],
    ]);
  }

  public function dateTimePicker()
  {
    return $this->widget(\kartik\widgets\DateTimePicker::classname(), [
            'options' => [
                'pluginOptions' => [
                    'autoclose' => true
                ],]
    ]);
  }

  public function ckeditor()
  {
    return $this->widget(CKEditor::className(), [
//            'options' => ['rows' => 6],
    ]);
  }

  /**
   * 
   * @param array $options
   */
  public function tinyMce($options = [])
  {
    return $this->widget(TinyMce::className(),
            [
                'options' => ['rows' => 6],
                'language' => substr(Yii::$app->language, 0, 2),
                'clientOptions' => \yii\helpers\ArrayHelper::merge($options,
                    [
                        'plugins' => [
                            "advlist autolink lists link charmap print preview anchor",
                            "searchreplace visualblocks code fullscreen",
                            "insertdatetime media table contextmenu paste",
                            "image imagetools visualchars textcolor",
                            "autosave colorpicker hr nonbreaking template"
                        ],
                        'toolbar1' => "undo redo | styleselect fontselect fontsizeselect forecolor backcolor | bold italic",
                        'toolbar2' => "fullscreen | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
                        'image_advtab' => true,
                        'visualblocks_default_state' => false,
                        'relative_urls' => false,
                        'remove_script_host' => false,
                        'convert_urls' => true,
                        'images_upload_url' => MgHelpers::createUrl(['backend/mgcms/file/uploadinstorage']),
                        // here we add custom filepicker only to Image dialog
                        'file_picker_types' => 'image',
                        // and here's our custom image picker
                        'file_picker_callback' => new \yii\web\JsExpression("function(callback, value, meta) {
                  var input = document.createElement('input');
                  input.setAttribute('type', 'file');
                  input.setAttribute('accept', 'image/*');

                  input.onchange = function() {
                      var file = this.files[0];

                      var reader = new FileReader();
                      reader.readAsDataURL(file);
                      reader.onload = function () {
                          var id = 'blobid' + (new Date()).getTime();
                          var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                          var blobInfo = blobCache.create(id, file, reader.result);
                          blobCache.add(blobInfo);

                          // call the callback and populate the Title field with the file name
                          callback(blobInfo.blobUri(), { title: file.name });
                      };
                  };
                  input.click();
              }")
                ]),
    ]);
  }

  public function fileInputPretty($options = [], $pluginOptions = [])
  {
    return $this->widget(FileInput::classname(), [
            'options' => $options,
            'pluginOptions' => $pluginOptions,
    ]);
  }

  public function fileInputRelatedModal()
  {
    ob_start();
    echo '<label class="control-label">' . $this->model->getAttributeLabel($this->attribute) . '</label><div class="form-group">';
    Modal::begin([
        'id' => 'RelatedModal_'.$this->attribute,
        'header' => $this->model->getAttributeLabel($this->attribute),
        'footer' => '<button type="button" class="btn btn-success" data-dismiss="modal">' . Yii::t('app', 'Save') . '</button>',
        'closeButton' => ['id' => 'close-success'],
        'clientOptions' => ['backdrop' => 'static', 'keyboard' => false],
        'toggleButton' => [
            'label' => Yii::t('app', 'Open popup'), 'class' => 'btn btn-default'
        ],
    ]);

    $pluginOptions = [];
    $modelAttributeHtmlId = MgHelpers::getModelAttributeHtmlId($this->model, $this->attribute);
    Yii::$app->view->registerJs("jQuery('#$modelAttributeHtmlId').on('filepredelete', function (event) {
      jQuery('#".$modelAttributeHtmlId."[type=hidden]').val('');
    });", \yii\web\View::POS_LOAD);
    if ($this->model->{$this->attribute}) {
      $fileId = $this->model->{$this->attribute};
      $file = File::findOne($fileId);
      $pluginOptions = [
          'initialPreviewAsData' => $file->isImage() ? true : false,
          'overwriteInitial' => true,
      ];
      if ($file) {
        $fileMimeFragments = explode('/', $file->mime);
        $pluginOptions['initialPreview'][] = $file->isImage() ? \yii\helpers\Url::to($file->linkUrl, true) : $file->link;
        $pluginOptions['initialPreviewConfig'][] = [
            'url' => '/site/file-related-fake-delete',
            'type' => $file->isImage() ? 'image' : 'object',
        ];
      }
    }
    echo $this->fileInputPretty(['allowMultiple' => false], $pluginOptions)->label(false);
    echo $this->hiddenInput();
    Modal::end();
    echo '</div>';
    return ob_get_clean();
  }

  public function switchInput($options = [])
  {
    return $this->widget(SwitchInput::classname(),
            ArrayHelper::merge($options,
                [
                    'type' => SwitchInput::CHECKBOX,
                    'pluginOptions' => [
                        'onText' => Yii::t('app', 'Yes'),
                        'offText' => Yii::t('app', 'No'),
                ]])
    );
  }

  public function dropdownFromSettings($name, $empty = false)
  {
    $options = [];
    if ($empty) {
      $options['prompt'] = '';
    }
    return $this->dropDownList(MgHelpers::getSettingOptionArray($name), $options);
  }
}
