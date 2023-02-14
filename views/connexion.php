<?php 
ob_start();
?>

<?php
//connexion à la BDD
require_once './config/database.php';

session_start();

//définition des sessions admin et client. Si elles sont trouvées alors les liens définis dans header s'ouvriront.
if (isset($_SESSION['admin_login'])){
    header ("location: ../panel_admin/adminAccueil.php");
}
if (isset($_SESSION['user_login'])){
    header ("location: reservation.php");
}

if(isset($_REQUEST['btn_login']))
{
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $role = $_REQUEST['role'];

    if (empty($email)){
        $err_msg[] = "Veuillez saisir votre email";
    }else if (empty($password)){
        $err_msg[] = "Veuillez saisir votre mot de passe";
    }else if (empty($role)){
        $err_msg[] = "Veuillez sélectionner votre rôle";
    } else if ($email && $password && $role)
    {
        try{
            $req = "SELECT email, password, role FROM users
            WHERE
            email=:email AND password=:password AND role=:role";
            $stmt = $db->prepare($req);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":role", $role);
            $stmt->execute();

            while ($row=$stmt->fetch(PDO::FETCH_ASSOC))
            {
                $dbemail = $row['email'];
                $dbpassword = $row['password'];
                $dbrole = $row['role'];
            }

            if($email!=null AND $password!=null AND $role!=null){

                if ($stmt->rowCount() > 0){

                    if($email==$dbemail AND $password==$dbpassword AND $role==$dbrole){
                        switch($dbrole){
                            case "admin":
                                $_SESSION['admin_login'] = $email;
                                $login_msg = "Bienvenue". $email;
                                header("refresh:3;../panel_admin/adminAccueil.php");
                                break;

                            case "user":
                                $_SESSION['admin_user'] = $email;
                                $login_msg = "Bienvenue". $email;
                                header("refresh:3;reservation.php");
                            
                            default:
                                $error_msg[] = "Vos identifiants sont incorrects";
                        }
                    }else {$error_msg[] = "Vos identifiants sont incorrects";
                    }
                }else {$error_msg[] = "Vos identifiants sont incorrects";
                }
            }else {$error_msg[] = "Vos identifiants sont incorrects";
            
            }

        }catch(PDOException $err){
            $err->getMessage();
        }

    }else{
        $err_msg[] = "Votre identification est incorrecte. Veuillez resaisir vos identifiants.";
    }
}



?>

<main class="main_container_connexion">
        <section class="container_connexion">
            <div class="container_connexion_title">
                <h1>Page de connexion</h1>
                <p>Chers-es clients -tes connectez-vous à votre compte et laissez-vous guider.</p>
            </div>
            <div class="container_connexion_form">
                <form action="" method="post">
                    <label for="email"></label>
                    <input type="email" id="email" name="email" placeholder="Votre adresse mail">

                    <label for="password"></label>
                    <input type="password" id="password" name="password" placeholder="Votre mot de passe">

                    <div class="select-form">
                        <select name="role" id="role">
                            <option value="" selected="selected">- En tant que -</option>
                            <option value="user">Client</option>
                            <option value="admin">administrateur</option>
                        </select>
                    </div>
                    
                    <div class="connexion_btn">
                        <input type="submit" name="btn_login" value="Valider">
                    </div>
                </form>
            </div>
        </section>
    </main>

<?php
$content = ob_get_clean();
require_once("template.php");
