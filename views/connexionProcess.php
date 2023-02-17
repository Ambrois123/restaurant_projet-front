<?php 
//appel de la base de données
require_once '../config/database.php';

//vérification des champs
if (isset($_POST['email']) && isset($_POST['password'])
&& isset($_POST['role']))
{
    //fonction de protection des données
    function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);
    $role = test_input($_POST['role']);
    
    //vérification des champs non remplis
    if(empty($email)){

        header("Location: ./connexion.php?error=Veuillez 
        renseigner votre adresse mail");

    }else if(empty($password)){

        header("Location: ./connexion.php?error=Veuillez 
        renseigner votre mot de passe");

    }else{

        echo "ok";

    // $req = "SELECT * FROM users WHERE email = :email AND password = :password";
    // $stmt = $db->prepare($req);
    // if ($stmt->execute(['email' => $email, 'password' => $password])) {
    //     $user = $stmt->fetch();
    //     if ($user) {
    //         session_start();
    //         $_SESSION['user'] = $user;
    //         header("Location: ../reservation.php");
    //     } else {
    //         header("Location: ../connexion.php?error=Vos 
    //             identifiants sont incorrects");
    //     }
    // }
}
}else{
    // header("Location: ../connexion.php");

    echo "error";
}

?>