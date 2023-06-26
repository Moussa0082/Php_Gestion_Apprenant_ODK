<?php

    require 'connexion.php';
    if (isset($_POST['submit'])) {
        if (isset($_POST['username'], $_POST['email'], $_POST['password']));
        $req = $db->prepare('insert into admin(username,email,password) values(?,?,?)');
        $req->bindValue(1, $_POST['username']);
        $req->bindValue(2, $_POST['email']);
        $req->bindValue(3, $_POST['password']);
        $req->execute();
        // header('Location: register.php');

    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte</title>
    <link rel="stylesheet" href="a.css">
</head>
<body>

  <?php include_once "head.php" ?>
  
    <div class="container">
       <h2> Créer un compte</h2>
        <form action="register.php" method="post">
            <div>
                <label for="">Nom d'utilisateur:</label>
                <input type="text" name="username" value=" <?php htmlspecialchars() ?> ">
            </div>
            <div>
                <label for="">Email:</label>
                <input type="text" name="email" value=" <?php htmlspecialchars() ?> ">
            </div>
            <div>
                <label for="">Password:</label>
                <input type="text" name="password" value=" <?php htmlspecialchars() ?> ">
            </div>
            
                <div>
                    <input type="submit" value="S'enregistrer" name="submit" style="color: black; background-color:orange; cursor:pointer; border:none; border-radius:10px;">
                </div>
                <p>Avez vous déjà un compte ? <strong style="cursor:pointer;"> <a href="index.php" style="text-decoration: none; color: orange; ">Se connecter</a> </strong></p>
        </form>
        </div>
</body>
</html>