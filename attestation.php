<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SolidariT - Attestations</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
</head>
<body>
<div id="page_container">
    <h1>Attestation de d&eacute;placement d&eacute;rogatoire</h1>
    <p>
        Pendant le confinement, vous devez vous munir d'une attestation afin de pouvoir quitter votre domicile pour une courte durée. Si le d&eacute;placement que vous effectuez est pour vous rendre à votre lieu de travail, vous devez, en plus de l'attestation d&eacute;rogatoire, vous munir d'un justificatif de d&eacute;placement professionnel remplie par votre employeur.
    </p>
    <h3>O&ugrave; trouver ces attestations ?</h3>
    <p>
        Vous pouvez trouver ces attestations sur le site du Minist&egrave;re de l'Int&eacute;rieur en cliquant sur le bouton ci-dessous :
    </p>
    <div id="button-container"><a type="button" class="btn btn-lg btn-danger" href="https://www.interieur.gouv.fr/Actualites/L-actu-du-Ministere/Attestation-de-deplacement-derogatoire-et-justificatif-de-deplacement-professionnel">Minist&egrave;re de l'Int&eacute;rieur</a></div>

    <h3>Je n'ai pas d'imprimante chez moi. Comment faire ?</h3>
    <p>
        Vous pouvez recopier l'attestation de d&eacute;placement d&eacute;rogatoire sur papier libre. Vous pouvez &eacute;galement consulter la carte ci dessous o&ugrave; des citoyens nogentais ont mis des attestations imprimées à votre dispositions.
    </p>
        <div id="mapid"></div>
    <p>Si vous le souhaitez, vous pouvez remplir un formulaire en cliquant sur le bouton ci dessous pour signaler que vous avez vous aussi mis des attestation en libre-service.</p>
    <div id="button-container"><a type="button" class="btn btn-lg btn-primary" href="attestation_form.html">Remplir le formulaire</a></div>
    <?php
    $link = mysqli_connect('185.98.131.109', 'solid1346221', 'lugei1xz6q', 'solid1346221');

    $sql = 'SELECT * FROM attestations;';
    $result = $link->query($sql);
    ?>
    <script>
        var mymap = L.map('mapid').setView([48.8396, 2.4768], 14);
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
        marker.bindPopup("<? echo($row['n_rue'])?> <? echo($row['rue']) ?> <br> <? echo($row['commentaire']) ?> ");
    <? } ?>
    </script>

</div>
</body>
</html>