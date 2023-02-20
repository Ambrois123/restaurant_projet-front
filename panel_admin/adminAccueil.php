<?php
    ob_start();
?>
<?php 
    session_start();
?>
<main class="">
    <h1>Bienvenue <?php echo $_SESSION['username']; ?></h1>
</main>

<?php
$titre = "<h1>Panel d'administration</h1>";
$content = ob_get_clean();
require_once './adminTemplate.php';

?>