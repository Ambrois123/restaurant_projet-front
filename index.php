<?php

require_once './controllers/userController.php';

$userController = new UserController();
$userController->getUsers();