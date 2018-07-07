<textarea class="geturl-textarea" style="width:100%"><?php echo $url; ?></textarea>


<button class="geturl-copy btn btn-default"><?php echo __('Copy to clipboard'); ?></button>
<script type="text/javascript">
    $('.geturl-textarea').focus().select();

    $('.geturl-copy').click(function(){
        $('.geturl-textarea').select();
        var copied = true;
        try{
            document.execCommand('copy');
        }catch(e){
            copied = false;
        }
        if(copied){
            $(this).text('<?php echo __('Copied!'); ?>');
            $(this).addClass('btn-success');
        }else{
            $(this).text('<?php echo __('Could not copy!'); ?>');
            $(this).addClass('btn-danger');
        }
        return false;
    })
</script>