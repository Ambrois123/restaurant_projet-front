<?php 

function validateReservation($reservation_time, $numberGuest) {

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

  
    // Vérifier si le restaurant est ouvert à l'heure de la réservation
    $stmt = $db->prepare("SELECT * FROM opening_hours WHERE day_of_week = :day_of_week AND :reservation_time BETWEEN opening_time AND closing_time");
    $stmt->bindParam(':day_of_week', date('l', strtotime($reservation_time)));
    $stmt->bindParam(':reservation_time', date('H:i:s', strtotime($reservation_time)));
    $stmt->execute();
  
    if ($stmt->rowCount() == 0) {
      return false; // Restaurant est fermé à l'heure de la réservation
    }
  
    // Vérifier si le restaurant a assez de places disponibles à l'heure de la réservation
    $stmt = $db->prepare("SELECT COUNT(*) as num_reservations, SUM(num_guests) as total_guests FROM reservations WHERE reservation_time = :reservation_time");
    $stmt->bindParam(':reservation_time', $reservation_time);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
    $num_reservations = $row['num_reservations'];
    $total_guests = $row['total_guests'];
    $available_seats = 50 - $total_guests; // Assuming the restaurant has a maximum capacity of 50 guests
  
    if (($num_reservations + 1) > $available_seats || ($numberGuest + $total_guests) > 50) {
      return false; // Not enough available seats for the desired reservation time and number of guests
    }
  
    return true; // Reservation is valid
  }
  