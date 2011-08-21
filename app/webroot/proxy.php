<?php

function isValidURL($url) {
    return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
}

if(isValidURL($_GET['url'])){
    echo file_get_contents($_GET['url']);
}else{
    echo "Not valid url";
}

?>
