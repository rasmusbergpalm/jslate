<style type="text/css">
    #code_outer {
        float: left;
        width: 50%;
        border-right: 2px dashed gray;
    }
    .CodeMirror-scroll {
        height: auto;
        overflow-y: hidden;
        overflow-x: auto;
        width: 100%;
    }
    #preview_outer {
        width: 49%;
        position: fixed;
        margin-top:-16px;
        left: 51%;
        height: 600px;
        border: 1px solid black;
    }
</style>
<h2>Create your widget</h2>
<span id="autosaved">Auto-save is ON</span>

<div style='width:50%; text-align: center;'>Code</div>
<div id='code_outer'>
<?php echo $this->Form->create('Dbview');?>
    <?php
        echo $this->Form->input('id', array('label'=>false));
        echo $this->Form->input('code', array('id'=>'code','label'=>false));
    ?>
<?php echo $this->Form->end();?>
</div>
<div id="preview_outer">
    <div style='width:100%; text-align: center;'>Preview</div>
    <div id="preview">
        Loading...
    </div>
</div>

<script type="text/javascript">
    var delay;

    var code = CodeMirror.fromTextArea(document.getElementById('code'), {
        mode: 'text/html',
        tabMode: 'indent',
        lineNumbers: true,
        matchBrackets: true,
        theme: 'ambiance',
        indentUnit: 4,
        onChange: function() {
            clearTimeout(delay);
            delay = setTimeout(updatePreviewAndSave, 1000);
        }
    });

    function updatePreviewAndSave() {
        code.save();
        $.post("<?php echo $this->Html->url(array('controller'=>'dbviews','action'=>'edit', $this->data['Dbview']['id'])); ?>", $("#DbviewEditForm").serialize());
        $('#preview').html(code.getValue());
    }
    setTimeout(updatePreviewAndSave, 300);
    
</script>