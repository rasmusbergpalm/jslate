<style type="text/css">
    .CodeMirror {
        height: auto;
        width: 100%;
    }
    .preview-outer {
        /*position: fixed;
        left: 50%;
        height: 600px;*/
    }
</style>
<h2>Edit widget</h2>
<div class="form-inline">
    <label class="checkbox"><input id="autosave" type="checkbox" checked="checked" onclick="$('#save').toggle();"/> Auto-save</label>
    <button id="save" class="btn btn-small" style="display: none;" onclick="updateData()">Save</button>
</div>
<?php echo $this->Form->create('Widget');?>
<?php echo $this->Form->input('id', array('label'=>false)); ?>
<div class="row">
    <div class="span12">
        <h3>
            Data
            <small>
                <a class="data-toggle" href="javascript:$('.data-toggle').toggle();">Hide</a>
                <a class="data-toggle" style="display: none;" href="javascript:$('.data-toggle').toggle();">Show</a>
            </small>
        </h3>
    </div>
    <div class="span6 data-toggle">
        <span>Query</span>
        <?php
            echo $this->Form->textarea('query');
        ?>
    </div>
    <div class="span6 preview-outer data-toggle">
        <span>Result</span>
        <textarea id="preview-data" class="well"></textarea>
    </div>
</div>
<div class="row">
    <div class="span12"><h3>Code</h3></div>
    <div class="span6">
        <?php echo $this->Form->input('code', array('id'=>'code', 'label'=>false)); ?>
    </div>
    <div class="span6 preview-outer">
        <div id="preview-code" class="well">
            Loading...
        </div>
    </div>
</div>
<?php echo $this->Form->end();?>

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
var opts = {
    mode: 'javascript',
    tabMode: 'indent',
    lineNumbers: true,
    matchBrackets: true,
    theme: 'ambiance',
    indentUnit: 4
};
var result = CodeMirror.fromTextArea(document.getElementById('preview-data'), $.extend({}, opts, {readOnly: true}));
var query = CodeMirror.fromTextArea(document.getElementById('WidgetQuery'), opts);
var code = CodeMirror.fromTextArea(document.getElementById('code'), $.extend({}, opts, {
    mode: 'text/html',
    extraKeys: {
        "Ctrl-Space": showAutocomplete
    }
}));

function autosave(fn){
    if ($('#autosave').is(':checked')) {
        clearTimeout(delay);
        delay = setTimeout(fn, 1000);
    }
}

function updateData() {
    $.post("<?php echo $this->Html->url(array('controller'=>'sources','action'=>'query', $this->data['Widget']['source_id'])); ?>", {query: query.getValue()},
        function(data){
            document.data = data;
            result.setValue(JSON.stringify(data, null, '\t'));
            updateCode();
        }, 'json'
    ).fail(function(jqXHR, textStatus, errorThrown){
        result.setValue(JSON.stringify(jqXHR.responseJSON, null, '\t'));
    });
}

function updateCode(){
    code.save();
    $.post("<?php echo $this->Html->url(array('controller'=>'widgets','action'=>'edit', $this->data['Widget']['id'])); ?>", $("#WidgetEditForm").serialize(), function(){
        $('#preview-code').html(code.getValue().replace(/\$\{wid\}/g, 'id_1'));
    });
}

query.on('change', function(){autosave(updateData)});
code.on('change', function(){autosave(updateCode)});

setTimeout(updateData, 300);


</script>