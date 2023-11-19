<?php
session_start();
if (!isset($_SESSION['id_utilisateur'])) {
    header("Location: connexion.php");
    exit();
}

include('connexion_bdd.php');

$query = "SELECT * FROM jeu";
$result = mysqli_query($connexion, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Jeux</title>
</head>
<body>
    <h1>Liste des Jeux</h1>

    <?php
    // Vérifier s'il y a des jeux dans la base de données
    if (mysqli_num_rows($result) > 0) {
    
        while ($row = mysqli_fetch_assoc($result)) {
                echo "<h2>" . $row['nom'] . "</h2>";
            echo "<p><strong>Catégorie:</strong> " . $row['categorie'] . "</p>";
            echo "<p><strong>Description:</strong> " . $row['description'] . "</p>";
            echo "<p><strong>Règle du jeu:</strong> <a href='" . $row['regle_du_jeu'] . "' target='_blank'>Télécharger la règle du jeu (PDF)</a></p>";
            if (!empty($row['photos'])) {
                echo "<img src='" . $row['photos'] . "' alt='" . $row['nom'] . "'>";
            }
            echo "<hr>";
        }
    } else {
    echo "<p>Aucun jeu disponible pour le moment.</p>";
}
    ?>

</body>
</html>
