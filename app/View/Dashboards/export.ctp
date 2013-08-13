<?php
$this->response->type('application/json');
$this->response->header('Content-Disposition', 'attachment; filename="export.jslate"');
unset($dashboard['Dashboard']['id']);
unset($dashboard['Dashboard']['user_id']);
unset($dashboard['Dashboard']['public_id']);
foreach ($dashboard['Dbview'] as &$widget) {
    unset($widget['id']);
    unset($widget['dashboard_id']);
}
echo json_encode($dashboard);
?>
