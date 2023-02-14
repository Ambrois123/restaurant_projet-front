<?php

require_once 'config/database.php';

if (isset($_REQUEST['reservation_btn'])) 
{
    $username = $_REQUEST['username'];
    $email = $_REQUEST['email'];
    $phone = $_REQUEST['phone'];
    $couvert = $_REQUEST['couvert'];
    $date = $_REQUEST['date'];
    $hour = $_REQUEST['hour'];
    $allergies = $_REQUEST['allergies'];

    if(empty($username)){
        $error_msg[] = "Veuillez saisir votre nom ";
    }else if(empty($email)){
        $error_msg[] = "Veuillez saisir votre email ";
    }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error_msg[] = "Veuillez saisir un email valide ";
    }else if(empty($phone)){
        $error_msg[] = "Veuillez saisir votre numéro de téléphone ";
    }else if(empty($couvert)){
        $error_msg[] = "Veuillez saisir le nombre de couverts ";
    }else if(empty($date)){
        $error_msg[] = "Veuillez choisir la date de votre réservation ";
    }else if(empty($hour)){
        $error_msg[] = "Veuillez choisir l'horaire de votre réservation ";
    }else if(empty($alergies)){
        $error_msg[] = "Veuillez saisir vos allergies ou saisir aucune si vous n'en avez pas ";
    }else{
        try{
            $req = "
            INSERT INTO users (user_name, user_email, user_phone) 
            VALUES (:username, :email, :phone);

            INSERT INTO reservation (numberOfPeople, reservation_date, reservation_hour)
            VALUES (:couvert, :date, :hour);

            INSERT INTO allergies (allergies_list)
            VALUES (:allergies);
            ";
            $stmt = $db->prepare($req);
            $stmt->bindParam(":user_name", $username);
            $stmt->bindParam(":user_email", $email);
            $stmt->bindParam(":user_phone", $phone);
            $stmt->bindParam(":numberOfPeople", $couvert);
            $stmt->bindParam(":reservation_date", $date);
            $stmt->bindParam(":reservation_hour", $hour);
            $stmt->bindParam(":allergies_list", $allergies);
            
            if($stmt->execute()){
                echo "Votre réservation a bien été prise en compte";
            }

        }catch(PDOException $err){
            $err->getMessage();
        }
    }
       
}

?>