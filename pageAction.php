<?php

// require_once './config/Database.php';

$db = new PDO('mysql:host=localhost;dbname=users','roo','');

try{
    if(!empty($_POST['gender']) && !empty($_POST['username']) && !empty($_POST['email']) 
&& !empty($_POST['phone']) && !empty($_POST['password']) && !empty($_POST['allergies'])){

    $req ="INSERT INTO restaurant_client (genre, nom_personne, email, telephone, 
    Mot_passe, allergies) values(:gender, :username, :email, :phone, :^password, :allergies)";

    $stmt = $db->prepare($req);

    $stmt->bindValue("gender",($_POST['gender'] === "female" ? 0 : 1),PDO::PARAM_BOOL); 
    $stmt->bindValue("username", $_POST['username'],PDO::PARAM_STR); 
    $stmt->bindValue("email", $_POST['email'],PDO::PARAM_STR); 
    $stmt->bindValue("phone", $_POST['phone'],PDO::PARAM_INT); 
    $stmt->bindValue("password", $_POST['password'],PDO::PARAM_STR); 
    $stmt->bindValue("allergies", $_POST['allergies'],PDO::PARAM_STR); 

    $stmt->execute();

};
}catch(PDOException $error){
    $error->getMessage();
}



// echo "Hello";
