<?php
ob_start();
?>

<main class="accueil-container">
        <img src="./images/background_redim.jpg" alt="photo du restaurant">
        <div class="accueil-section-title">
            <h1>Bienvenue au restaurant</h1>
            <div class="accueil-section-incontournable">
                <h2>Les incontournables du chef</h2>
                <div class="accueil-section-boxes">
                    <div class="boxe1 box">
                        <img src="" alt="">
                    </div>
                    <div class="boxe2 box"></div>
                    <div class="boxe3 box"></div>
                    <div class="boxe4 box"></div>
                </div>
            </div>
        </div>
    </main>

<?php
$content= ob_get_clean();

require_once("template.php");