<?php
use yii\helpers\Url;

?>
<script>
    function addRow<?= $class ?>() {
        var data = $('#add-<?= $relID?> :input').serializeArray();
        data.push({name: '_action', value : 'add'});
        $.ajax({
            type: 'POST',
            url: '<?php echo Url::to(['add-'.$relID]); ?>',
            data: data,
            headers: { 'X-CSRF-Token': document.getElementsByTagName('meta')['csrf-token'].content},
            success: function (data) {
                $('#add-<?= $relID?>').html(data);
            }
        });
    }
    function delRow<?= $class ?>(id) {
        if($('#deletedRelations').length > 0){
          $('#deletedRelations').val($('#deletedRelations').val()+','+'<?= $class ?>')
        }else{
          $('#add-<?= $relID?> tr[data-key=' + id + ']').closest('form').append('<input type="hidden" name="deletedRelations" value="<?= $class ?>" id="deletedRelations"/>');
        }
        $('#add-<?= $relID?> tr[data-key=' + id + ']').remove();
    }
</script>
