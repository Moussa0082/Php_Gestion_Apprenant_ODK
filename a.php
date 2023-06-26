<?php

 

 session_start();
 $_SESSION['connected'] = true;
 
 // Redirigez l'utilisateur vers la page protégée (index.php)
//  header('Location: a.php');
//  exit();

require "Connexion.php";


function generateMatricule() {
    $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $digits = '0123456789';
                                      
    $matricule = 'P1';
    for ($i = 0; $i < 2; $i++) {
        $matricule .= $letters[rand(0, strlen($letters) - 1)];
    }
    for ($i = 0; $i < 2; $i++) {
        $matricule .= $digits[rand(0, strlen($digits) - 1)];
    }

    return $matricule;
}



 // category 
if (isset($_POST['enregistrer_pro'])) {
    if (isset($_POST['nom_p'],$_POST['annee_pro']));
    $req = $db->prepare('insert into promotion(nom_p,annee_pro) values(?,?)');
    $req->bindValue(1, $_POST['nom_p']);
    $req->bindValue(2, $_POST['annee_pro']);

    $req->execute();
    header('Location:a.php');
}
//   else  if ($_POST['nom_p']=='' && $_POST['annee_pro']=='') {
//         echo "<script> alert('Les champs ne doivent pas être vide') </script>";
  
//   }
//     else if ($_POST['nom_p']=='') {
//         echo "<script> alert('Les champ nom promotion ne doit pas être vide') </script>";
  
//     }
//     else if ($_POST['annee_pro']=='') {
//         echo "<script> alert('Le champ année promotionss ne doit pas être vide') </script>";
  
//     }
//     else{}




if (isset($_POST['enregistrer'])) {
    if (isset($_POST['nom'], $_POST['prenom'], $_POST['annee_p'], $_POST['date_naiss'], $_POST['email'], $_POST['telephone'], $_POST['id_p'])) {
        $matricule = generateMatricule();

        $req = $db->prepare('INSERT INTO apprenant (mclle, nom, prenom, annee_p, date_naiss, email, telephone, id_p) VALUES (?, ?, ?, ?, ?, ?, ?,?)');
        $req->bindValue(1, $matricule);
        $req->bindValue(2, $_POST['nom']);
        $req->bindValue(3, $_POST['prenom']);
        $req->bindValue(4, $_POST['annee_p']);
        $req->bindValue(5, $_POST['date_naiss']);
        $req->bindValue(6, $_POST['email']);
        $req->bindValue(7, $_POST['telephone']);
        $req->bindValue(8, $_POST['id_p']);
        $req->execute();

        // Upload de l'image
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $fileName = $_FILES['image']['name'];
            $tmpName = $_FILES['image']['tmp_name'];
            $imageExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowedExtensions = array('jpg', 'jpeg', 'png');

            if (in_array($imageExtension, $allowedExtensions)) {
                $newFileName = uniqid() . '.' . $imageExtension;
                $destination = 'image/' . $newFileName;
                move_uploaded_file($tmpName, $destination);

                // Mettre à jour la colonne photo dans la base de données
                $req = $db->prepare('UPDATE apprenant SET photo = ? WHERE mclle = ?');
                $req->bindValue(1, $destination);
                $req->bindValue(2, $matricule);
                $req->execute();
            }
        }

        header('Location: liste-apprenant.php');
    }
}



// EDITION
if (isset($_GET['idm'])) {
    $req = $db->query('select * from apprenant where id_a=' . $_GET['idm']);
    if ($ligne = $req->fetch()) {
        $_POST['id_a'] = $ligne['id_a'];
        $_POST['nom'] = $ligne['nom'];
        $_POST['prenom'] = $ligne['prenom'];
        $_POST['annee_p'] = $ligne['annee_p'];
        $_POST['date_naiss'] = $ligne['date_naiss'];
        $_POST['email'] = $ligne['email'];
        $_POST['telephone'] = $ligne['telephone'];
        $_POST['id_p'] = $ligne['id_p'];
    }
}
//MODIFICATION
if (isset($_POST['modifier'])) {
    if (isset($_POST['mclle'],$_POST['nom'], $_POST['prenom'], $_POST['annee_p'],$_POST['date_naiss'],$_POST['email'], $_POST['telephone'], $_POST['id_p']));
    $req = $db->prepare('update apprenant set mclle=?,nom=?,prenom=?,annee_p=?,date_naiss=?,email=?,telephone=?n id_p=? where id_a=?');
    $req->bindValue(1, $_POST['mclle']);
    $req->bindValue(2, $_POST['nom']);
    $req->bindValue(3, $_POST['prenom']);
    $req->bindValue(4, $_POST['annee_p']);
    $req->bindValue(5, $_POST['date_naiss']);
    $req->bindValue(6, $_POST['email']);
    $req->bindValue(7, $_POST['telephone']);
    $req->bindValue(8, $_POST['id_a']);
    $req->bindValue(8, $_POST['id_p']);
    $req->execute();
    header('Location:liste-apprenant.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apprenant form</title>
    <link rel="stylesheet" href="a.css">
</head>

<body>


<?php include_once "header.php" ?>


<button id="afficher-form" style="color: black; background-color:orange; cursor:pointer; border:none; border-radius:10px; margin-left:170vh;  height:30px; width:200px; ">Afficher le formulaire</button>
   


     <!-- trait  -->

    <div class="container" style="display:block; " >
    <fieldset  id="apprenant-form" class="hidden" style="display: none;">
        <legend>Enregistrer Promotion</legend>
        <form action="a.php" method="post">
            <div>
                <label for="">Nom Promotion:</label>
                <input type="text" name="nom_p" id="nom_p" value="<?php if (isset($_POST['nom_p'])) echo $_POST['nom_p'] ?>">
            </div>
            <div>
                <label for="">Année Promotion:</label>
                <input type="text" name="annee_pro" id="annee_pro" value="<?php if (isset($_POST['annee_pro'])) echo $_POST['annee_pro'] ?>">
            </div>

            <?php if (isset($_GET['idm'])) { ?>
                <div>
                    <label for="">&nbsp;</label>
                    <input type="hidden" name="id_a" value="<?php if (isset($_POST['id_a'])) echo $_POST['id_a'] ?>">
                    <input type="submit" value="Modifier" name="modifier_pro">
                </div>
            <?php } else { ?>
                <div>
                    <label for="">&nbsp;</label>
                    <input type="submit" value="Enregistrer" name="enregistrer_pro" id="enregistre_pro" style="color: black; background-color:orange; cursor:pointer; border:none; border-radius:10px;">
                </div>
            <?php } ?>
        </form>
    </fieldset>
   
        <fieldset>
       
            <legend>Enregistrer Apprenant</legend>
            <form action="a.php" method="POST">
                <div>
                    <label for="nom">Nom:</label>
                    <input type="text" name="nom" id="nom"  value="<?php if (isset($_POST['nom'])) echo $_POST['nom'] ?>">
                </div>
                <div>
                    <label for="prenom">Prénom:</label>
                    <input type="text" name="prenom" id="prenom"  value="<?php if (isset($_POST['prenom'])) echo $_POST['prenom'] ?>" >
                </div>
                <div>
                    <label for="annee_p">Année certification:</label>
                    <input type="text" name="annee_p" id="annee_p"  value="<?php if (isset($_POST['annee_p'])) echo $_POST['annee_p'] ?>">
                </div>
                <div>
                    <label for="date_naiss">Date de naissance:</label>
                    <input type="text" name="date_naiss" id="date_naiss"   value="<?php  if (isset($_POST['date_naiss'])) echo $_POST['date_naiss'] ?>">
                </div>
                <div>
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email"  value="<?php  if (isset($_POST['email'])) echo $_POST['email'] ?>">
                </div>
                <div>
                    <label for="telephone">Téléphone:</label>
                    <input type="tel" name="telephone" id="telephone"   value="<?php if (isset($_POST['telephone'])) echo $_POST['telephone'] ?>">
                </div>
                <div>
        <label >Promotion</label> 
        <select name="id_p" id="" style="width: 200px; ">
            <option value="">  </option>
            <?php 
                $req = $db->query('select * from promotion');

                while($ligne = $req ->fetch()){
                    if(isset($_POST['id_p']) && $ligne['id_p']== $_POST['id_p']){
                        echo '<option value="'.$ligne['id_p'].'" selected>'.$ligne['nom_p'].''
                        .$ligne['annee_pro']. '</option>';
                    } else{
                        echo '<option value="'.$ligne['id_p'].'">'.$ligne['nom_p'].' '.
                        $ligne['annee_pro'].'</option>';
                    }
                }
            
            ?>
        </select>
    </div>
                <div>
                    <label for="image">Image:</label>
                    <input type="file" name="image" id="image">
                    <img src="" alt="Preview" id="image-preview" style="display: none; height:100px; width:100px;" value="<?php if (isset($_POST['image'])) echo $_POST['image'] ?>">

                </div>
                <br>
                <!-- <div>
                    <input type="submit" name="enregistrer" value="Enregistrer" style="color: black; background-color:orange; cursor:pointer; border:none; border-radius:10px;">
                </div> -->

                <?php if (isset($_GET['idm'])) { ?>
                <div>
                    <label for="">&nbsp;</label>
                    <input type="hidden" name="id_a" value="<?php if (isset($_POST['id_a'])) echo $_POST['id_a'] ?>">
                    <input type="submit" value="Modifier" name="modifier">
                </div>
            <?php } else { ?>
                <div>
                    <label for="">&nbsp;</label>
                    <input type="submit" value="Enregistrer" name="enregistrer">
                </div>
            <?php } ?>

            </form>
        </fieldset>
    </div>


    <script>
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('image-preview');

        imageInput.addEventListener('change', function() {
            const file = this.files[0];

            if (file) {
                const reader = new FileReader();

                reader.addEventListener('load', function() {
                    imagePreview.src = reader.result;
                    imagePreview.style.display = 'block';
                });

                reader.readAsDataURL(file);
            } else {
                imagePreview.src = '';
                imagePreview.style.display = 'none';
            }
        });
    </script>


  <script src="js/a.js"></script>

  


</body>

</html>
