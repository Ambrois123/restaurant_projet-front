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
            <p>Bonjour,  </p>
            <p>LE RESTAURANT vous remercie pour votre réservation. Le résumé de votre réservation :</p>
            <ul>
                <li>Date : </li>
                <li>Heure: </li>
                <li>Nombre de couverts: </li>
                <li>Vous êtes allergiques à </li>
            </ul>
            <p>La Direction</p>
        </div>
    </section>
</main>

<?php
$content= ob_get_clean();

require_once("template.php");