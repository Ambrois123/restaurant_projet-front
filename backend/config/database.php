<?php

class Database 
{
    private $host = 'localhost';
    private $db_name = 'restaurant_server';
    private $username = 'projet_restr';
    private $password = 'Dev_Projet_Restaurant';
    public $conn;

    //établir la connexion
    public function getConnect(){
        $this->conn = null;

        try{
            $this->conn = new PDO('msql:host=' .$this->host. ';
            dbname=' .$this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             
        }catch(PDOException $err){
            $err_msg = "Erreur de connexion";
            $err_msg .= $err->getMessage();
        }
        return $this->conn;
    }
}