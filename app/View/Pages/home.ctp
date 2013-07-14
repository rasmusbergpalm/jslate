<style type="text/css">
    .CodeMirror {
        height: 438px;
        width: 100%;
    }
</style>
<div class="hero-unit">
    <div class="row-fluid">
        <div class="span6">
            <h1>jSlate</h1>
            <p>Dashboarding with no restrictions.</p>
            <!--p>jSlate is a blank slate where you can track and visualize anything you want, in any way you want.</p>
            <p>Write your dashboards in pure html, css and javascript.</p-->
        </div>
        <div class="span6 pull-right text-right">
            <p>Get a demo account. Sign up later.</p>
            <?php echo $this->Html->link('<i class="icon-arrow-right icon-white"></i> Try it', '/users/demo', array('class'=>'btn btn-large btn-success','escape'=>false)); ?>
        </div>
    </div>
</div>
<div class="row-fluid">
    <div class="span6">
        <h3>You create beautiful widgets</h3>
        <p>In pure html, css and javascript.</p>
        <textarea id="code" class="codemirror"><?php echo file_get_contents(APP.'templates'.DS.'jsonp_highstock-multi-lines.html'); ?></textarea>
    </div>
    <div class="span6">
        <h3>And add them to dashboards</h3>
        <p>With drag 'n drop and resize options.</p>
        <div id="preview" class="well">
        </div>
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
        indentUnit: 4
    });
    code.on('change', function() {
        clearTimeout(delay);
        delay = setTimeout(updatePreviewAndSave, 1000);
    });
    function updatePreviewAndSave() {
        $('#preview').html(code.getValue().replace(/\$\{wid\}/g, 'id_1'));
    }

    setTimeout(updatePreviewAndSave, 300);

</script>