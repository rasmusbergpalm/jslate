<?php
    $i=0;
    foreach ($templates as $name=>$code){
        $id = $i;

        echo "<div class='dragbox' id='dragbox_$id'
        style='float: left; width: 420px; height: 340px;'>
        <div class='header' style='cursor: default;'>
        <span>$name</span>";
        echo $this->Html->link('Add', "/dbviews/add/$dashboard_id/$name", array('style' =>'float: right; margin-left: 10px;'));
        echo "</div>
        <div class='dragbox-content' id='view$id' style='clear: both; width: 400px; height: 300px;'>Loading...</div>
        </div>";
        $i++;
    }
?>
<script type='text/javascript'>
<?php
    $i=0;
    foreach ($templates as $name=>$code){
        $id = $i;
        
        echo "$('#view$id').ready(function(){";
        echo "var viewid = 'view$id';";
        echo "try{";
        echo "$code";
        echo "}catch(e){";
        echo "$('#view$id').text(e.toString());";
        echo "}";
        
        echo "});";
        
        $i++;
    }
?>
</script>