<?php 

try {
    $db = new PDO('mysql:host=localhost; dbname=tp_php_odk','root','');
    // echo'Connexion etablie !';
} catch (Exception $e) {
    die($e->getMessage()); 
}

?>