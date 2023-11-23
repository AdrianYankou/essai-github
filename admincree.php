<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma page création admin</title>
    <style>
         body {
         font-family: Arial, sans-serif;
         margin: 0;
         padding: 0;
         background-image: url('background other 2.0.png');
         background-size: cover;
         background-position: center;
         background-repeat: no-repeat;
         height: 100vh;
         overflow: hidden;
        }
        label{
            color:white;
        }
        h1{
            color:white;
        }
        form {
            display: inline-block;
            text-align: left;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input {
            padding: 8px;
            margin-bottom: 10px;
        }
        button {
            padding: 10px;
            font-size: 16px;
        }
        #result {
            margin-top: 20px;
            color: green;
        }
    </style>
</head>
<body>

    <h1>Inscription admin</h1>
    
    <!-- Lien de retour vers la page précedente  -->
    <a href="admin.php">Retour à la Page précédente</a>
    
    <form method="POST" action="traitementIA.php">

        <label for="nom">Nom:</label>.
        <input type="text" id="nom" name="nom" required>
        <br>
    
        <label for="prenom">Prénom:</label>
        <input type="text" id="prenom" name="prenom" required>
        <br>
    
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>
        <br>
    
        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required>
        <br>
    
        <button class="btn btn-outline-primary" type="submit">S'inscrire</button>
    </form>
    

</body>
</html>