<style type="text/css">
  .CodeMirror {
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
  #preview {
    width: 49%;
    position: fixed;
    left: 51%;
    height: 600px;
    border: 1px solid black;
  }
</style>
<span id="autosaved">Auto-save is ON.</span>
<?php echo $this->Form->create('Dbview');?>
    <?php
        echo $this->Form->input('id', array('label'=>false));
        echo $this->Form->input('code', array('id'=>'code','label'=>false));
    ?>
<?php echo $this->Form->end();?>
<div id="preview"></div>

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