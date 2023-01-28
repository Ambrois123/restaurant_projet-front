<?php
ob_start();
?>
<main class="main_container_carte">
<section class="carte_container">
    <h1>Nos plats</h1>
    <article>
        <div class="carte_box_1">
            <div class="carte_box carte_container_entree">
                <h4>ENTREES</h4>
                <div class="plat_row">
                    <p>Salade césar</p>
                    <p>Huile d'olive, vinaigre basalmique</p>
                    <span>12,85 €</span>
                </div>
                <div class="plat_row">
                    <p></p>
                    <p></p>
                    <span> €</span>
                </div>
                <div class="plat_row">
                    <p></p>
                    <p></p>
                    <span> €</span>
                </div>
                <div class="plat_row">
                    <p></p>
                    <p></p>
                    <span> €</span>
                </div>
            </div>
            <div class="carte_box carte_container_plat">
                <h4>PLATS</h4>
                <div class="plat_row">
                    <p></p>
                    <p></p>
                    <span> €</span>
                </div>
                <div class="plat_row">
                    <p></p>
                    <p></p>
                    <span> €</span>
                </div>
                <div class="plat_row">
                    <p></p>
                    <p></p>
                    <span> €</span>
                </div>
                <div class="plat_row">
                    <p></p>
                    <p></p>
                    <span> €</span>
                </div>
            </div>
            </div>
        <div class="carte_box_2">
            <div class="carte_box carte_container_dessert">
                <h4>DESSERTS</h4>
                <div class="plat_row">
                    <p></p>
                    <p></p>
                    <span> €</span>
                </div>
                <div class="plat_row">
                    <p></p>
                    <p></p>
                    <span> €</span>
                </div>
                <div class="plat_row">
                    <p></p>
                    <p></p>
                    <span> €</span>
                </div>
                <div class="plat_row">
                    <p></p>
                    <p></p>
                    <span> €</span>
                </div>
            </div>
            <div class="carte_box carte_container_boisson">
                <h4>BOISSONS</h4>
                <div class="plat_row">
                    <p></p>
                    <p></p>
                    <span> €</span>
                </div>
                <div class="plat_row">
                    <p></p>
                    <p></p>
                    <span> €</span>
                </div>
                <div class="plat_row">
                    <p></p>
                    <p></p>
                    <span> €</span>
                </div>
                <div class="plat_row">
                    <p></p>
                    <p></p>
                    <span> €</span>
                </div>
            </div>
        </div>
    </article>
</section>
</main>

<?php
$content= ob_get_clean();
require_once("template.php");