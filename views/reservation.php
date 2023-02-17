<?php

ob_start();
?>
<?php 
session_start();

?>
<?php 


require_once '../config/database.php';


$err_username = $err_username_format = $err_email = $err_email_fromat = $err_phone = $err_phone_format = $err_couvert = $err_date = $err_time = $err_allergies = "";
$username = $email = $phone = $couvert = $date = $time = $allergies = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //variables de vérification des champs vides et du format

    $isEmptyFields = false;
    $isFormtCorrect = false;

    // Vérification du champ username
    if (empty($_POST['username'])){
        $err_username = "Veuillez renseigner votre nom et prénom";
        $isEmptyFields = true;
    }else{
        $username = test_input($_POST['username']);

        // Vérification du format username
        if(!preg_match("/^[a-zA-Z ]*$/", $username)){
            $err_username_format = "Seules les lettres sont acceptées.";
            $isFormtCorrect = true;
        }
    }

    // Vérification du champ email
    if (empty($_POST['email'])){
        $err_email = "Veuillez renseigner votre adresse mail";
        $isEmptyFields = true;
    }else{
        $email = test_input($_POST['email']);

        // Vérification du format email
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $err_email_format = "Format Email Incorrect.";
            $isFormtCorrect = true;
        }
    }
    // Vérification du champ phone
    if (empty($_POST['phone'])){
        $err_phone = "Veuillez renseigner votre numéro de téléphone";
        $isEmptyFields = true;
    }else{
        $phone = test_input($_POST['phone']);

        // Vérification du format du numéro de téléphone
        if(!preg_match('/^[0-9]{10}+$/', $phone)){
            $err_phone_format = "Numéro de téléphone incorrect.";
            $isFormtCorrect = true;
        }
    }
    //Vérification du champ couvert
    if (empty($_POST['couvert'])){
        $err_couvert = "Veuillez renseigner le nombre de couverts";
        $isEmptyFields = true;
    }else{
        $couvert = test_input($_POST['couvert']);
    }
    //Vérification du champ date
    if (empty($_POST['date'])){
        $err_date = "Veuillez renseigner la date";
        $isEmptyFields = true;
    }else{
        $date = test_input($_POST['date']);
    }
    //Vérification du champ time
    if (empty($_POST['time'])){
        $err_time = "Veuillez renseigner l'heure";
        $isEmptyFields = true;
    }else{
        $time = test_input($_POST['time']);
    }
    //Vérification du champ allergies
    if (empty($_POST['allergies'])){
        $err_allergies = "Veuillez renseigner vos allergies";
        $isEmptyFields = true;
    }else{
        $allergies = test_input($_POST['allergies']);
    }

    //Déclarations des variables pour les requêtes
    $usersDatas = false;
    $reservationsDatas = false;
    $allergiesDatas = false;

    //exécution des requêtes
    if($isEmptyFields === false && $isFormtCorrect === false){
     //insertion des données dans la table users
        $reqUsers = "INSERT INTO users (user_name, user_email, user_phone) VALUES (:username, :email, :phone)";
        $stmtUsers = $db->prepare($reqUsers);
        $stmtUsers->bindParam(":username", $username, PDO::PARAM_STR);
        $stmtUsers->bindParam(":email", $email, PDO::PARAM_STR);
        $stmtUsers->bindParam(":phone", $phone, PDO::PARAM_STR);
        $usersDatas = $stmtUsers->execute();

    // Requête pour récupérer l'id de l'utilisateur

        $stmtGetUserId = $db->prepare("SELECT user_id FROM users WHERE user_email = :email");
        $stmtGetUserId->bindParam(":email", $email, PDO::PARAM_STR);
        $stmtGetUserId->execute();
        $userId = $stmtGetUserId->fetch(PDO::FETCH_ASSOC)['user_id'];//retourne un array

    // var_dump($userId);
    
    //insertion des données dans la table reservation
            $reqReservation = "INSERT INTO reservation (reservation_date, reservation_time, numberOfPeople, userId) 
            VALUES (:date, :time, :couvert, :userId)";
            $stmtReservation = $db->prepare($reqReservation);
            $stmtReservation->bindParam(":date", $date, PDO::PARAM_STR);
            $stmtReservation->bindParam(":time", $time, PDO::PARAM_STR);
            $stmtReservation->bindParam(":couvert", $couvert, PDO::PARAM_STR);
            $stmtReservation->bindValue(":userId", $userId, PDO::PARAM_INT);
            $reservationsDatas = $stmtReservation->execute();
    
    //  var_dump($userId);

    //  echo gettype($userId);
    //  echo gettype($stmtGetUserId);

    // Requête pour récupérer l'id de la réservation
        $stmtGetReservationId = $db->prepare("SELECT reservation_id FROM reservation WHERE numberOfPeople = :couvert");
        $stmtGetReservationId->bindParam(":couvert", $couvert, PDO::PARAM_INT);
        $stmtGetReservationId->execute();
        $reservationId =  $stmtGetReservationId->fetch(PDO::FETCH_ASSOC)['reservation_id'];//retourne un array
    
       //insertion des données dans la table allergies

       $reqAllergies = "INSERT INTO allergies (allergies_list, reservationId) VALUES (:allergies, :reservationId)";
       $stmtAllergies = $db->prepare($reqAllergies);
       $stmtAllergies->bindValue(":allergies", $allergies, PDO::PARAM_STR);
       $stmtAllergies->bindValue(":reservationId", $reservationId, PDO::PARAM_INT);
       $allergiesDatas = $stmtAllergies->execute();
    
    }

    if($usersDatas === true && $reservationsDatas === true && $allergiesDatas === true){

        //echo "Votre réservation a bien été prise en compte";

        header("Location: validateReservation.php");

    }else{

        echo "";

    }

}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
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
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

                <label for="username"></label>
                <input type="text" id="username" name="username" placeholder="Votre nom et prénom">
                
                <p class="error"><?php echo isset($err_username) ? $err_username: "";?></p>
                <p class="error"><?php echo isset($err_username_format) ? $err_username_format: "";?></p>
                
                
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
                
                
                <input type="date" id="date" name="date">
                <p class="error"><?php echo isset($err_date) ? $err_date: "";?></p>

                <input type="time" id="time" name="time">
                <p class="error"><?php echo isset($err_time) ? $err_time: "";?></p>

                
                <textarea name="allergies" id="allergies" cols="10" rows="10" placeholder="Des allergies ?"></textarea>
                <p class="error"><?php echo isset($err_allergies) ? $err_allergies: "";?></p>
                <div class="reservation_btn">
                    <input type="submit" name="reservation_btn" value="Réserver">
                </div>
            </form>
            </div>
        </div>
</main>


<?php
$content= ob_get_clean();

require_once("template.php");