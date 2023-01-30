<?php
ob_start();
?>

<main class="accueil_container">
    <section class="accueil_container_title">
        <h1>Bienvenue au restaurant</h1>
        <p>Nous mettons tout en oeuvre pour vous 
        faire vivre la plus belle aventure culinaire.
        </p>
    </section>
    <section class="accueil_container_boxes">
        <div class="accueil_container_boxes_title">
            <h3>Venez goûtez les incontournables du chef le plus étoilés de France.</h3>
        </div>
        <div class="boxes">
            <div class="box box_1">
                <img src="./images/foie_gras.jpg" alt="">
                <div class="overlay">
                    <div class="overlay_title">
                        <span>Le foie gras du chef</span><br>
                        <p>Foie gras de la région des oies, ail, romarin, miel.</p>
                    </div>
                    <div class="overlay_description">            </div>
                </div>
            </div>
            <div class="box box_2">
                <img src="./images/dessert1.jpg" alt="">
                <div class="overlay">
                    <div class="overlay_title">
                        <span>Le foie gras du chef</span><br>
                        <p>Foie gras de la région des oies, ail, romarin, miel.</p>
                    </div>
                    <div class="overlay_description">            </div>
                </div>
            </div>
            <div class="box box_3">
                <img src="./images/salade.jpg" alt="">
                <div class="overlay">
                    <div class="overlay_title">
                        <span>Le foie gras du chef</span><br>
                        <p>Foie gras de la région des oies, ail, romarin, miel.</p>
                    </div>
                    <div class="overlay_description">            </div>
                </div>
            </div>
            <div class="box box_4">
                <img src="./images/plat2.jpg" alt="">
                <div class="overlay">
                    <div class="overlay_title">
                        <span>Le foie gras du chef</span><br>
                        <p>Foie gras de la région des oies, ail, romarin, miel.</p>
                    </div>
                    <div class="overlay_description">            </div>
                </div>
            </div>
            <div class="box box_5">
                <img src="./images/plat1.jpg" alt="">
                <div class="overlay">
                    <div class="overlay_title">
                        <span>Le foie gras du chef</span><br>
                        <p>Foie gras de la région des oies, ail, romarin, miel.</p>
                    </div>
                    <div class="overlay_description">            </div>
                </div>
            </div>
            <div class="box box_6">
                <img src="./images/desert3.jpg" alt="">
                <div class="overlay">
                    <div class="overlay_title">
                        <span>Le foie gras du chef</span><br>
                        <p>Foie gras de la région des oies, ail, romarin, miel.</p>
                    </div>
                    <div class="overlay_description">            </div>
                </div>
            </div>
            
        </div>
        <div class="reserve_btn">
            <button class="nav_btn_reservation">
                <a href="reservation.php">Réservez</a>
            </button>
        </div>
    </section>
</main>

<?php
$content= ob_get_clean();

require_once("template.php");