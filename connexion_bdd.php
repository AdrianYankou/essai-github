<?php

// Informations de connexion à la base de données
$serveur = "localho localhost:3306st"; // Adresse du serveur MySQL
$utilisateur = "grp_6_2"; // Nom d'utilisateur MySQL
$mot_de_passe = "18Oxc2vCTssy"; // Mot de passe MySQL
$nom_base_de_donnees = "bdd_6_2"; // Nom de la base de données

// Connexion à la base de données
$connexion = mysqli_connect($serveur, $utilisateur, $mot_de_passe, $nom_base_de_donnees);

// Vérifier la connexion
if (!$connexion) {
    die("Échec de la connexion à la base de données : " . mysqli_connect_error());
}
?>