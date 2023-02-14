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





    
            










            if(isset($_POST['reservation_btn'])){
                if($_SERVER['REQUEST_METHOD'] == "POST"){
            
                    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['phone'])
                    && isset($_POST['couvert']) && isset($_POST['date']) && isset($_POST['hour']) 
                    && isset($_POST['allergies']))
                    {
                        $pattern_email = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";//vérifie le format d'une adresse mail
                        $pattern_name = "/^[a-zA-Z]+$/"; // accepte que alphabet et espace
                        $pattern_phone = "/^[0-9]{10}$/"; // accepte que les chiffres
            
                        if(empty($_POST['username'])){
                            $err_username = "Veuillez renseigner votre nom et prénom";
            
                        }
                        if(!preg_match($pattern_name,$_POST['username'])){
                                $err_username_format = "Veuillez renseigner un nom et prénom valide";
            
                        }
                        if(empty($_POST['email'])){
                            $err_email = "Veuillez renseigner votre adresse mail";
                            
                        }
                        if(!preg_match($pattern_email,$_POST['email'])){
                            $err_email_format = "Veuillez renseigner une adresse mail valide";
            
                        }
                        if(empty($_POST['phone'])){
                            $err_phone = "Veuillez renseigner votre numéro de téléphone";
            
                        }
                        if(empty($_POST['couvert'])){
                            $err_couvert = "Veuillez renseigner le nombre de couverts";
            
                        }
                        if(!preg_match($pattern_phone,$_POST['phone'])){
                            $err_phone_format = "Veuillez renseigner un numéro de téléphone valide";
            
                        }    
                        if(empty($_POST['date'])){
                            $err_date = "Veuillez renseigner la date de votre réservation";
            
                        }
            
                        if(empty($_POST['hour'])){
                            $err_hour = "Veuillez renseigner l'horaire de votre réservation";
                        }
            
                        $username = $_POST['username'];
                        $email = $_POST['email'];
                        $phone = $_POST['phone'];
                        $couvert = $_POST['couvert'];
                        $date = $_POST['date'];
                        $hour = $_POST['hour'];
                        $allergies = $_POST['allergies'];
            
                        $req ="
                        INSERT INTO users (user_name, user_email, user_phone) 
                        VALUES (:username, :email, :phone);
                
                        INSERT INTO reservation (reservation_time, reservation_date, numberOfPeople)
                        VALUES (:hour, :date, :couvert);
                
                        INSERT INTO allergies (allergies_list)
                        VALUES (:allergies);
                        ";
            
                        $stmt = $db->prepare($req);
                        $stmt->bindParam(":user_name", $username);
                        $stmt->bindParam(":user_email", $email);
                        $stmt->bindParam(":user_phone", $phone);
                        $stmt->bindParam(":reservation_time", $hour);
                        $stmt->bindParam(":reservation_date", $date);
                        $stmt->bindParam(":numberOfPeople", $couvert);            
                        $stmt->bindParam(":allergies_list", $allergies);
            
                        if($stmt->execute()){
                            echo "Votre réservation a bien été prise en compte";
            
                        }else{
                            echo "Votre réservation n'a pas pu être enregistrer";
                        }
            
                    }
            
                    
                }
                
            }
    