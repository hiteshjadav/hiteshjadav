<?php

$username = "hiteshjadav94"; 

$lat = $_GET['lat'];
$lon = $_GET['lon'];

$url = "http://api.geonames.org/elevation?lat=" . $lat . "&lng=" . $lon . "&username=" . $username;

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
      'elevation' => $data['geonames'][0]['elevation']
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