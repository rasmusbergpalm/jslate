<div class="templates index">
	<h2>Templates</h2>
	<table cellpadding="0" cellspacing="0" style="width: 800px;">
	<tr>
			<th>Name</th>
                        <th>Author</th>
                        <th>Description</th>
                        
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($templates as $template):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $template['Template']['name']; ?></td>
                <td><?php echo $template['Template']['author']; ?></td>
                <td><?php echo $template['Template']['description']; ?></td>
                <?php //$id = str_replace('.','', $name); ?>
                
		<td class="actions">
                        <?php $name = $template['Template']['name']; ?>
			<?php echo "<a class='cb' href='#".$template['Template']['name']."'>View</a>"; ?>
			<?php echo $this->Html->link(__('Use', true), array('action' => 'add', $dashboard_id,  $template['Template']['name'])); ?>
		</td>
	</tr>
        <?php endforeach ?>
	</table>
        <?php
            foreach ($templates as $template){
                echo "<div style='display: none;'><pre id='".$template['Template']['name']."'>".$template['Template']['code']."</pre></div>";
            }
        ?>
        <script type="text/javascript">
            $(function(){
            
            $('.cb').colorbox({width: '80%', height: '80%', inline: true});
            
            });
        </script>
</div>

