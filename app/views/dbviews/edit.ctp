<div class="dbviews form">
<?php echo $this->Form->create('Dbview');?>
	<fieldset>
		<legend><?php __('Edit Dbview'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('code', array('id'=>'DbviewCode'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Dbview.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Dbview.id'))); ?></li>
	</ul>
</div>
<script type="text/javascript">
    $('#DbviewCode').ready(function(){
        window.setTimeout(function(){
            var myCodeMirror = CodeMirror.fromTextArea(document.getElementById("DbviewCode"), {lineNumbers: true, matchBrackets: true, indentUnit: 4});
        }, 500);

    });
    
</script>