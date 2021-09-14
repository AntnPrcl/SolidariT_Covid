<?
$link = mysqli_connect('185.98.131.109', 'solid1346221', 'lugei1xz6q', 'solid1346221');
$req = 'SELECT id, nom, adresse, type, status FROM commercants;';
$resultat = $link->query($req);

?>
<html lang="fr">
<head>
    <title>SolidariT ADMIN - Commercants</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
<h1>Liste des commercants</h1>
    <a type="button" class="btn btn-warning" href="add_shop.html">Ajouter commercant</a>
    <table class=table>
        <thead>
        <tr>
            <th>Nom</th>
            <th>Adresse</th>
            <th>Type</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?
        while ($row = $resultat->fetch_assoc()) {?>
        <tr>
            <td><? echo($row['nom']); ?></td>
            <td><? echo($row['adresse']); ?></td>
            <td><? echo($row['type']); ?></td>
            <? if ( $row['status'] == 'activated' ) { ?>
            <td><a href="deactivate.php?id=<? echo($row['id']); ?>">D&eacutesactiver</a> <? }
                else { ?>
            <td><a href="activate.php?id=<? echo($row['id']); ?>">Activer</a> <? }
                }

                ?>
        </tbody>
    </table>
</body>
</html>

