<?php
ob_start();
?>
<?php


?>
<main class="main_container_client">
    <section class="container_client">
        <div class="container_client_title">
            <h4>LE RESTAURANT, Le plaisir de vous recevoir</h4>
            <p>Bonjour, <?php echo $_SESSION['username']; ?>  </p>
            <p>LE RESTAURANT vous remercie pour votre réservation. Le résumé de votre réservation :</p>
            <ul>
                <li>Date : <?php echo $_SESSION['date']; ?>  </li>
                <li>Heure: <?php echo $_SESSION['time']; ?>  </li>
                <li>Nombre de couverts: <?php echo $_SESSION['couverts']; ?>  </li>
                <li>Vous êtes allergiques à <?php echo $_SESSION['allergies']; ?>  </li>
            </ul>
            <p>Vous pouvez vous déconnecter en cliquant sur le bouton de déconnexion</p>
            <div class="btn_logout_validation">
                <button class="btn_deconnexion">
                    <a href="./accueil.php">Déconnexion</a>
                </button>
            </div>
            
            <p>La Direction</p>
        </div>
    </section>
</main>

<?php 


?>

<?php
$content= ob_get_clean();

require_once("template.php");