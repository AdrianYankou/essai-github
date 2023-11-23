<?php
// Inclure le fichier de configuration de la base de données et les fonctions utiles
include('param.inc.php'); // Assurez-vous de créer ce fichier avec vos informations de connexion à la base de données et d'autres configurations

// Vérifier si l'utilisateur est connecté en tant qu'admin (vous devez mettre en place votre propre système d'authentification)
// Exemple basique, à améliorer en fonction de votre logique d'authentification
/*session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php'); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté en tant qu'admin
    exit();
}*/

// Requête pour récupérer la liste des jeux avec les informations des utilisateurs associés
$selectQuery = "SELECT jeu.*, utilisateur.nom AS nom_utilisateur
                FROM jeu
                JOIN utilisateur ON jeu.id_membre = utilisateur.id";
$result = $mysqli->query($selectQuery);

// Vérifier si la requête a réussi
if ($result) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Liste des Jeux Souhaités avec Infos Utilisateur</title>
    </head>
    <body>
        <h2>Liste des Jeux Souhaités avec Infos Utilisateur</h2>
        <table border="1">
            <tr>
                <th>ID du Jeu</th>
                <th>Nom du Jeu</th>
                <th>Description</th>
                <th>Catégorie</th>
                <th>Règle du Jeu</th>
                <th>Photo</th>
                <th>Nom de l'Utilisateur</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?= $row['id_jeu']; ?></td>
                    <td><?= $row['nom']; ?></td>
                    <td><?= $row['description']; ?></td>
                    <td><?= $row['categorie']; ?></td>
                    <td><?= $row['regle_du_jeu']; ?></td>
                    <td><?= $row['photo']; ?></td>
                    <td><?= $row['nom_utilisateur']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </body>
    </html>
    <?php

    // Libérer le résultat de la mémoire
    $result->free();
} else {
    // Afficher une erreur si la requête a échoué
    echo "Erreur lors de l'exécution de la requête : " . $mysqli->error;
}

// Fermer la connexion à la base de données
$mysqli->close();
?>