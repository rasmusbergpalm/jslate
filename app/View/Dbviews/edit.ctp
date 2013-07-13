<style type="text/css">
    .CodeMirror {
        height: auto;
        width: 100%;
    }
    #preview_outer {
        position: fixed;
        left: 50%;
        height: 600px;
    }
</style>
<h2>Edit widget</h2>
<div class="form-inline">
    <label class="checkbox"><input id="autosave" type="checkbox" checked="checked" onclick="$('#save').toggle();"/> Auto-save</label>
    <button id="save" class="btn btn-small" style="display: none;" onclick="updatePreviewAndSave()">Save</button>
</div>

<div class="row">
    <div class="span6">
        <span>Code</span>
        <?php echo $this->Form->create('Dbview');?>
        <?php
        echo $this->Form->input('id', array('label'=>false));
        echo $this->Form->input('code', array('id'=>'code','label'=>false));
        ?>
        <?php echo $this->Form->end();?>
    </div>
    <div id="preview_outer" class="span6">
        <span>Preview</span>
        <div id="preview" class="well">
            Loading...
        </div>
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
    if ($('#autosave').is(':checked')) {
        clearTimeout(delay);
        delay = setTimeout(updatePreviewAndSave, 1000);
    }
});


function updatePreviewAndSave() {
    code.save();
    $.post("<?php echo $this->Html->url(array('controller'=>'dbviews','action'=>'edit', $this->data['Dbview']['id'])); ?>", $("#DbviewEditForm").serialize(), function(){
        $('#preview').html(code.getValue().replace(/\$\{wid\}/g, 'id_1'));
    });
}
setTimeout(updatePreviewAndSave, 300);

</script>