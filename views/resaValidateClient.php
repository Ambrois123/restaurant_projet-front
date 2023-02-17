<?php

ob_start();
?>
<?php 
session_start();

?>
<?php 


require_once '../config/database.php';


$err_couvert = $err_date = $err_time = $err_allergies = "";
$couvert = $date = $time = $allergies = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //variables de vérification des champs vides et du format

    $isEmptyFields = false;

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

    //Déclaration des variables pour les requêtes
    
    $reservationsDatas = false;
    $allergiesDatas = false;

    //exécution des requêtes
    if($isEmptyFields === false && $isFormtCorrect === false){

    // Requête pour récupérer l'id de l'utilisateur

        $stmtGetUserId = $db->prepare("SELECT user_id FROM users WHERE user_email = :email");
        $stmtGetUserId->bindParam(":email", $email, PDO::PARAM_STR);
        $stmtGetUserId->execute();
        $userId = $stmtGetUserId->fetch(PDO::FETCH_ASSOC)['user_id'];//retourne un array

    var_dump($userId);
    
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

    if($reservationsDatas === true && $allergiesDatas === true){

        //echo "Votre réservation a bien été prise en compte";

        header("Location: ./validateReservations.php");

    }else{

        // echo "";
        header("Location: resaNotValide.php");

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
                <h1>Bonjour <?php echo $_SESSION['username']; ?>, complétez le formulaire</h1>
                <p>Le restaurant, le plaisir de vous accueillir.</p>
            </div>
            <div class="container_reservation_form">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
         
                <label for="couvert"></label>
                <input type="number" min="0" id="couvert" name="couvert" placeholder="Couverts">
                <p class="error"><?php echo isset($err_couvert) ? $err_couvert: "";?></p>
                
                
                <input type="date" id="date" name="date">
                <p class="error"><?php echo isset($err_date) ? $err_date: "";?></p>

                <input type="time" id="time" name="time">
                <p class="error"><?php echo isset($err_time) ? $err_time: "";?></p>

                
                <textarea name="allergies" id="allergies" cols="3" rows="3" placeholder="Des allergies ?"></textarea>
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