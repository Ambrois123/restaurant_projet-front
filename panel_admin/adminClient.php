<?php
    ob_start();
?>



<?php
$titre = "<h1>Gestion des clients</h1>";
$content = ob_get_clean();
require_once './adminTemplate.php';

?>