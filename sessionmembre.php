<?php
// Vérifier si l'utilisateur est connecté
session_start();
/*if (!isset($_SESSION['id_utilisateur'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: connexion.php");
    exit();
}*/

// Inclure la connexion à la base de données et d'autres fichiers nécessaires
include('param.inc.php'); // Assurez-vous d'adapter le nom du fichier selon votre configuration

// Récupérer la liste complète des jeux depuis la base de données
$query = "SELECT * FROM jeu";
$result = mysqli_query($connexion, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil Membre</title>
    <!-- Ajoutez des liens vers vos fichiers CSS et autres ressources ici -->
</head>
<body>
    <!-- Ajoutez l'en-tête de la page et tout autre élément de navigation ici -->
    <h1>bon retour!</h1>
    <p>Que souhaitez-vous faire?</p>

    <!-- Liens vers les pages spécifiques pour les membres -->
    <ul>
        <li><a href="liste_jeux.php">acceder à la liste de jeux</a></li>
        <li><a href="jeux_souhaites.php">Indiquer les Jeux Souhaités</a></li>
        <li><a href="parties.php">voir les parties a venir</a></li>
        <li><a href="historique_jeux.php">Consulter l'Historique des Jeux Joués</a></li>
    </ul>

    <!-- Ajoutez le pied de page et tout autre contenu supplémentaire ici -->
</body>
</html>