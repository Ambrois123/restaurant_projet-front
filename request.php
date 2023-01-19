<?php
$db = new PDO('mysql:host=localhost;dbname=users','root','');

$req = "SELECT *FROM restaurant_client";
$stmt = $db->prepare($req);
$stmt->execute();

