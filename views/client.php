<?php
ob_start();
?>
<?php 
session_start();
?>

<?php

require_once '../config/database.php';

//Déclaration des variables avec les données du formulaire
$username = $email = $phone = $password = "";
$role = 'client';

//Déclaration des variables des erreurs
$err_username = $err_username_format = $err_email = $err_email_format = $err_phone = $err_phone_format = $err_password = $err_password_format = "";

if ($_SERVER['REQUEST_METHOD'] =="POST") {
    //variables de vérification des champs vides et du format

    $isEmptyFields = false;
    $isFormatCorrect = false;

    // Vérification du champ username
    if (empty($_POST['username'])) {
        $err_username = "Veuillez renseigner votre nom et prénom";
        $isEmptyFields = true;
    } else {
        $username = test_input($_POST['username']);

        // Vérification du format username
        if (!preg_match("/^[a-zA-Z ]*$/", $username)) {
            $err_username_format = "Seules les lettres sont acceptées.";
            $isFormatCorrect = true;
        }
    }

    // Vérification du champ email
    if (empty($_POST['email'])) {
        $err_email = "Veuillez renseigner votre adresse mail";
        $isEmptyFields = true;
    } else {
        $email = test_input($_POST['email']);

        // Vérification du format email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $err_email_format = "Format Email Incorrect.";
            $isFormatCorrect = true;
        }
    }

    // Vérification du champ phone
    if (empty($_POST['phone'])) {
        $err_phone = "Veuillez renseigner votre numéro de téléphone";
        $isEmptyFields = true;
    } else {
        $phone = test_input($_POST['phone']);

        // Vérification du format du numéro de téléphone
        if (!preg_match('/^[0-9]{10}+$/', $phone)) {
            $err_phone_format = "Numéro de téléphone incorrect.";
            $isFormatCorrect = true;
        }
    }

    // Vérification du champ password
    if (empty($_POST['password'])) {
        $err_password = "Veuillez renseigner votre mot de passe";
        $isEmptyFields = true;
    } else {
        $password = test_input($_POST['password']);
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);


        //valider un password fort

        $pwd_pattern = '#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#';
        if (!preg_match($pwd_pattern,$password)){
            $err_password_format = "Mot de passe incorrect.";
            $isFormatCorrect= true;
        } 
        
    }

    //Déclaration des variables pour la requête
    $usersDatas = false;

    //Exécution de la requête si tous les champs sont remplis et si le format est correct
    if ($isEmptyFields === false && $isFormatCorrect === false) 
    {
        $req = "INSERT INTO users (user_name, user_email,role, user_phone, user_password) 
        VALUES (:username, :email, :role, :phone, :password)";
        $stmt = $db->prepare($req);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':role', $role, PDO::PARAM_STR);
        $stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindValue(':password', $hashed_password, PDO::PARAM_STR);
        $usersDatas = $stmt->execute();

        // Requête pour récupérer l'id de l'utilisateur

        $stmtGetUserId = $db->prepare("SELECT user_id FROM users WHERE user_email = :email");
        $stmtGetUserId->bindParam(":email", $email, PDO::PARAM_STR);
        $stmtGetUserId->execute();
        $userId = $stmtGetUserId->fetch(PDO::FETCH_ASSOC)['user_id'];

    }

    if ($usersDatas === true) {
        header('Location: validateClient.php');
    } else {
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

<main class="main_container_client">
        <section class="container_client">
            <div class="container_client_title">
                <h1>Devenez client</h1>
                <p>Nous serons à vos côtés pour l'organisation 
                    de vos événements privés. Vous serez aussi 
                    informés des nouveautés de votre restaurant.
                </p>
            </div>
            <div class="container_client_form">
                <form action="" method="post">   
                    <label for="username"></label>
                    <input type="text" id="username" name="username" placeholder="Votre nom et prénom" value="<?php echo $username;?>">
                    <p class="error"><?php echo isset($err_username) ? $err_username: "";?></p>
                    <p class="error"><?php echo isset($err_username_format) ? $err_username_format: "";?></p>

                    <label for="email"></label>
                    <input type="email" id="email" name="email" placeholder="Votre adresse mail" value="<?php echo $email;?>">
                    <p class="error"><?php echo isset($err_email) ? $err_email: ""?></p>
                    <p class="error"><?php echo isset($err_email_format) ? $err_email_format: "";?></p>

                    <label for="phone"></label>
                    <input type="tel" id="phone" name="phone" placeholder="Votre numéro de téléphone" value="<?php echo $phone;?>">
                    <p class="error"><?php echo isset($err_phone) ? $err_phone: ""?></p>
                    <p class="error"><?php echo isset($err_phone_format) ? $err_phone_format: "";?></p>

                    <label for="password"></label>
                    <p class="password">Le mot de passe doit contenir entre 8 et 20 caractères, une majuscule, une minuscule et un chiffre.</p>
                    <input type="password" id="password" name="password" placeholder="Choisir votre mot de passe" value="<?php echo $password;?>">
                    <p class="error"><?php echo isset($err_password) ? $err_password: ""?></p>
                    <p class="error"><?php echo isset($err_password_format) ? $err_password_format: "";?></p>

                    <select name="role" id="role" style="display:none;">
                        <option value="client">client/option>
                    </select>
                    
                    
                    
                    <div class="client_btn">
                        <input type="submit" value="Valider">
                    </div>
                </form>
            </div>
        </section>
    </main>
<?php 

$_SESSION['username'] = $username;
$_SESSION['email'] = $email;
$_SESSION['phone'] = $phone;
$_SESSION['user_id'] = $userId;

?>

<?php
$content= ob_get_clean();

require_once("template.php");