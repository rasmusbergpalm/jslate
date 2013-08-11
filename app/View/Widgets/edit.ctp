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
<script type="text/javascript">
    var opts = {
        mode: 'javascript',
        tabMode: 'indent',
        lineNumbers: true,
        matchBrackets: true,
        theme: 'ambiance',
        indentUnit: 4
    };
</script>
<h2>Edit widget</h2>
<div class="form-inline">
    <label class="checkbox"><input id="autosave" type="checkbox" checked="checked" onclick="$('#save').toggle();"/> Auto-save</label>
    <button id="save" class="btn btn-small" style="display: none;" onclick="updateData()">Save</button>
</div>

<div class="row">
    <div class="span12">
        <h3>
            Data sources
            <small>
                <a class="data-toggle" href="javascript:$('.data-toggle').toggle();">Hide</a>
                <a class="data-toggle" style="display: none;" href="javascript:$('.data-toggle').toggle();">Show</a>
            </small>
        </h3>
    </div>
</div>
<div class="row data-toggle">
    <div class="span12 form-inline">
        <?php echo $this->Form->create('Query', array('url'=>'/queries/add', 'id'=>'QueryAddForm'));?>
        <?php echo $this->Form->hidden('widget_id', array('value'=>$this->request->data['Widget']['id'])); ?>
        <?php echo $this->Form->input('source_id', array('label'=>'Data source', 'onchange'=>'$("#QueryAddForm").submit();', 'div'=>false, 'class'=>'form-inline','empty'=>'Select...')); ?>
        or
        <div class="btn-group">
            <button class="btn dropdown-toggle" data-toggle="dropdown">Create new <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <?php
                foreach ($types as $type) {
                    echo '<li>' . $this->Html->link($type, "/sources/add/$type") . '</li>';
                }
                ?>
            </ul>
        </div>
        <?php echo $this->Form->end();?>
    </div>
</div>
<?php if(!empty($this->request->data['Query']['id'])): ?>
    <div class="row data-toggle">
        <div class="span6">
            <span>Query</span>
            <span id="query-form"></span>
        </div>
        <div class="span6 preview-outer">
            <span>Result</span>
            <textarea id="preview-data" class="well"></textarea>
        </div>
        <script type="text/javascript">
            var result = CodeMirror.fromTextArea(document.getElementById('preview-data'), $.extend({}, opts, {readOnly: true}));

            function updateData() {
                $.post("<?php echo $this->Html->url(array('controller'=>'queries', 'action'=>'edit', $this->data['Query']['id'])); ?>", $('#QueryEditForm').serialize(), function(){
                    $.post("<?php echo $this->Html->url(array('controller'=>'queries', 'action'=>'query', $this->data['Query']['id'])); ?>", null,
                        function(data){
                            console.log(data);
                            document.data = data;
                            result.setValue(JSON.stringify(data, null, '\t'));
                            $(document).trigger('data-updated');
                        }, 'json'
                    ).fail(function(jqXHR, textStatus, errorThrown){
                            if(typeof jqXHR.responseJSON !== "undefined"){
                                result.setValue(JSON.stringify(jqXHR.responseJSON, null, '\t'));
                            }else{
                                result.setValue(jqXHR.responseText);
                            }
                    });
                });
            }

            $.get("<?php echo $this->Html->url('/queries/edit/'.$this->request->data['Query']['id']); ?>", null, function(view){
                $('#query-form').html(view);
                $('#QueryEditForm').submit(function(){
                    autosave(updateData)
                    return false;
                });
                $('#QueryEditForm').on('keyup', function(){
                    $('#QueryEditForm').submit();
                });
            });

        </script>
    </div>
<?php endif; ?>

<?php echo $this->Form->create('Widget');?>
<?php echo $this->Form->input('id', array('label'=>false)); ?>
<div class="row">
    <div class="span12"><h3>Display</h3></div>
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

function updateCode(){
    code.save();
    $.post("<?php echo $this->Html->url(array('controller'=>'widgets','action'=>'edit', $this->data['Widget']['id'])); ?>", $("#WidgetEditForm").serialize(), function(){
        $('#preview-code').html(code.getValue().replace(/\$\{wid\}/g, 'id_1'));
    });
}

$(document).on('data-updated', function(){autosave(updateCode)});
code.on('change', function(){autosave(updateCode)});

setTimeout(updateData, 300);


</script>