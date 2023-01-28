<?php
ob_start();
?>

<main class="client-container">
        <!-- <img src="./images/background.jpg" alt="photo du restaurant"> -->
        <div class="section-client-title">
            <h1>Devenez client</h1>
            <h4>Bienvenue au restaurant</h4>
            <p>Etre client chez nous c'est avoir des privilèges</p>
            <form action="">
                <label for="username"></label>
                <input type="text" id="username" name="username" placeholder="Votre nom et prénom">

                <label for="email"></label>
                <input type="email" id="email" name="email" placeholder="Votre adresse mail">

                <label for="phone"></label>
                <input type="tel" id="phone" name="phone" placeholder="Votre numéro de téléphone">

                <label for="password"></label>
                <input type="password" id="password" name="password" placeholder="Votre mot de passe">
                
                <label for="allergies"></label>
                <input type="text" id="allergies" name="allergies" placeholder="Des allergies ?">
                
                <input type="submit" value="Valider">
            </form>
        </div>
    </main>

<?php
$content= ob_get_clean();

require_once("template.php");