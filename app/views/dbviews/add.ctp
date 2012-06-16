<h2>Select a template</h2>
<?php
    foreach ($templates as $name=>$code){
		$id = $name;
        echo "<div class='dragbox' id='dragbox_$id'style='float: left; width: 420px; height: 340px; text-align: center; padding-bottom: 6px;'>";
			echo "<div class='header' style='cursor: default;'>";
				echo "<span>$name</span>";

			echo "</div>";
			echo "<div class='dragbox-content' id='view$id' style='clear: both; width: 400px; height: 300px;'>$code</div>";
        echo $this->Html->link('Select', "/dbviews/add/$dashboard_id/$name", array('style' =>' font-size: 1.2em; '));
        echo "</div>";
    }
?>
