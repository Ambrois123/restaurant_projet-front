<?php
ob_start();
?>

<?php

require_once '../config/database.php';

if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['phone'])
&& isset($_POST['password']) && isset($_POST['allergies'])){

    $pattern_email = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";//vérifie le format d'une adresse mail
    $pattern_name = "/^[a-zA-Z]+$/"; // accepte que alphabet et espace
    $pattern_phone = "/^[0-9]{10}$/"; // accepte que les chiffres

    // Vérification du champ username
    if(empty($_POST['username'])){
        $err_username = "Veuillez renseigner votre nom et prénom";

    }

    // Vérification du format username
    if(!preg_match($pattern_name,$_POST['username'])){
            $err_username_format = "Veuillez renseigner un nom et prénom valide";

    }

    // Vérification du champ email
    if(empty($_POST['email'])){
        $err_email = "Veuillez renseigner votre adresse mail";
        
    }

    // Vérification du format email
    if(!preg_match($pattern_email,$_POST['email'])){
        $err_email_format = "Veuillez renseigner une adresse mail valide";

    }

    // Vérification du champ phone
    if(empty($_POST['phone'])){
        $err_phone = "Veuillez renseigner votre numéro de téléphone";

    }

    // Vérification du format phone

    if(!preg_match($pattern_phone,$_POST['phone'])){
        $err_phone_format = "Veuillez renseigner un numéro de téléphone valide";

    }

    //verification d'un mot de passe fort

    $password = '';
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password)){
        echo "Mot e passe faible";
    } else{
        echo "Le mot de passe est fort";
    }

    //Réception des données du formulaire
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    // $allergies = $_POST['allergies'];

    $req = "INSERT INTO client (user_name, user_email, user_phone, user_password) 
    VALUES (:username, :email, :phone, :password)";

    $stmt = $db->prepare($req);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

}

?>

<main class="main_container_client">
        <section class="container_client">
            <div class="container_client_title">
                <h1>Devenez client</h1>
                <p>Nous serons à vos côtés pour l'organisation 
                    de vos événements privés. Vous serez aussi 
                    informés des nouveautés de votre restaurant.
                </p>
            </div>
            <div class="container_client_form">
                <form action="" method="post">   
                    <label for="username"></label>
                    <input type="text" id="username" name="username" placeholder="Votre nom et prénom">

                    <label for="email"></label>
                    <input type="email" id="email" name="email" placeholder="Votre adresse mail">

                    <label for="phone"></label>
                    <input type="tel" id="phone" name="phone" placeholder="Votre numéro de téléphone">

                    <label for="password"></label>
                    <input type="password" id="password" name="password" placeholder="Choisir votre mot de passe">
                    
                    
                    
                    <div class="client_btn">
                        <input type="submit" value="Valider">
                    </div>
                </form>
            </div>
        </section>
    </main>

<?php
$content= ob_get_clean();

require_once("template.php");