<?php


    $host = 'localhost';
    $db_name = 'restaurant_server';
    $username = 'projet_restr';
    $password = 'Dev_Projet_Restaurant';
   

    //établir la connexion


        try{
            $db = new PDO("mysql:host={$host};dbname={$db_name}", $username,$password);
            $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
             
        }catch(PDOException $err){
            $err_msg = "Erreur de connexion";
            $err_msg .= $err->getMessage();
        }
       
 
