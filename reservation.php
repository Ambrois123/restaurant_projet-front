<?php

ob_start();
?>

<main class="reservation-container">
        <img src="./images/background.jpg" alt="photo du restaurant">
        <div class="section-reservation-title">
            <h1>Réservez</h1>
            <h4>Bienvenue au restaurant</h4>
            <p>Etre client chez nous c'est avoir des privilèges</p>
            <form action="">
                <label for="username"></label>
                <input type="text" id="username" name="username" placeholder="Votre nom et prénom">

                <label for="email"></label>
                <input type="email" id="email" name="email" placeholder="Votre adresse mail">

                <label for="phone"></label>
                <input type="tel" id="phone" name="phone" placeholder="Votre numéro de téléphone">

                <label for="date"></label>
                <input type="date" id="date" name="date" placeholder="Date">

                <fieldset>
                    <legend>Horaire du midi</legend>
                    <label for="lunch"></label>
                <select id="lunch" name="lunch">
                  <option value="lunch-tranch1">12:00</option>
                  <option value="lunch-tranch2">12:15</option>
                  <option value="lunch-tranch3">12:30</option>
                  <option value="lunch-tranch4">12:30</option>
                  <option value="lunch-tranch5">12:30</option>
                  <option value="lunch-tranch6">12:30</option>
                </select>
                </fieldset>

                <fieldset>
                    <legend>Horaire du soir</legend>
                    <label for="diner"></label>
                <select id="diner" name="diner">
                  <option value="diner-tranch1">18:00</option>
                  <option value="diner-tranch2">18:15</option>
                  <option value="diner-tranch3">18:30</option>
                  <option value="diner-tranch4">18:45</option>
                  <option value="diner-tranch5">19:00</option>
                  <option value="diner-tranch6">19:15</option>
                </select>
                </fieldset>
                
                <label for="allergies"></label>
                <input type="text" id="allergies" name="allergies" placeholder="Des allergies ?">
                
                <input type="submit" value="Réserver" class="reservation-btn">
            </form>
        </div>
    </main>

<?php
$content= ob_get_clean();

require_once("template.php");