<?php

function isValidURL($url) {
    return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
}

if(isValidURL($_GET['url'])) {
    $header = "Accept-language: en\r\n" .
        "P3P: policyref=\"" . "http://".$_SERVER['HTTP_HOST'] ."/policy.xml\"\r\n";
        
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $body = file_get_contents('php://input');
        // Création d'un flux
        $opts = array(
            'http'=>array(
                'method'=>"POST",
                'header'=>$header .
                    "Content-Type: application/json\r\n",
                'content' => $body
                )
            );
    } else {
        // Création d'un flux
        $opts = array(
            'http'=>array(
                'method'=>"GET",
                'header'=>$header
                )
        );
    }
    
    $context = stream_context_create($opts);
    echo file_get_contents($_GET['url'], false, $context);
    
}else{
    echo "Not valid url";
}

?>
