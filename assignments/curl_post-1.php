<?php
$post_data="names=brian mugambi&email=brianmugambi@gmail.com&phone=0728756365&password=password";
$url="http://localhost:8090/register.php";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));   
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
$result = curl_exec($ch);

echo $result;