<?php
echo $this->Form->create('Query');
echo $this->Form->input('id');
echo $this->Form->textarea('Queryproperty.query', array('label'=>'SQL query'));
echo $this->Form->end();
?>
<script type="text/javascript">
    var opts = {
        mode: 'javascript',
        tabMode: 'indent',
        lineNumbers: true,
        matchBrackets: true,
        theme: 'ambiance',
        indentUnit: 4
    };
    var query = CodeMirror.fromTextArea(document.getElementById('QuerypropertyQuery'), opts);
    query.on('change', function(){
        query.save();
    })
</script>