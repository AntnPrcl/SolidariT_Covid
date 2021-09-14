<?php
$link = mysqli_connect('185.98.131.109', 'solid1346221', 'lugei1xz6q', 'solid1346221');
$req = 'SELECT password from comercants_log WHERE log = "'.$_POST['login'].'";';
$result = $link->query($req);
$result = $result->fetch_assoc();
if (password_verify($_POST['password'], $result['password'])) {
    setcookie('id', $result['id']);
    header('Location: http://www.commercants.solidarit-covid-nogent.fr/map.html');
}
else {
    header('Location: http://commercants.solidarit-covid-nogent.fr/index.html?err=1');
}