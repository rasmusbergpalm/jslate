<h2>Select a template</h2>
<?php
foreach ($templates as $name=>$code){
    $id = $name;
    $code = str_replace('${wid}', "id_".uniqid(), $code);
    echo "<div id='$id' style='float: left; width: 420px; height: 340px; margin: 24px; text-align: center;'>";
    echo "<h4>".$this->Html->link($name, "/dbviews/add/$dashboard_id/$name")."</h4>";

    echo "<div class='well' id='view$id' style='clear: both; height: 300px;'>$code</div>";
    echo "</div>";
}
?>
