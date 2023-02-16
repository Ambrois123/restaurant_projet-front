<?php

<?php  

require_once '../config/database.php';

if(isset($_POST['reservation_btn'])){
    if($_SERVER['REQUEST_METHOD'] == "POST"){

        if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['phone'])
        && isset($_POST['couvert']) && isset($_POST['date']) && isset($_POST['allergies']))
        {
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

            //Vérification du champ couvert
            if(empty($_POST['couvert'])){
                $err_couvert = "Veuillez renseigner le nombre de couverts";
            }

            //Vérification du champ date
            if(empty($_POST['date'])){
                $err_date = "Veuillez renseigner la date de votre réservation";

            }

            //collecte des données desc hamps

            $username = $_POST['username'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $couvert = $_POST['couvert'];
            $date = $_POST['date'];
            $allergies = $_POST['allergies'];

            // Requête pour récupérer l'id de l'utilisateur

            $stmtGetUserId = $db->prepare("SELECT user_id FROM users WHERE user_email = :email");
            $stmtGetUserId->bindParam(":email", $email, PDO::PARAM_STR);
            $stmtGetUserId->execute();
            $userId = $stmtGetUserId->fetch(PDO::FETCH_ASSOC)["user_id"];

            echo "<pre>";
            print_r($userId);
            echo "</pre>";
            

            // Requête pour récupérer l'id de la réservation

            $stmtGetReservationId = $db->prepare("SELECT reservation_id FROM reservation WHERE reservation_datetime = :date");
            $stmtGetReservationId->bindParam(":date", $date, PDO::PARAM_STR);
            $stmtGetReservationId->execute();
            $reservationId = $stmtGetReservationId->fetch(PDO::FETCH_ASSOC)["reservation_id"];
            // Requête pour insérer les données dans la table users

            echo "<pre>";
            print_r($reservationId);
            echo "</pre>";

            $reqUsers ="
                INSERT INTO users (user_name, user_email, user_phone)VALUES (:username, :email, :phone)";

            // Requête pour insérer les données dans la table reservation
            $reqReservation ="
                INSERT INTO reservation (reservation_datetime, numberOfPeople, userId) 
                VALUES (:date, :couvert, :userId)";

            // Requête pour insérer les données dans la table allergies
            $reqAllergies ="
                INSERT INTO allergies (allergies_list, reservationId)
                VALUES (:allergies, :reservationId);
            ";

            // Préparation des requêtes

            $stmtUsers = $db->prepare($reqUsers);
            $stmtUsers->bindParam(":username", $username, PDO::PARAM_STR);
            $stmtUsers->bindParam(":email", $email, PDO::PARAM_STR);
            $stmtUsers->bindParam(":phone", $phone, PDO::PARAM_INT);

            if($stmtUsers->execute()){

                $stmtReservation = $db->prepare($reqReservation);
                $stmtReservation->bindParam(":date", $date, PDO::PARAM_STR);
                $stmtReservation->bindParam(":couvert", $couvert, PDO::PARAM_INT);
                $stmtReservation->bindParam(":userId", $userId, PDO::PARAM_INT);

                if($stmtReservation->execute()){

                    $stmtAllergies = $db->prepare($reqAllergies);
                    $stmtAllergies->bindParam(":allergies", $allergies, PDO::PARAM_STR);
                    $stmtAllergies->bindParam(":reservationId", $reservationId, PDO::PARAM_INT);

                    if ($stmtAllergies->execute()) {

                        //action à faire si la requête s'est bien exécutée

                        echo "Votre réservation a bien été prise en compte";

                    }else{

                        //action à faire si la requête n'a pas pu s'exécuter

                        echo "Votre réservation n'a pas pu être enregistrer";

                    }
                }
            }
        }

    }
}

<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>


?>

