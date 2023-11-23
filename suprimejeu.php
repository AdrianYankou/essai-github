

<?php
// Inclure le fichier de connexion à la base de données
include('param.inc.php');

// Logique de suppression si la confirmation est envoyée
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmer_suppression'])) {
    $connexion = new mysqli($host, $login, $passwd, $dbname);
    $id_jeu = mysqli_real_escape_string($connexion, $_POST['id_jeu']);
    
    // Exécutez la suppression
    
    $query = "DELETE FROM jeu WHERE id_jeu = $id_jeu";
    $result = mysqli_query($connexion, $query);

    // Vérifiez si la suppression a réussi
    if ($result) {
        echo "Le jeu a été supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression du jeu : " . mysqli_error($connexion);
    }
}

// Récupérer la liste des jeux depuis la base de données
$connexion = new mysqli($host, $login, $passwd, $dbname);
$query = "SELECT * FROM jeu";
$result = mysqli_query($connexion, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
        echo "<p><strong>Description:</strong> " . $row['descriptions'] . "</p>";
        echo "<p><strong>Règle du jeu:</strong> <a href='" . $row['regle_du_jeu'] . "' target='_blank' download> lire la règle du jeu (PDF)</a></p>";
        if (!empty($row['photos'])) {
            echo "<img src='" . $row['photos'] . "' alt='" . $row['nom'] . "'>";
        }

        // Afficher le formulaire de confirmation de suppression
        echo "<form method='post' action=''>";
        echo "<input type='hidden' name='id_jeu' value='" . $row['id_jeu'] . "'>";
        echo "<button type='submit' name='confirmer_suppression'>Supprimer</button>";
        echo "</form>";

        echo "<hr>";
    }
} else {
    echo "<p>Aucun jeu disponible pour le moment.</p>";
}

// Fermer la connexion à la base de données
mysqli_close($connexion);
?>

</body>
</html>