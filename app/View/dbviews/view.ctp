<div class="dbviews form" style="width: 900px; height: 600px;">
<?php echo $this->Form->create('Dbview');?>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('code', array('id'=>'DbviewCode'));
	?>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<script type="text/javascript">
    $('#DbviewCode').ready(function(){
        window.setTimeout(function(){
            var myCodeMirror = CodeMirror.fromTextArea(document.getElementById("DbviewCode"), {lineNumbers: true, matchBrackets: true, indentUnit: 4});
        }, 500);

    });
    
</script>