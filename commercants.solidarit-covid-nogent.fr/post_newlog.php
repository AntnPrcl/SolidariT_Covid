<?php
$link = mysqli_connect('185.98.131.109', 'solid1346221', 'lugei1xz6q', 'solid1346221');
if ($_POST['password'] == $_POST['password_check']) {
    $req = 'INSERT INTO comercants_log ( log, password) VALUES ("'.$_POST['login'].'", "'.password_hash($_POST['password'], PASSWORD_BCRYPT).'");';
    $link->query($req);
}
else {
    header('Location: http://commercants.solidarit-covid-nogent.fr/post_newlog.html?err=1');

}
header('Location: http://commercants.solidarit-covid-nogent.fr/');


