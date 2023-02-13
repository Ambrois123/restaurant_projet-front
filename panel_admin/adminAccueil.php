<?php
    ob_start();
?>


<?php
$titre = "<h1>Panel d'administration</h1>";
$content = ob_get_clean();
require_once './adminTemplate.php';

?>