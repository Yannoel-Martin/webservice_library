<?php
$url = 'http://localhost/webservice_livrary/api/book';
$data = array(
    'book_Name' => "SAO light Novel",
    'book_Editor' => "Ekja",
    'book_Publication_date' => "2010-03-04",
    'book_Price' => 18.85
);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

$response = curl_exec($ch);

var_dump($response);

if (!$response) {
    return false;
}