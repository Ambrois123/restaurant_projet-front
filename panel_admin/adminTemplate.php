<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" 
        href="https://cdn.jsdelivr.net/npm/bootswatch@5.2.3/dist/cerulean/bootstrap.min.css">
    <title>Panel d'administration</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">LE RESTAURANT </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" href="./adminAccueil.php">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./adminReservation.php">Reservation</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./adminPlat.php">Plats</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./adminClient.php">Clients</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<main class="container_fluid">
    <h1 class="text-center text-uppercase text-dark"><?= $titre ?></h1>
    <?= $content ?>
</main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
    crossorigin="anonymous"></script>
</body>
</html>