<?php
$link = mysqli_connect('ip', 'user', 'pwd', 'database_table');

$data = array(
    'street'     => $_POST['n_rue'].$_POST['rue'],
    'postalcode' => $_POST['cp_ville'],
    'city'       => $_POST['ville'],
    'country'    => 'france',
    'format'     => 'json',
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

$req='INSERT INTO demandes(nom, prenom, telephone, email, n_rue, rue, cp_ville, ville, lat, lon) VALUES ("'.$_POST['nom'].'", "'.$_POST['prenom'].'", '.$_POST['telephone'].', "'.$_POST['email'].'", '.$_POST['n_rue'].', "'.$_POST['rue'].'", '.$_POST['cp_ville'].', "'.$_POST['ville'].'", "'.$lat.'", "'.$lon.'");';


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
header('Location: http://www.solidarit-covid-nogent.fr/success.html');
exit();