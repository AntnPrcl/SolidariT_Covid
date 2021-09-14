<?php
$link = mysqli_connect('185.98.131.109', 'solid1346221', 'lugei1xz6q', 'solid1346221');
$req = 'SELECT mdp from admin WHERE login = '.$_POST['login'].';';
$result = $link->query($req);
var_dump($result->fetch_assoc());