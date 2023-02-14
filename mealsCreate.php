<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,
Content-Type,Access-Control-Allow-Methods, Authorization");

$data = json_decode(file_get_contents("php://input"), true);

$meals_title = $data['meals_title'];
$meals_description = $data['meals_description'];
$meals_price = $data['meals_price'];

require_once './views/config/database.php';

$req = "INSERT INTO meals (meals_title, meals_description, meals_price) 
VALUES (:mealstitle, :meals_description, :mealsprice)";

$stmt= $db->prepare($req);
$stmt->bindParam(':mealstitle', $meals_title, PDO::PARAM_STR);
$stmt->bindParam(':meals_description', $meals_description, PDO::PARAM_STR);
$stmt->bindParam(':mealsprice', $meals_price, PDO::PARAM_INT);
$stmt->execute();

if ($stmt) {
    echo json_encode(['success' => 'Le plat a bien été ajouté']);
} else {
    echo json_encode(['error' => 'Une erreur est survenue']);
}