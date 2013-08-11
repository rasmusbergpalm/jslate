<h2>Select a template</h2>
<?php
foreach ($templates as $name => $code){
    $id = $name;
    $code = str_replace('${wid}', "id_".uniqid(), $code);
    echo "<div id='$id' style='float: left; margin: 24px; text-align: center;'>";
    echo "<h4>".$this->Html->link($name, "/widgets/add/$name")."</h4>";

    echo "<div class='well' id='view$id' style='overflow: hidden; clear: both; width: 420px; height: 340px;'>$code</div>";
    echo "</div>";
}
?>