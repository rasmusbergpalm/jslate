<h2> Edit dashboard </h2>
<div class="dashboards form">
    <h4>Public link (read only)</h4>
        <?php
            $location = Router::url(array('action' => 'readonly', $this->request->data['Dashboard']['public_id']), true);
            echo $this->Html->link($location, $location, array('target' => '_blank'));
        ?>
    <h4>Change name</h4>
    <?php echo $this->Form->create('Dashboard');?>
    <?php echo $this->Form->input('name'); ?>
    
    <div id="accordion">
        <div class="acc-panel">CSS</div>
        <div class="input textarea">
            <div id="dashboard-css-data">
                <?php echo $this->Form->input('css', array('label' => false, 'div' => false)); ?>
            </div>
        </div>
        <div class="acc-panel">Javascript</div>
        <div class="input textarea">
            <div id="dashboard-javascript-data">
                <?php echo $this->Form->input('javascript', array('label' => false, 'div' => false)); ?>
            </div>
        </div>
    </div>
    <div class="submit" style="padding-top: 5px">
        <?php echo $this->Form->submit(__('Save'), array('class'=>'btn', 'div' => false)); ?>
        <?php echo $this->Html->link('Export', array('controller' => 'dashboards', 'action' => 'export', $dashboard_id),
                array('class' => 'btn')); ?>
        <?php echo $this->Html->link('Delete', array('controller' => 'dashboards', 'action' => 'delete', $dashboard_id),
                array('class' => 'btn')); ?>
    </div>
    <?php echo $this->Form->end(); ?>
</div>

<script type="text/javascript">
function setupCodeMirror(id, options) {
    options.tabMode = 'indent';
    options.lineNumbers = true;
    options.matchBrackets = true;
    options.theme = 'ambiance';
    options.indentUnit = 4;
    
    CodeMirror.fromTextArea(document.getElementById(id), options);
}

$(function() {
    setupCodeMirror('DashboardCss', {
        mode: 'text/css'
    });
    
    setupCodeMirror('DashboardJavascript', {
        mode: 'text/javascript',
        extraKeys: {
            "Ctrl-Space": function(cm) {
                CodeMirror.showHint(cm, CodeMirror.javascriptHint);
            }
        }
    });
    
    $('#accordion').accordion({
        header: '.acc-panel',
        active: false,
        collapsible: true
    });
});

</script>