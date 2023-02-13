<?php 
ob_start();
?>

<main class="main_container_connexion">
        <section class="container_connexion">
            <div class="container_connexion_title">
                <h1>Page de connexion</h1>
                <p>Chers clients -tes connectez-vous à votre compte et laissez-vous guider.</p>
            </div>
            <div class="container_connexion_form">
                <form action="">
                    <label for="email"></label>
                    <input type="email" id="email" name="email" placeholder="Votre adresse mail">

                    <label for="password"></label>
                    <input type="password" id="password" name="password" placeholder="Votre mot de passe">

                    <div class="select-form">
                        <select name="role" id="role">
                            <option value="" selected="selected">- En tant que -</option>
                            <option value="user">Client</option>
                            <option value="admin">admin</option>
                        </select>
                    </div>
                    
                    <div class="connexion_btn">
                        <input type="submit" value="Valider">
                    </div>
                </form>
            </div>
        </section>
    </main>

<?php
$content = ob_get_clean();
require_once("template.php");
