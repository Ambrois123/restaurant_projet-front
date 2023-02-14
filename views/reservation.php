<?php

ob_start();
?>

<?php  

require_once '../config/database.php';


if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['phone'])
&& isset($_POST['couvert']) && isset($_POST['date']) && isset($_POST['hour']) && isset($_POST['allergies']))
{
    $pattern_email = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";//vérifie le format d'une adresse mail
    $pattern_name = "/^[a-zA-Z]+$/"; // acepete que alphabet et espace
    $pattern_phone = "/^[0-9]{10}$/"; // acepte que les chiffres

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

    if(isset($POST['resevation_btn'])){
        if($err_username =="" && $err_username_format && $err_email =="" 
        && $err_email_format =="" && $err_phone =="" && $err_phone_format =="" 
        && $err_couvert =="" && $err_date =="" && $err_hour ==""){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $couvert = $_POST['couvert'];
            $date = $_POST['date'];
            $hour = $_POST['hour'];
            $allergies = $_POST['allergies'];
        }
        
    }

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
                
                <label for="date"></label>
                <input type="date" id="date" name="date" placeholder="Date">
                <p class="error"><?php echo isset($err_date) ? $err_date: "";?></p>
                

               
                    
                <label for="hour"></label>
                <select id="lunch" name="hour">
                  <option value="" selected="selected">Chosissez votre horaire</option>
                  <option value="lunch-tranch1">12:00</option>
                  <option value="lunch-tranch2">12:30</option>
                  <option value="lunch-tranch3">13:00</option>
                  <option value="lunch-tranch4">13:30</option>
                  <option value="lunch-tranch5">14:00</option>
                </select>
                <p class="error"><?php echo isset($err_hour) ? $err_hour: ""?></p>
                
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

require_once("template.php");