<div class="widgets form" style="width: 900px; height: 600px;">
<?php echo $this->Form->create('Widget');?>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('code', array('id'=>'WidgetCode'));
	?>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<script type="text/javascript">
    $('#WidgetCode').ready(function(){
        window.setTimeout(function(){
            var myCodeMirror = CodeMirror.fromTextArea(document.getElementById("WidgetCode"), {lineNumbers: true, matchBrackets: true, indentUnit: 4});
        }, 500);

    });
    
</script>