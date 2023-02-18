<?php
ob_start();
?>
<?php
session_start();


?>
<main class="main_container_client">
    <section class="container_client">
        <div class="container_client_title">
            <h4>LE RESTAURANT, le plaisir de vous recevoir</h4>
            <p>Bonjour, <?php echo $_SESSION['username']; ?> </p>
            <p><?= $_SESSION['user_id'] ?></p>
            <p><?= $_SESSION['email'] ?></p>
            <p><?= $_SESSION['phone'] ?></p>
            <p>Votre compte a bien été créé ! Nous vous remercions de votre confiance.</p>
            <p>Vous pouvez dès à présent réserver une table en cliquant sur le bouton ci-dessous.</p>
            <div class="btn_validateClient" >
                <button class="btn-resa">
                    <a href="./resaValidateClient.php">Réserver votre table</a>
                </button>
            </div>
            <p>La Direction</p>
        </div>
    </section>
</main>

<?php
$content= ob_get_clean();

require_once("template.php");