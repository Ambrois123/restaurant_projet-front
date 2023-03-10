<?php

ob_start();
?>
<?php 
session_start();
?>
<?php 


require_once '../config/database.php';


$err_couvert = $err_date = $err_allergies = "";
$couvert = $date = $allergies = "";


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
    //Vérification du champ allergies
    if (empty($_POST['allergies'])){
        $err_allergies = "Veuillez renseigner vos allergies. Saissisez 'Aucune' si vous n'en avez pas";
        $isEmptyFields = true;
    }else{
        $allergies = test_input($_POST['allergies']);
    }


    //exécution des requêtes
    if($isEmptyFields === false){

        $userId = $_SESSION['user_id'];
    
    //insertion des données dans la table reservation
            $reqReservation = "INSERT INTO reservation (reservation_time, numberGuests, allergies_list, userId) 
            VALUES (:date, :couvert, :allergies, :userId)";
            $stmtReservation = $db->prepare($reqReservation);
            $stmtReservation->bindParam(":date", $date);
            $stmtReservation->bindParam(":couvert", $couvert);
            $stmtReservation->bindParam(":allergies", $allergies);
            $stmtReservation->bindValue(":userId", $userId);

            if($stmtReservation->execute()){

                header('Location: validateReservations.php');//il ya un probleme ici !!!!:(
        
            }else{
        
                header("Location: resaNotValide.php");
        
            }
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
                <input type="number" min="0" id="couvert" name="couvert" placeholder="Nombre de couverts" value="<?php echo $couvert;?>">
                <p class="error"><?php echo isset($err_couvert) ? $err_couvert: "";?></p>
                
                
                <input type="datetime-local" id="date" name="date" value="<?php echo $date;?>">
                <p class="error"><?php echo isset($err_date) ? $err_date: "";?></p>

                
                <textarea name="allergies" id="allergies" cols="3" rows="3" placeholder="Des allergies ?" value="<?php echo $allergies;?>"></textarea>
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