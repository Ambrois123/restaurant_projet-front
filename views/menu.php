<?php
ob_start();
?>
<main class="main_container_menus">
    <section class="menus_container">
        <h1>Nos menus et formules</h1>
        <article class="menus_container_boxes">
            <div class="menus_box menus_box_1">
                <h4>Menu enfant</h4>
                <div class="menus_row">
                    <p>Salade au saumon</p>
                    <p>Pavé de steak ou des tagliatelles</p>
                    <p>Mousse au chocolat ou boisson au choix</p>
                    <span>12,85 €</span>
                </div>
                <div class="menus_row">
                    <p></p>
                    <p></p>
                    <p></p>
                    <span> €</span>
                </div>
            </div>
            <div class="menus_box menus_box_2">
                <h4>Menu des amoureux</h4>
                <div class="menus_row">
                    <p>Salade au saumon</p>
                    <p>Pavé de steak ou des tagliatelles</p>
                    <p>Mousse au chocolat ou boisson au choix</p>
                    <span>12,85 €</span>
                </div>
                <div class="menus_row">
                    <p></p>
                    <p></p>
                    <p></p>
                    <span> €</span>
                </div>
            </div>
            <div class="menus_box menus_box_3">
                <h4>Formule plaisir d'offrir</h4>
                <div class="menus_row">
                    <p>Salade au saumon</p>
                    <p>Pavé de steak ou des tagliatelles</p>
                    <p>Mousse au chocolat ou boisson au choix</p>
                    <span>12,85 €</span>
                </div>
                <div class="menus_row">
                    <p></p>
                    <p></p>
                    <p></p>
                    <span> €</span>
                </div>
            </div>
            <div class="menus_box menus_box_4">
                <h4>Formule seniors</h4>
                <div class="menus_row">
                    <p>Salade au saumon</p>
                    <p>Pavé de steak ou des tagliatelles</p>
                    <p>Mousse au chocolat ou boisson au choix</p>
                    <span>12,85 €</span>
                </div>
                <div class="menus_row">
                    <p></p>
                    <p></p>
                    <p></p>
                    <span> €</span>
                </div>
            </div>
            <div class="menus_box menus_box_1">
                <h4>Menu business</h4>
                <div class="menus_row">
                    <p>Salade au saumon</p>
                    <p>Pavé de steak ou des tagliatelles</p>
                    <p>Mousse au chocolat ou boisson au choix</p>
                    <span>12,85 €</span>
                </div>
                <div class="menus_row">
                    <p></p>
                    <p></p>
                    <p></p>
                    <span> €</span>
                </div>
            </div>
            <div class="menus_box menus_box_1">
                <h4>Menu entre potes</h4>
                <div class="menus_row">
                    <p>Salade au saumon</p>
                    <p>Pavé de steak ou des tagliatelles</p>
                    <p>Mousse au chocolat ou boisson au choix</p>
                    <span>12,85 €</span>
                </div>
                <div class="menus_row">
                    <p></p>
                    <p></p>
                    <p></p>
                    <span> €</span>
                </div>
            </div>
        </article>
    </section>
</main>
<?php
$content= ob_get_clean();

require_once("template.php");