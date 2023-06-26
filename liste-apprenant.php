<?php

session_start();


require "connexion.php";

$_SESSION['connected'] = true;

// Redirigez l'utilisateur vers la page protégée (index.php)
// header('Location: index.php');
// exit();


//suppression
if (isset($_GET['ids'])) {
    $db->query('delete from apprenant where id_a=' . $_GET['ids']);
    header('Location:liste-apprenant.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible"content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Liste Apprenant</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="liste-apprenant.css">
</head>

<?php include_once "header.php" ?>


<body>


 <h2 style="margin-left: 80vh;"> Les des apprenants   <strong>ODK certifiés</strong> </h2>
    
    <table >

        <tr>
            <th>Id</th>
            <th>N ° Matricule</th>
            <th>nom</th>
            <th>Prenom</th>
            <th>Annee</th>
            <th>Date de naissance</th>
            <th>Email</th>
            <th>Promotion</th>
            <th>Telephone</th>
            <!-- <th>Image</th> echo '<td>'. ' <img src='image/<?php echo $ligne['photo']; ?> > '</td>'; -->
            <th>Action</th>
        </tr>

        <?php
        $req = $db->query('Select * from apprenant join promotion on apprenant.id_a=promotion.id_p');
        $i = 1;
        while ($ligne = $req->fetch()) {
            echo '<tr>';
            // echo '<td>' . $i . '</td>';
            echo '<td>' . $i . '</td>';
            echo '<td>' . $ligne['mclle'] . '</td>';
            echo '<td>' . $ligne['nom'] . '</td>';
            echo '<td>' . $ligne['prenom'] . '</td>';
            echo '<td>' . $ligne['annee_p'] . '</td>';
            echo '<td>' . $ligne['date_naiss'] . '</td>';
            echo '<td>' . $ligne['email'] . '</td>';
            echo '<td>' . $ligne['nom_p'] . " "  .$ligne['annee_pro'] . '</td>';
            echo '<td>' . $ligne['telephone'] . '</td>';
            echo '<td>
            <a href="a.php?idm=' . $ligne['id_a'] .'"><i class="fas fa-edit" > </i></a>
            <a href="liste-apprenant.php?ids=' . $ligne['id_a'] .'"><i class="fas fa-trash" > </i></a>
            
            </td>';

            $i++;
            echo '</tr>';
        }
        ?>

    </table>

</body>

</html>