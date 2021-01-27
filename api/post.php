<?php
$url = 'http://localhost/webservice_livrary/api/book';
$data = array(
    'book_Name' => "SAO light Novel",
    'book_Editor' => "Ekja",
    'book_Publication_date' => "2010-03-04",
    'book_Price' => 13.85
);

$options = array(
    'http' => array(
        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        'method' => "POST",
        'content' => http_build_query($data)
    )
);
$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === FALSE) {
    // log error
}

var_dump($result);