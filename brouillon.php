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

            $username = $_POST['username'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $couvert = $_POST['couvert'];
            $date = $_POST['date'];
            $allergies = $_POST['allergies'];

            $stmtGetUserId = $db->prepare("SELECT user_id FROM users WHERE user_email = :email");
            $stmtGetUserId->bindParam(":email", $email, PDO::PARAM_STR);
            $stmtGetUserId->execute();
            $userId = $stmtGetUserId->fetch(PDO::FETCH_ASSOC);

            $stmtGetReservationId = $db->prepare("SELECT reservation_id FROM reservation WHERE reservation_datetime = :date");
            $stmtGetReservationId->bindParam(":date", $date, PDO::PARAM_STR);
            $stmtGetReservationId->execute();
            $reservationId = $stmtGetReservationId->fetch(PDO::FETCH_ASSOC);
            

            $reqUsers ="
                INSERT INTO users (user_name, user_email, user_phone)VALUES (:username, :email, :phone);
                
            ";
            $reqReservation ="
                INSERT INTO reservation (reservation_datetime, numberOfPeople, userId) 
                VALUES (:date, :couvert, :userId);
            ";
            $reqAllergies ="
                INSERT INTO allergies (allergies_list, reservationId)
                VALUES (:allergies, :reservationId);
            ";

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

                        echo "Votre réservation a bien été prise en compte";

                    }else{

                        echo "Votre réservation n'a pas pu être enregistrer";

                    }
                }
            }
        }

    }
}




?>


<main class="main_container_reservation">
        <div class="container_reservation">
            <div class="container_reservation_title">
                <h1>Réservez votre table</h1>
                <p>Le restaurant vous accueille dans un 
                    cadre exceptionnel pour des moments inoubliables.</p>
            </div>
            <div class="container_reservation_form">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                <label for="username"></label>
                <input type="text" id="username" name="username" placeholder="Votre nom et prénom">
                
                <p class="error"><?php echo isset($err_username) ? $err_username: "";?></p>
                
                
                <label for="email"></label>
                <input type="email" id="email" name="email" placeholder="Votre adresse mail">
                <p class="error"><?php echo isset($err_email) ? $err_email: ""?></p>
                <p class="error"><?php echo isset($err_email_format) ? $err_email_format: "";?></p>

                <label for="phone"></label>
                <input type="tel" id="phone" name="phone" placeholder="Votre numéro de téléphone">
                <p class="error"><?php echo isset($err_phone) ? $err_phone: ""?></p>
                <p class="error"><?php echo isset($err_phone_format) ? $err_phone_format: "";?></p>
                 
                <label for="couvert"></label>
                <input type="number" min="0" id="couvert" name="couvert" placeholder="Couverts">
                <p class="error"><?php echo isset($err_couvert) ? $err_couvert: "";?></p>
                
                
                <input type="datetime-local" id="date" name="date">
                <p class="error"><?php echo isset($err_date) ? $err_date: "";?></p>

                
                <textarea name="allergies" id="allergies" cols="10" rows="10" placeholder="Des allergies ?"></textarea>
                <div class="reservation_btn">
                    <input type="submit" name="reservation_btn" value="Réserver">
                </div>
            </form>
            </div>
        </div>
</main>


<?php
$content= ob_get_clean();

require_once("template.php"