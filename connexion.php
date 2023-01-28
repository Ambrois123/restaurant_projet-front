<?php 
ob_start();
?>

<main class="connexion-container">
        <!-- <img src="./images/background.jpg" alt="photo du restaurant"> -->
        <div class="section-connexion-title">
            <h1>Connectez-vous à votre compte</h1>
            <h4>Bienvenue au restaurant</h4>
            <p>Merci de bien vouloir le formulaire afin que nous puissions mieux vous servir</p>
            <form action="">
                <label for="email"></label>
                <input type="email" id="email" name="email" placeholder="Votre adresse mail">

                <label for="password"></label>
                <input type="password" id="password" name="password" placeholder="Votre mot de passe">
                <input type="submit" value="Valider">
            </form>
        </div>
    </main>

<?php
$content = ob_get_clean();
require_once("template.php");
