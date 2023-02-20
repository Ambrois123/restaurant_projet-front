<?php 

function insert_meals(){
    $db = new PDO('mysql:host=localhost;dbname=restaurant_server;charset=utf8', 'projet_restr', 'Dev_Projet_Restaurant');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    echo "Connexion ok";
    $req = ('INSERT INTO meals (meals_title, meals_description, meals_price, meals_image, reservationId) 
    VALUES (:name, :description, :price, :image, :reservationId)');
    $stmt = $db->prepare($req);
    $stmt->execute();
    // $stmt->execute(array(
    //     'name' => $_POST['name'],
    //     'description' => $_POST['description'],
    //     'price' => $_POST['price'],
    //     'image' => $_POST['image']
    // ));
    // $stmt->closeCursor();
}