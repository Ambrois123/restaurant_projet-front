<?php

$sql = "INSERT INTO reservation (username, email, phone, couvert, date, lunch, diner, allergies) VALUES (:username, :email, :phone, :couvert, :date, :lunch, :diner, :allergies)";
    $stmt = $db->prepare($sql);
    $stmt->execute(array(':username' => $username, ':email' => $email, ':phone' => $phone, ':couvert' => $couvert, ':date' => $date, ':lunch' => $lunch, ':diner' => $diner, ':allergies' => $allergies));
    header('Location: index.php');




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