<?php
session_start();

// Inclure le fichier de connexion à la base de données
include('param.inc.php');
$connexion = new mysqli($host, $login, $passwd, $dbname);

/*// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    header("Location: connexion.php");
    exit();
}*/

// Gestion de l'inscription à une partie
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['inscription_partie'])) {
    $id_utilisateur = $_SESSION['id_membre'];
    $id_jeu = mysqli_real_escape_string($connexion, $_POST['id_jeu']);

    // Vérifier si l'utilisateur est déjà inscrit
    $connexion = new mysqli($host, $login, $passwd, $dbname);
    $query_inscription = "SELECT * FROM inscriptions WHERE id_membre = $id_utilisateur AND id_jeu = $id_jeu";
    $result_inscription = mysqli_query($connexion, $query_inscription);

    if (mysqli_num_rows($result_inscription) == 0) {
        // Inscrire l'utilisateur à la partie
        $query_insert = "INSERT INTO inscriptions (id_membre, id_jeu) VALUES ($id_utilisateur, $id_jeu)";
        $result_insert = mysqli_query($connexion, $query_insert);

        if ($result_insert) {
            echo "Inscription réussie à la partie.";
        } else {
            echo "Erreur lors de l'inscription à la partie : " . mysqli_error($connexion);
        }
    } else {
        echo "Vous êtes déjà inscrit à cette partie.";
    }
}

// Récupérer la liste des jeux et parties depuis la base de données
$query_jeux = "SELECT * FROM jeu";
$result_jeux = mysqli_query($connexion, $query_jeux);

$query_parties = "SELECT * FROM partie";
$result_parties = mysqli_query($connexion, $query_parties);
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
if (mysqli_num_rows($result_jeux) > 0) {
    while ($row_jeu = mysqli_fetch_assoc($result_jeux)) {
        echo "<h2>" . $row_jeu['nom'] . "</h2>";
        echo "<p><strong>Catégorie:</strong> " . $row_jeu['categorie'] . "</p>";
        echo "<p><strong>Description:</strong> " . $row_jeu['descriptions'] . "</p>";
        echo "<p><strong>Règle du jeu:</strong> <a href='" . $row_jeu['regle_du_jeu'] . "' target='_blank' download> lire la règle du jeu (PDF)</a></p>";
        if (!empty($row_jeu['photos'])) {
            echo "<img src='" . $row_jeu['photos'] . "' alt='" . $row_jeu['nom'] . "'>";
        }

        // Formulaire d'inscription à la partie
        echo "<form method='post' action=''>";
        echo "<input type='hidden' name='id_jeu' value='" . $row_jeu['id_jeu'] . "'>";
        echo "<button type='submit' name='inscription_partie'>S'inscrire à la partie</button>";
        echo "</form>";

        // Afficher les parties à venir pour ce jeu
        echo "<h3>Parties à venir</h3>";
        while ($row_partie = mysqli_fetch_assoc($result_parties)) {
            if ($row_partie['id_jeu'] == $row_jeu['id_jeu']) {
                echo "<p>Date: " . $row_partie['date_partie'] . " Heure de début: " . $row_partie['heure_debut'] . " Heure de fin: " . $row_partie['heure_fin'] . "</p>";
            }
        }
        mysqli_data_seek($result_parties, 0); // Réinitialiser le pointeur de résultat pour la prochaine itération

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