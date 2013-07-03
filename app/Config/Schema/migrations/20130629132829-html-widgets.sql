UPDATE dbviews set code = concat(
'<div id="viewport',id,'" style="width: 100%; height: 100%;"></div>
<script type="text/javascript">
$(function(){
var viewid = "viewport',id,'";',
code,
'});'
'</script>')
