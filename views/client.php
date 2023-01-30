<?php
ob_start();
?>

<main class="main_container_client">
        <section class="container_client">
            <div class="container_client_title">
                <h1>Devenez client</h1>
                <p>Nous serons à vos côtés pour l'organisation 
                    de vos événements privés. Vous serez aussi 
                    informés des nouveautés dans votre restaurant.
                </p>
            </div>
            <div class="container_client_form">
                <form action="" method="">   
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
                    
                    <div class="client_btn">
                        <input type="submit" value="Valider">
                    </div>
                </form>
            </div>
        </section>
    </main>

<?php
$content= ob_get_clean();

require_once("template.php");