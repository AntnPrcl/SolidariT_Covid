
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SolidariT - Commerces</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
</head>
<body>
<div id="page_container">
    <h1>Les commerces ouverts &agrave; Nogent</h1>


    <div id="mapid"></div>

    <?php
    $link = mysqli_connect('185.98.131.109', 'solid1346221', 'lugei1xz6q', 'solid1346221');

    $sql = 'SELECT nom, adresse, lat, lon FROM commercants;';
    $result = $link->query($sql);
    ?>
    <script>
        var mymap = L.map('mapid').setView([48.8396, 2.4768], 15);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoidWx0cndycyIsImEiOiJjazhhZGEwNzkwMTdqM29xcDlrNjdkODFrIn0.P5oLEvX4I8w60DOtnveikg'
        }).addTo(mymap);
        mymap.touchZoom.disable();
        mymap.doubleClickZoom.disable();
        mymap.scrollWheelZoom.disable();
        <?
    while($row = $result->fetch_assoc()) { ?>
        var marker = L.marker([ <? echo($row['lat']); ?>, <? echo($row['lon']); ?>]).addTo(mymap);
        marker.bindPopup("<? echo($row['nom'])?> <br> <? echo($row['adresse']) ?> ");
    <? } ?>
    </script>
    <br>
    <h3>Livraisons &agrave; domicile</h3>
    <table class="table">
        <thead>
            <th>Nom</th>
            <th>Adresse</th>
            <th>T&eacute;l&eacute;phone</th>
            <th></th>
        </thead>
        <?

        $req = 'SELECT nom, adresse, telephone, commentaires FROM commercants WHERE livraison = "oui";';
        $res = $link->query($req);
        ?>
        <tbody> <?
        while ($row = $res->fetch_assoc()) {?>
        <tr>
            <td><? echo($row['nom']); ?></td>
            <td><? echo($row['adresse']); ?></td>
            <td><? echo($row['telephone']); ?></td>
            <td><? echo($row['commentaires']); ?></td>
        </tr>
        <? } ?>
        </tbody>
    </table>
</div>
</body>
</html>
