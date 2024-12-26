<?php

$username = "hiteshjadav94"; 

$country = $_GET['country'];
$lang = $_GET['lang'];

$url = "http://api.geonames.org/countryInfo?country=" . $country . "&lang=" . $lang . "&username=" . $username; 

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
curl_close($ch);

$data = json_decode($result, true);

if (isset($data['geonames'][0])) {
  $output = array(
    'status' => 'ok',
    'data' => array(
      'countryName' => $data['geonames'][0]['countryName'],
      'continent' => $data['geonames'][0]['continentCode'] 
    )
  );
} else {
  $output = array(
    'status' => 'error',
    'message' => 'No data found.'
  );
}

header('Content-Type: application/json');
echo json_encode($output);

?>