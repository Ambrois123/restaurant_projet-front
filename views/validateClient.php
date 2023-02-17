<?php
ob_start();
?>
<?php
session_start();
/*session qui stocke les données du client
et les affiche dans la page réservation
avec date, heure, nombre de couverts.
le button envoie vers une nouvelle page.
*/

?>
<main class="main_container_client">
    <section class="container_client">
        <div class="container_client_title">
            <h4>LE RESTAURANT, le plaisir de vous recevoir</h4>
            <p>Bonjour,  </p>
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