<?php

    foreach ($dashboard['Dbview'] as $dbview){
        //debug($dbview);
        $id = $dbview['id'];

        echo "<div class='dragbox' id='dragbox_$id'
        style='position: absolute; z-index: $id; left: ".$dbview['left']."px; top: ".$dbview['top']."px; width: ".($dbview['width'])."px; height: ".($dbview['height'])."px;'>
        <div class='header'>
        <span>&nbsp;</span>";
        echo $this->Html->link('X', "/dbviews/delete/$id", array('style' =>'float: right; margin-left: 10px;'));
        echo $this->Html->link('edit', "/dbviews/edit/$id", array('style' =>'float: right;', 'class' => 'editlink'));

        
        echo "</div>
        <div class='dragbox-content' id='view$id' style='clear: both; width: ".($dbview['width']-10)."px; height: ".($dbview['height']-40)."px;'>Loading...</div>
        </div>";
    }
    ?>
    <script type='text/javascript'>
    <?php
    foreach ($dashboard['Dbview'] as $dbview){
        $id = $dbview['id'];
        $code = $dbview['code'];
        echo "$('#view$id').ready(function(){";
        echo "var viewid = 'view$id';";
        echo "$code";
        echo "});";
    }
    ?>
        $(function(){
            $('.editlink').colorbox({width:"80%", height:"100%"});

            $(".dragbox").draggable({
                handle: ".header",
                grid: [20, 20],
                stop: function(event, ui){
                    console.log(ui);
                    var id = ui.helper.context.id.split('_')[1];
                    $.ajax({
                        type: "POST",
                        url: "<?php echo $this->Html->url('/dbviews/update/')?>"+id,
                        data: {data:{left: ui.position.left, top: ui.position.top}},
                        success: function(msg){
                            console.log(msg);
                        }
                    });
                }
            });
            $(".dragbox").resizable({
                stop: function(event, ui){
                    
                    var id = ui.helper.context.id.split('_')[1];
                    $.ajax({
                        type: "POST",

                        url: "<?php echo $this->Html->url('/dbviews/update/')?>"+id,
                        data: {data:{width: ui.size.width, height: ui.size.height}},
                        success: function(msg){
                            console.log(msg);
                        }
                    });
                }
            });
        });
    </script>
