<h2> Edit dashboard </h2>
<div class="dashboards form">
    <h4>Public link (read only)</h4>
    <?php echo Router::url(array('action' => 'readonly', $this->request->data['Dashboard']['public_id']), true); ?>
    <h4>Change name</h4>
    <?php echo $this->Form->create('Dashboard');?>
    <?php echo $this->Form->input('name'); ?>
    <div id="accordion">
        <div class="acc-panel">CSS</div>
        <div class="input textarea">
            <div id="dashboard-css-data">
                <textarea id='DashboardCss' name='data[Dashboard][css]'><?php echo $this->request->data['Dashboard']['css'] ?></textarea>
            </div>
        </div>
        <div class="acc-panel">Javascript</div>
        <div class="input textarea">
            <div id="dashboard-javascript-data">
                <textarea id='DashboardJavascript' name='data[Dashboard][javascript]'><?php echo $this->request->data['Dashboard']['javascript'] ?></textarea>
            </div>
        </div>
    </div>
    <?php echo $this->Form->submit(__('Save'), array('class'=>'btn')); ?>
    <?php echo $this->Form->end(); ?>
</div>

<script type="text/javascript">

$(function() {
    $('#accordion').accordion({
        header: '.acc-panel',
        active: false,
        collapsible: true
    });
});

function showAutocomplete(cm) {
    var state = cm.getStateAfter(cm.getCursor().line);
    if ( state.localMode && state.localMode.name == 'javascript') {
        CodeMirror.showHint(cm, CodeMirror.javascriptHint);
    } else {
        CodeMirror.showHint(cm, CodeMirror.htmlHint);
    }
}    

CodeMirror.fromTextArea(document.getElementById('DashboardCss'), {
    mode: 'text/css',
    tabMode: 'indent',
    lineNumbers: true,
    matchBrackets: true,
    theme: 'ambiance',
    indentUnit: 4,
    extraKeys: {
        "Ctrl-Space": showAutocomplete
    }
});

CodeMirror.fromTextArea(document.getElementById('DashboardJavascript'), {
    mode: 'text/javascript',
    tabMode: 'indent',
    lineNumbers: true,
    matchBrackets: true,
    theme: 'ambiance',
    indentUnit: 4,
    extraKeys: {
        "Ctrl-Space": showAutocomplete
    }
});
</script>