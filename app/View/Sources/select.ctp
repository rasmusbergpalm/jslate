<h2>Select a data source</h2>
<?php
echo '<div class="btn-group">';
echo '<button class="btn btn-success dropdown-toggle" data-toggle="dropdown">Select <span class="caret"></span></button>';
echo '<ul class="dropdown-menu">';
foreach($sources as $id => $name){
    echo '<li>'.$this->Html->link($name, "/widgets/add/$id").'</li>';
}
echo '</ul>';
echo '</div>';
echo " or ";
echo '<div class="btn-group">';
echo '<button class="btn dropdown-toggle" data-toggle="dropdown">Create new <span class="caret"></span></button>';
echo '<ul class="dropdown-menu">';
foreach($types as $type){
    echo '<li>'.$this->Html->link($type, "/sources/add/$type").'</li>';
}
echo '</ul>';
echo '</div>';
?>
