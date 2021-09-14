<?php

$link = mysqli_connect('185.98.131.109', 'solid1346221', 'lugei1xz6q', 'solid1346221');

$data = array(
    'street' => $_POST['n_rue_rue'],
    'postalcode' => $_POST['cp_ville'],
    'city' => $_POST['ville'],
    'country' => 'france',
    'format' => 'json',
);
$url = 'https://nominatim.openstreetmap.org/?' . http_build_query($data);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mettre ici un user-agent adéquat');
$geopos = curl_exec($ch);
curl_close($ch);

$json_data = json_decode($geopos, true);
$lat = $json_data[0]['lat'];
$lon = $json_data[0]['lon'];
$lat = (float)$lat;
$lon = (float)$lon;

$req = 'INSERT INTO commercants(nom, telephone, adresse, type, lat, lon, status) VALUES ("' . $_POST['nom'] . '", "' . $_POST['telephone'] . '", "' . $_POST['n_rue_rue'] .' '. $_POST['cp_ville'] . ' ' . $_POST['ville'] . '", "' . $_POST['type'] . '", "' . $lat . '", "' . $lon . '", "deactivated");';


if (!$result = $link->query($req)) {
    // Oh no! The query failed.
    echo "Sorry, the website is experiencing problems.";

    // Again, do not do this on a public site, but we'll show you how
    // to get the error information
    echo "Error: Our query failed to execute and here is why: \n";
    echo "Query: " . $req . "\n";
    echo "Errno: " . $link->errno . "\n";
    echo "Error: " . $link->error . "\n";
    exit;
}
mysqli_close($link);
header('Location: /commercants.php');
exit();
?>