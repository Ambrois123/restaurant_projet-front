<?php 

try{
    $pdo = new PDO("mysql:host=localhost","projet_restr", "Dev_Projet_Restaurant");
    $pdo->setAttribute(PDO::ERRMODE_EXCEPTION, PDO::ATTR_ERRMODE);
if ($pdo->exec('CREATE DATABASE restaurant_server') !==false) {
    $serveurRest = new PDO("mysql:host=localhost;dbname=restaurant_server", "projet_restr", "Dev_Projet_Restaurant");
    if ($serveurRest->exec('CREATE TABLE users(
                user_id INT(11)PRIMARY KEY not null AUTO_INCREMENT,
		        user_name VARCHAR(250) not null,
                user_email VARCHAR(100) not null,
                role ENUM("visiteur", "client", "admin") not null,
                user_phone VARCHAR(20) not null,
                user_password VARCHAR(100) not null
            )') !==false) {
            if ($serveurRest->exec('CREATE TABLE reservation(
                    reservation_id INT(11) PRIMARY KEY not null AUTO_INCREMENT,
                    reservation_time DATETIME not null,
                    numberGuests INT(11) not null,
                    allergies_list VARCHAR(200) not null,
                    statut VARCHAR(20) null,
                    userId INT not null,
                    FOREIGN KEY (userId) REFERENCES users (user_id)
                )') !==false){
                if ($serveurRest->exec('CREATE TABLE opening_hours (
                        openingHours_id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
                        day_of_week varchar(12) NOT NULL,
                        opening_time time NOT NULL,
                        closing_time time NOT NULL,
                        maxCapacity INT(11) not null
                      )') !==false) {
                    if ($serveurRest->exec('CREATE TABLE reservation_opening_hours (
                            resaOpeningHours_id int(11) PRIMARY KEY NOT NULL,
                            reservationId INT(11) not null,
                            openingHoursId INT(11) not null,
                            FOREIGN KEY (reservationId) REFERENCES reservation(reservation_id),
                            FOREIGN KEY (openingHoursId) REFERENCES opening_hours(openingHours_id)
                          )') !==false){
                            if ($serveurRest->exec('CREATE TABLE meals(
                        meals_id INT(11) PRIMARY KEY not null AUTO_INCREMENT,
                        meals_title VARCHAR(50) not null,
                        meals_description VARCHAR(60) not null,
                        meals_price FLOAT not null,
                        meals_image BLOB not null,
                        reservationId INT(11) not null,
                        FOREIGN KEY (reservationId) REFERENCES reservation (reservation_id)
                    )') !==false) 
                    // {
                    //             if ($serveurRest->exec('CREATE TABLE mealsPhoto(
                    //         mealsPhoto_id INT(11) PRIMARY KEY not null AUTO_INCREMENT,
                    //         mealsPhoto_title VARCHAR(25) not null,
                    //         mealsPhoto_image VARCHAR(100) not null,
                    //         mealsId int(11) not null,
                    //         FOREIGN KEY (mealsId) REFERENCES meals (meals_id)
                    //     )') !==false) 
                        {
                                    if ($serveurRest->exec('CREATE TABLE menu(
                                menu_id INT(11) PRIMARY KEY not null AUTO_INCREMENT,
                                menu_title VARCHAR(25) not null,
                                menu_price FLOAT not null,
                                mealsId INT(11) not null,
                                FOREIGN KEY (mealsId) REFERENCES meals (meals_id)
                            )') !==false) {
                                        if ($serveurRest->exec('CREATE TABLE formula (
                                    formula_id INT(11) PRIMARY KEY not null AUTO_INCREMENT,
                                    formula_name VARCHAR(25) not null,
                                    formula_price FLOAT not null,
                                    formula_description VARCHAR(100) not null,
                                    menuId INT(11) not null,
                                    FOREIGN KEY (menuId) REFERENCES menu (menu_id)
                                )')!==false) {
                                            if ($serveurRest->exec('CREATE TABLE mealsCategory(
                                        mealsCategory_id INT(11) PRIMARY KEY not null AUTO_INCREMENT,
                                        mealsCategory_name VARCHAR(50) not null,
                                        mealsId INT(11) not null,
                                        FOREIGN KEY (mealsId) REFERENCES meals (meals_id)
                                    )')!==false) {
                                                echo "Installation BDD réussie";
                                            } else {
                                                echo "Impossible de créer la table mealsCategory<br>";
                                            }
                                        } else {
                                            echo "Impossible de créer la table formula<br>";
                                        }
                                    } else {
                                        echo "Impossible de créer la table menu<br>";
                                    }
                                } else {
                                    echo "Impossible de créer la table mealsPhot<br>";
                                }
                            } else {
                                echo "Impossible de créer la table meals<br>";
                            }
                        } else {
                            echo "Impossible de créer la table restaurant<br>";
                        }
                    } else {
                        echo "Impossible de créer la table reservation<br>";
                    }
                } else {
                    echo "Impossible de créer la table user<br>";
                }
            } else {
                echo "Impossible de créer la table admin<br>";
            }
        
    
    // INSERT INTO opening_hours (day_of_week, opening_time, closing_time, maxCapacity)
    // VALUES ('Monday', '08:00:00', '22:00:00', 20),
    //    ('Tuesday', '08:00:00', '22:00:00', 20),
    //    ('Wednesday', '08:00:00', '22:00:00', 20),
    //    ('Thursday', '08:00:00', '22:00:00', 20),
    //    ('Friday', '08:00:00', '23:00:00', 20),
    //    ('Saturday', '10:00:00', '23:00:00', 20),
    //    ('Sunday', '10:00:00', '21:00:00', 20);

}catch(PDOException $error){
    die($error->getMessage());
}



       