<?php 

require_once '../config/database.php';

if (isset($_POST['email']) && isset($_POST['password'])
&& isset($_POST['role']))
{

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

    if(empty($email)){
        header("Location: ../connexion.php?error=Veuillez 
        renseigner votre adresse mail");
    }else if(empty($password)){
        header("Location: ../connexion.php?error=Veuillez 
        renseigner votre mot de passe");
    }else{
    $req = "SELECT * FROM users WHERE email = :email AND password = :password";
    $stmt = $db->prepare($req);
    if ($stmt->execute(['email' => $email, 'password' => $password])) {
        $user = $stmt->fetch();
        if ($user) {
            session_start();
            $_SESSION['user'] = $user;
            header("Location: ../reservation.php");
        } else {
            header("Location: ../connexion.php?error=Vos 
                identifiants sont incorrects");
        }
    }
}
}else{
    header("Location: ../connexion.php");
}

?>