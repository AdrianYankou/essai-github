<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title>Première page</title>
  <style>
      body {
         font-family: Arial, sans-serif;
         margin: 0;
         padding: 0;
         background-image: url('sw.png');
         background-size: cover;
         background-position: center;
         background-repeat: no-repeat;
         height: 100vh;
         overflow: hidden;
      }

      header {
         text-align: center;
         padding: 10px;
         background-color: #f2f2f2;
      }

      main {
         display: flex;
         flex-direction: column;
         align-items: center;
         justify-content: center;
         height: 100%;
         color: white;
      }

      .button-container {
         width: 60vw;
         max-width: 600px;
         height: 40vh;
         display: flex;
         justify-content: space-between;
         align-items: flex-start;
         font-size: 4vw;
      }

      button {    
         font-size: 2vw; 
         font-weight: lighter;
         color: white;
         padding: 2vh 5vw;
         background: #000000;
         outline: none;
         cursor: pointer;
         border: none;
         border-radius: 2vw; 
         box-shadow: 0 1vh #000000;
      }

      @media (max-width: 600px) {
         .button-container {
            font-size: 8vw;
         }
      }        
   </style>
</head>
<body>
   <main>
      <div class="button-container">
         <a href="connexion.html"><button>S'authentifier</button></a> 
         <a href="inscription.html"><button>S'inscrire</button></a>
      </div> 
   </main>
</body>
</html>
