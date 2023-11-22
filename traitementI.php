<?php



$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$password = $_POST['password'];

//pour la vérification du statut
$statut = "membre";

$servername = "localhost";
$username = "root"; // L'utilisateur par défaut de MySQL dans XAMPP
$passwords = "root"; // Laissez le mot de passe vide par défaut

// Nom de la base de données que vous avez créée dans phpMyAdmin
$database = "projet";



// Créer une connexion
$conn = new mysqli($servername, $username, $password, $database);




// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
} 
else 
{
    // Vérifier si l'utilisateur existe déjà
    $checkUserQuery = "SELECT * FROM utilisateur WHERE email='$email'";
    $result = $conn->query($checkUserQuery);

    if ($result->num_rows > 0) {
        echo "Erreur : L'utilisateur avec l'adresse e-mail '$email' existe déjà.";
    } else {
        // Hacher le mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insérer l'utilisateur avec le mot de passe haché
        $insertUserQuery = "INSERT INTO utilisateur (nom,prenom,email,password,statut) values ('$nom','$prenom','$email','$hashedPassword','$statut')";

        if ($conn->query($insertUserQuery) === TRUE) {
            header('Location: sessionmembre.php');
            exit(); // Assure une sortie immédiate après la redirection
        } else {
            echo "Erreur lors de l'inscription : " . $conn->error . " Query: " . $insertUserQuery;
        }
        
    }
}

$conn->close();
?>