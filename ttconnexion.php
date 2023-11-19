

<?php
session_start();

// Inclure la connexion à la base de données
include('connexion_bdd.php');

// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $mail = mysqli_real_escape_string($connexion, $_POST['mail']);
    $motdepasse = mysqli_real_escape_string($connexion, $_POST['password']);

    // Requête pour vérifier les informations d'authentification
    $query = "SELECT * FROM utilisateur WHERE mail = '$mail'";
    $result = mysqli_query($connexion, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $utilisateur = mysqli_fetch_assoc($result);

        // Vérifier le mot de passe haché
        if (password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
            // Authentification réussie, créer une session
            $_SESSION['id_utilisateur'] = $utilisateur['id_utilisateur'];
            $_SESSION['statut'] = $utilisateur['statut'];

            // Rediriger vers la page d'accueil ou une autre page appropriée
            header("Location: index.php");
            exit();
        } else {
            // Mot de passe incorrect
            $erreur = "Mot de passe incorrect";
        }
    } else {
        // Utilisateur non trouvé
        $erreur = "Adresse e-mail non valide";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <!-- Ajoutez des liens vers vos fichiers CSS et autres ressources ici -->
</head>
<body>
    <h1>Connexion</h1>

    <!-- Afficher les erreurs, le cas échéant -->
    <?php if (isset($erreur)) : ?>
        <p style="color: red;"><?php echo $erreur; ?></p>
    <?php endif; ?>

   
</body>
</html>