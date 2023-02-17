<?php

require_once '../config/database.php';


    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['phone'])
        && isset($_POST['couvert']) && isset($_POST['date']) && isset($POST_['time']) && isset($_POST['allergies']))
        {
            // Vérification du champ username
                if (empty($_POST['username'])) {
                    $err_username = "Veuillez renseigner votre nom et prénom";
                }
            
    //Fonction de validation du formulaire
        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    //collecte des données des champs

        $username = test_input($_POST['username']);
        $email = test_input($_POST['email']);
        $phone = test_input($_POST['phone']);
        $couvert = test_input($_POST['couvert']);
        $date = test_input($_POST['date']);
        $time = test_input($_POST['time']);
        $allergies = test_input($_POST['allergies']);
        
        echo "tout est ok";

    }else{
        echo "il y a un problème";
    }


?>

if ($_SERVER['REQUEST_METHOD'] == "POST") 
{}
    

$pattern_email = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";//vérifie le format d'une adresse mail
        $pattern_name = "/^[a-zA-Z]+$/"; // accepte que alphabet et espace
        $pattern_phone = "/^[0-9]{10}$/"; // accepte que les chiffres
    
        // Vérification du champ username
        if (empty($_POST['username'])) {
            $err_username = "Veuillez renseigner votre nom et prénom";
        }
    
        // Vérification du format username
        if (!preg_match($pattern_name, $_POST['username'])) {
            $err_username_format = "Veuillez renseigner un nom et prénom valide";
        }
    
        // Vérification du champ email
        if (empty($_POST['email'])) {
            $err_email = "Veuillez renseigner votre adresse mail";
        }
    
        // Vérification du format email
        if (!preg_match($pattern_email, $_POST['email'])) {
            $err_email_format = "Veuillez renseigner une adresse mail valide";
        }
    
        // Vérification du champ phone
        if (empty($_POST['phone'])) {
            $err_phone = "Veuillez renseigner votre numéro de téléphone";
        }
    
        // Vérification du format phone
        if (!preg_match($pattern_phone, $_POST['phone'])) {
            $err_phone_format = "Veuillez renseigner un numéro de téléphone valide";
        }
    
        //Vérification du champ couvert
        if (empty($_POST['couvert'])) {
            $err_couvert = "Veuillez renseigner le nombre de couverts";
        }
    
        //Vérification du champ date
        if (empty($_POST['date'])) {
            $err_date = "Veuillez renseigner la date de votre réservation";
        }
    
        //Vérification du champ time
        if (empty($_POST['time'])) {
            $err_time = "Veuillez renseigner l'heure de votre réservation";
        }
    
        //Vérification du champ allergies
        if (empty($_POST['allergies'])) {
            $err_allergies = "Veuillez renseigner 'aucune' si vous n'avez pas d'allergies";
        }




// Requête pour récupérer l'id de l'utilisateur

$stmtGetUserId = $db->prepare("SELECT user_id FROM users WHERE user_email = :email");
$stmtGetUserId->bindParam(":email", $email, PDO::PARAM_STR);
$stmtGetUserId->execute();
$userId = $stmtGetUserId->fetch(PDO::FETCH_ASSOC)['user_id'];

// echo gettype($userId);

// echo "<pre>";
// print_r($userId);
// echo "</pre>";

// Requête pour récupérer l'id de la réservation
$stmtGetReservationId = $db->prepare("SELECT reservation_id FROM reservation WHERE numberOfPeople = :numberOfPeople");
$stmtGetReservationId->bindParam(":couvert", $couvert, PDO::PARAM_INT);
$stmtGetReservationId->execute();
$reservationId = $stmtGetReservationId->fetch(PDO::FETCH_ASSOC);

//echo gettype($reservationId);


var_dump ($reservationId);


// Requête pour insérer les données dans la table users

$reqUsers ="INSERT INTO users (user_name, user_email, user_phone)VALUES (:username, :email, :phone)";

// Requête pour insérer les données dans la table reservation
$reqReservation ="INSERT INTO reservation (reservation_date, reservation_time, numberOfPeople, userId) VALUES (:date, :couvert, :userId)";

// Requête pour insérer les données dans la table allergies
$reqAllergies ="INSERT INTO allergies (allergies_list, reservationId) VALUES (:allergies, :reservationId);
        ";



// Préparation des requêtes Users

$stmtUsers = $db->prepare($reqUsers);
$stmtUsers->bindParam(":username", $username, PDO::PARAM_STR);
$stmtUsers->bindParam(":email", $email, PDO::PARAM_STR);
$stmtUsers->bindParam(":phone", $phone, PDO::PARAM_INT);

// Préparation des requêtes Reservation
$stmtReservation = $db->prepare($reqReservation);
$stmtReservation->bindParam(":date", $date, PDO::PARAM_STR);
$stmtReservation->bindParam(":time", $time, PDO::PARAM_STR);
$stmtReservation->bindParam(":couvert", $couvert, PDO::PARAM_INT);
$stmtReservation->bindParam(":userId", $userId, PDO::PARAM_INT);

// Préparation des requêtes Allergies
$stmtAllergies = $db->prepare($reqAllergies);
$stmtAllergies->bindParam(":allergies", $allergies, PDO::PARAM_STR);
$stmtAllergies->bindParam(":reservationId", $reservationId, PDO::PARAM_INT);

// Exécution des requêtes

if ($stmtUsers->execute() && $stmtReservation->execute() && $stmtAllergies->execute()) {
    //action à faire si la requête s'est bien exécutée

    echo "Votre réservation a bien été prise en compte";
} else {
    //action à faire si la requête n'a pas pu s'exécuter

    echo "Votre réservation n'a pas pu être enregistrer";
}
}




<?php
//connexion à la BDD
require_once './config/database.php';

session_start();

//définition des sessions admin et client. Si elles sont trouvées alors les liens définis dans header s'ouvriront.
if (isset($_SESSION['admin_login'])){
    header ("location: ../panel_admin/adminAccueil.php");
}
if (isset($_SESSION['user_login'])){
    header ("location: reservation.php");
}

if(isset($_REQUEST['btn_login']))
{
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $role = $_REQUEST['role'];

    if (empty($email)){
        $err_msg[] = "Veuillez saisir votre email";
    }else if (empty($password)){
        $err_msg[] = "Veuillez saisir votre mot de passe";
    }else if (empty($role)){
        $err_msg[] = "Veuillez sélectionner votre rôle";
    } else if ($email && $password && $role)
    {
        try{
            $req = "SELECT email, password, role FROM users
            WHERE
            email=:email AND password=:password AND role=:role";
            $stmt = $db->prepare($req);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":role", $role);
            $stmt->execute();

            while ($row=$stmt->fetch(PDO::FETCH_ASSOC))
            {
                $dbemail = $row['email'];
                $dbpassword = $row['password'];
                $dbrole = $row['role'];
            }

            if($email!=null AND $password!=null AND $role!=null){

                if ($stmt->rowCount() > 0){

                    if($email==$dbemail AND $password==$dbpassword AND $role==$dbrole){
                        switch($dbrole){
                            case "admin":
                                $_SESSION['admin_login'] = $email;
                                $login_msg = "Bienvenue". $email;
                                header("refresh:3;../panel_admin/adminAccueil.php");
                                break;

                            case "user":
                                $_SESSION['admin_user'] = $email;
                                $login_msg = "Bienvenue". $email;
                                header("refresh:3;reservation.php");
                            
                            default:
                                $error_msg[] = "Vos identifiants sont incorrects";
                        }
                    }else {$error_msg[] = "Vos identifiants sont incorrects";
                    }
                }else {$error_msg[] = "Vos identifiants sont incorrects";
                }
            }else {$error_msg[] = "Vos identifiants sont incorrects";
            
            }

        }catch(PDOException $err){
            $err->getMessage();
        }

    }else{
        $err_msg[] = "Votre identification est incorrecte. Veuillez resaisir vos identifiants.";
    }
}



?>