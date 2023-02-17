<?php
ob_start();
?>
<?php
session_start();

?>
<main class="main_container_client">
    <section class="container_client">
        <div class="container_client_title">
            <h4>LE RESTAURANT, Le plaisir de vous recevoir</h4>
            <p>Bonjour <?php echo $_SESSION['username']; ?>,  </p>
            <p>Votre restaurant est complet. Veuillez choisir un autre jour ou une autre heure.</p>
            <p>Veuillez cliquer sur ce bouton pour retourner à la page de réservation.</p>
            <div class="btn_logout_validation">
                <button class="btn_deconnexion">
                    <a href="./resaValidateClient.php">Retour à la page de réservation</a>
                </button>
            <p>La Direction</p>
        </div>
    </section>
</main>
<?php 
session_destroy();
?>

<?php
$content= ob_get_clean();

require_once("template.php");