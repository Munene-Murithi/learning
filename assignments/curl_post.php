<?php
$url="http://localhost:8080/register.php";

//create a loop that creates a hundred instances of the form data.
for ($i=100; $i<102; $i++) {
   $phone="0797925".$i;
   $email="stewiegriffin".$i."@gmail.com";

   $data = array(
      'names' => 'Stewie Griffin',
      'email' => $email,
      'phone' => $phone,
      'password' => 'password',
      'password_confirm' => 'password',
      'terms' => 'on'
   );
   
   $ch = curl_init();

   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_POST, 1);
   curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
   curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));

   // receive server response ...
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

   $response = curl_exec ($ch);

   curl_close ($ch);

   // further processing ....
   if ($response === false) {
      echo 'cURL error: ' . curl_error($ch);
   } else {
      echo 'Response: ' . $response;
   }
}
?>

