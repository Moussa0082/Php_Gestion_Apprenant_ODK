<?php


// Démarrez la session
session_start();

require 'connexion.php';

// si l'utilisateur est connecté
if (!isset($_SESSION['connected'])) {
    // Redirigez l'utilisateur vers une autre page 
   //  header('Location: index.php');
   //  exit();
}

   
   if(isset($_POST['submit'])){
       if(isset($_POST['username'],$_POST['password'])){
           $req=$db->query('SELECT * from admin where username="'.
           $_POST['username'].'" and password="'.$_POST['password'].'"');
           if($ligne=$req->fetch()){
               $_SESSION['username']=$ligne['username'];
            echo "<script> alert('connexion réeussi'  ) </script>";
            //    header('Location:accueil.php');
               echo "<script>window.open('a.php','_self')</script>";
               
           }else{
            echo "<script> alert('Email ou Mot de Passe Incorrect') </script>";
            //    header('Location:login.php');
            //    echo  ' Identifiant ou Mot de Passe Incorrect ';
            

           }
       }
      
   }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="a.css">
</head>

</style>
<body>

<?php include_once "head.php" ?>


<div class="container">
       <h2> Connexion</h2>
        <form action="index.php" method="POST">
            <div>
                <label for="">Nom d'utilisateur:</label>
                <input type="text" name="username" value="" id="username" placeholder="Nom d'utilisateur" value="<?php htmlspecialchars() ?>">
            </div>
            <div>
                <label for="">Password:</label>
                <input type="text" name="password" value="" id="password" placeholder="Password" value="<?php htmlspecialchars() ?>" >
            </div>
            
                <div>
                    <input type="submit" value="Se connecter"  name="submit" style="color: black; background-color:orange; cursor:pointer; border:none; border-radius:10px;">
                </div>
                <p>Vous n'avez pas de compte ? <strong style=" cursor:pointer;"> <a href="register.php" style="text-decoration: none; color: orange;" > Créer un compte</a></strong></p>
        </form>
        </div>

        <script>
         let nom = document.getElementById("username")
         let pass = document.getElementById("password")
         
         nom.addEventListener("keyup", ()=>{
            if(nom.value.length>8){
            alert("nom trop long");
            nom.value="";
          }
         })
         pass.addEventListener("keyup", ()=>{
            if(nom.value.length>6){
            alert("mot de passe trop long");
            pass.value="";
          }
         })
          

        </script>
</body>
</html>