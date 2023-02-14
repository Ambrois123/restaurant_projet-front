<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once './views/config/database.php';

$req = "SELECT * FROM meals";
$stmt = $db->prepare($req);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
if ($data) {
    echo json_encode($data);
} else {
    echo json_encode(['error' => 'Aucun data trouvé']);
}