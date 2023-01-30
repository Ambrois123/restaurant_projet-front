<?php

require_once './models/userModel.php';
require_once './backend/config/database.php';

/**
 * La classe UerController. Elle traite toutes 
 * les requêtes reliées aux Users.
 */
class UserController
{
    private $conn;
    private $dbUsers;


    public function __construct()
    {
        $database = new Database();
        $conn = $database->getConnect();

        $this->dbUsers = new UserModel();
    }

    public function getUsers()
    {
        $result = $this->dbUsers->getDbUsers();
        return $result;
    }
}