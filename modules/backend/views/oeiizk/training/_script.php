<?php

use yii\helpers\Url;

?>
<script>
  function addRow<?= $class ?>() {
    var data = [];
    var data = $('#add-<?= $relID?> :input').serializeArray();
    data.push({ name: '_action', value: 'add' });
    $.ajax({
      type: 'POST',
      url: '<?php echo Url::to(['add-' . $relID]); ?>',
      data: data,
      success: function (data) {
        //var oldTbody = $('#add-<?//= $relID?>// tbody').html();
        //var maxIndex = 0;
        //$('.kv-tabform-row').each(function () {
        //  if ($(this).data('key') > maxIndex) {
        //    maxIndex = $(this).data('key');
        //  }
        //});
        //maxIndex++;
        //data = data.replace(/\[0\]/g, '[' + maxIndex + ']')
        //            .replace('seq="0">1</td>','seq="0">'+(maxIndex+1)+'</td>')
        //            .replace(/\(0\)/g, '(' + maxIndex + ')');
        //data = data.replace('data-key="0"', 'data-key="' + maxIndex + '"');
        //data = data.replace(/-0-/g, '-' + maxIndex + '-');
        //
        //var newRecord = $(data).find('tbody').html();
        $('#add-<?= $relID?>').html(data);
      },
    });
  }

  function delRow<?= $class ?>(id) {
    if ($('#deletedRelations').length > 0) {
      $('#deletedRelations').val($('#deletedRelations').val() + ',' + '<?= $class ?>');
    }
    else {
      $('#add-<?= $relID?> tr[data-key=' + id + ']').
        closest('form').
        append('<input type="hidden" name="deletedRelations" value="<?= $class ?>" id="deletedRelations"/>');
    }
    $('#add-<?= $relID?> tr[data-key=' + id + ']').remove();
  }
</script>
