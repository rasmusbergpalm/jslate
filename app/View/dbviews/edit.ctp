<style type="text/css">
    #code_outer {
        float: left;
        width: 50%;
        border-right: 2px dashed gray;
    }
    .CodeMirror {
        height: auto;
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
<span id="autosaved">Auto-save <input id="autosaved_check" type="checkbox"/></span>
<input type="button" onclick="updatePreviewAndSave()" value="Save"/>

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

function showAutocomplete(cm) {
    var state = cm.getStateAfter(cm.getCursor().line);
    if ( state.localMode && state.localMode.name == 'javascript') {
        CodeMirror.showHint(cm, CodeMirror.javascriptHint);
    } else {
        CodeMirror.showHint(cm, CodeMirror.htmlHint);
    }
}

var delay;

var code = CodeMirror.fromTextArea(document.getElementById('code'), {
        mode: 'text/html',
        tabMode: 'indent',
        lineNumbers: true,
        matchBrackets: true,
        theme: 'ambiance',
        indentUnit: 4,
        extraKeys: {
            "Ctrl-Space": showAutocomplete
        }
    });

code.on('change', function() {
        if ($('#autosaved_check').is(':checked')) {
            clearTimeout(delay);
            delay = setTimeout(updatePreviewAndSave, 1000);
        }
    });


function updatePreviewAndSave() {
    code.save();
    $.post("<?php echo $this->Html->url(array('controller'=>'dbviews','action'=>'edit', $this->data['Dbview']['id'])); ?>", $("#DbviewEditForm").serialize());
    $('#preview').html(code.getValue().replace(/\$\{wid\}/g, '1'));
}
setTimeout(updatePreviewAndSave, 300);

</script>