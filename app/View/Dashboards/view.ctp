<?php
$zid=1;
foreach ($dashboard['Widget'] as $widget){
    $zid++;
    $id = $widget['id'];
    $wid = 'id_'.uniqid();
    $code = str_replace('${wid}', $wid, $widget['code']);
    $style = $user == null ? 'cursor:auto' : '';
    echo "<textarea id='code$id' style='display: none;'>$code</textarea>";
    echo "<div class='well dragbox' id='dragbox_$id' style='z-index: $zid; left: ".$widget['left']."px; top: ".$widget['top']."px; width: ".($widget['width'])."px; height: ".($widget['height'])."px;'>";
    echo "<div class='header' style='$style'>";
    echo "<span>&nbsp;";
    if($user != null){
        echo $this->Html->link('delete', "/widgets/delete/$id", array('style' =>'float: right; margin-left: 10px;'), 'Are you sure you want to remove this widget?');
        echo $this->Html->link('edit', "/widgets/edit/$id", array('style' =>'float: right;'));
    }
    echo "</span>";
    echo "</div>";
    echo "<div class='dragbox-content' id='view$id' style='clear: both; width: ".($widget['width'])."px; height: ".($widget['height']-8)."px;'>$code</div>";
    echo "</div>";
}
?>
<?php if($user != null): ?>
<script type='text/javascript'>
    $(function(){
        $(".dragbox").draggable({
            handle: ".header",
            grid: [50, 50],
            stop: function(event, ui){
                var id = ui.helper.context.id.split('_')[1];
                $.ajax({
                    type: "POST",
                    url: "<?php echo $this->Html->url('/widgets/update/')?>"+id,
                    data: {data:{left: ui.position.left, top: ui.position.top}},
                    success: function(msg){
                    }
                });
            }
        });
        $(".dragbox").resizable({
            grid: [50, 50],
            stop: function(event, ui){

                var id = ui.helper.context.id.split('_')[1];
                $.ajax({
                    type: "POST",
                    url: "<?php echo $this->Html->url('/widgets/update/')?>"+id,
                    data: {data:{width: ui.size.width, height: ui.size.height}},
                    success: function(msg){
                        $('#view'+id).height((ui.size.height-8)+'px')
                        $('#view'+id).width((ui.size.width)+'px')
                        $('#view'+id).html($('#code'+id).val())
                    }
                });
            }
        });
    });
</script>
<?php endif; ?>
