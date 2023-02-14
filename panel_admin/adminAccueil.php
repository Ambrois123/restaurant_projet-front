<?php
    ob_start();
?>
<?php


    session_start();

    if(!isset($_SESSION['admin_login']))
    {
        header('location: ../accueil.php');
    }

    if(!isset($_SESSION['user_login']))
    {
        header('location: ../connexion.php');
    }

    if(isset($_SESSION['admin_login']))
    {
    ?>
    Bienvenue<?php
        echo $_SESSION['admin_login'];
    }
    ?>

    <button>
        <a href="../views/logout.php">Déconnexion</a>
    </button>


<?php
$titre = "<h1>Panel d'administration</h1>";
$content = ob_get_clean();
require_once './adminTemplate.php';

?>