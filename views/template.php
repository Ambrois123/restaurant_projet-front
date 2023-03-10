<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="./style.css">
    <title>Document</title>
</head>
<body>
    <header class="header">
        <nav class="navbar">
            <div class="nav-logo">
                <h1>LE RESTAURANT</h1>
            </div>
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="accueil.php" class="nav-link">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a href="carte.php" class="nav-link">La carte</a>
                    </li>
                    <li class="nav-item">
                        <a href="menu.php" class="nav-link">Nos menus</a>
                    </li>
                    <li class="nav-item">
                        <a href="client.php" class="nav-link">Devenir client</a>
                    </li>
                    <li class="nav-item">
                        <button class="nav_btn_reservation">
                            <a href="reservation.php">Réservez</a>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav_btn_connexion">
                            <a href="connexion.php">Connexion</a>
                        </button>
                    </li>
                </ul>
                <div class="hamburger">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
        </nav>
    </header>
    <!--header ends-->
    <main class="mainTemplate">
        <?= $content; ?>
    </main>
                
    
        <!--footer starts-->
    <footer>
        <div class="footer_hour">
            <p class="footer_hour_title">Horaire d'ouvertures</p>
            <p>Lundi-mercredi-vendredi : 11h30 à 14h et 18h - 23h</p>
            <p>Mardi-jeudi-samedi : 12h00 à 14h et 19h - 23h</p>
            <p>Dimanche : 18h - 23h</p>
        </div>
        <div class="footer_media">
            <p class="footer_media_title">Suivez-nous</p>
            <div class="footer_media_icons">
                <a href="#">
                    <i class="fa-brands fa-facebook fa-2x"></i>
                </a>
                <a href="#">
                    <i class="fa-brands fa-square-instagram fa-2x"></i>
                </a>
                <a href="#">
                    <i class="fa-brands fa-linkedin fa-2x"></i>
                </a>
                <a href="#">
                    <i class="fa-brands fa-square-twitter fa-2x"></i>
                </a>
            </div>
        </div>
        <div class="footer_adresse">
            <p class="footer_adresse_title">Adresse</p>
            <p><span><i class="fa-solid fa-house"></i></span> 2 rue des porchettes 35400 Saint-Malo</p>
            <p><span><i class="fa-solid fa-phone"></i></span> 02 48 75 31 25</p>
            <p><span><i class="fa-solid fa-at"></i></span> lerestaurant@gmail.com</p>
        </div>
    </footer>
    <script src="./script.js"></script>
</body>
</html>