<?php 

require_once '../config/database.php';

$email = $password = $role = "";

if($_SERVER['REQUEST_METHOD'] == "POST"){

    if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['role'])
    && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['role'])){

        function test_input($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $email = test_input($_POST['email']);
        $password = test_input($_POST['password']);
        $role = test_input($_POST['role']);

        $req = "SELECT * FROM users WHERE user_email = :email";
        $stmt = $db->prepare($req);
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        echo "<pre>";
        print_r($row);
        echo "</pre>";

        if($row['user_email'] == $email && $row['user_password'] == $password 
        && $row['role'] == $role){

            //récupération du role de l'utilisateur
            $user_role = $row['role'];
            echo $user_role;

            //débuter une nouvelle session
            
            session_start();

            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['role'] = $user_role;

            //redirection en fonction du role

            if($user_role == 'admin'){
                header('Location: ../panel_admin/adminAccueil.php');

            }else if ($user_role == 'client'){
                header('Location: resaValidateClient.php');

            }else {
                echo "Erreur";
            }   
            
        }


    }
    
    // $email = $_POST['email'];
    // $password = $_POST['password'];

    // //requête pour vérifier si l'utilisateur existe dans la base de données
    // $req = "SELECT * FROM users WHERE user_email = :email";
    // $stmt = $db->prepare($req);
    // $stmt->execute(['email' => $email]);
    // $row = $stmt->fetch(PDO::FETCH_ASSOC);

    //Vérification si il y a une correspondance et si mot de passe est correct
// if ($row && password_verify($password, $row['user_password'])) {
//     //récupération du role de l'utilisateur
//     $user_role = $row['role'];

//     //débuter une nouvelle session

//     session_start();

//     $_SESSION['user_id'] = $row['id'];
//     $_SESSION['role'] = $user_role;

//     //redirection

//     if ($user_role == 'admin') {
//         header('Location: ../panel_admin/adminAccueil.php');
//     } elseif ($user_role == 'user') {
//         header('Location: ../resaValidateClient.php');
//     }
//     exit();
// }else {
//     echo "Email ou mot de passe incorrect";
// }
    
}

?>
