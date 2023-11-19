<?php
session_start();

// Vérifier si l'utilisateur est connecté en tant qu'administrateur
if (!isset($_SESSION['id_utilisateur']) || $_SESSION['statut'] !== 'administrateur') {
    header("Location: connexion.html");
    exit();
}

include('connexion_bdd.php');

// Gestion des différentes actions (ajout, modification, suppression, etc.)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Traitement des actions ici
}

// Récupérer la liste des jeux
$query_jeux = "SELECT * FROM jeu";
$result_jeux = mysqli_query($connexion, $query_jeux);

// Récupérer la liste des parties à venir
$query_parties = "SELECT * FROM parties";
$result_parties = mysqli_query($connexion, $query_parties);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>
<body>
    <h1>Panneau d'Administration</h1>

    <!-- Section pour gérer les jeux -->
    <h2>Gérer les Jeux</h2>
    <ul>
        <?php
        while ($row_jeu = mysqli_fetch_assoc($result_jeux)) {
            echo "<li>" . $row_jeu['nom'] . " - <a href='modifier_jeu.php?id=" . $row_jeu['id_jeu'] . "'>Modifier</a> | <a href='supprimer_jeu.php?id=" . $row_jeu['id_jeu'] . "'>Supprimer</a></li>";
        }
        ?>
        <li><a href="ajouter_jeu.php">Ajouter un Nouveau Jeu</a></li>
    </ul>

    <!-- Section pour gérer les parties -->
    <h2>Gérer les Parties</h2>
    <ul>
        <?php
        while ($row_partie = mysqli_fetch_assoc($result_parties)) {
            echo "<li>" . $row_partie['id_partie'] . " - " . $row_partie['date_partie'] . " - <a href='annuler_partie.php?id=" . $row_partie['id_partie'] . "'>Annuler la Partie</a></li>";
        }
        ?>
        <li><a href="proposer_partie.php">Proposer une Nouvelle Partie</a></li>
    </ul>

    <!-- Ajoutez d'autres sections pour gérer les autres fonctionnalités -->

</body>
</html>