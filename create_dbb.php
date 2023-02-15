<?php 

try{
    $pdo = new PDO("mysql:host=localhost","projet_restr", "Dev_Projet_Restaurant");
    $pdo->setAttribute(PDO::ERRMODE_EXCEPTION, PDO::ATTR_ERRMODE);
    if($pdo->exec('CREATE DATABASE restaurant_server') !==false){
        $serveurRest = new PDO("mysql:host=localhost;dbname=restaurant_server", "projet_restr", "Dev_Projet_Restaurant");
        if($serveurRest->exec('CREATE TABLE administrateur(
            admin_id INT(11) PRIMARY KEY not null auto_increment
        )') !==false){
            if($serveurRest->exec('CREATE TABLE users(
                user_id INT(11)PRIMARY KEY not null AUTO_INCREMENT,
		        user_name VARCHAR(250) not null,
                user_email VARCHAR(100) not null,
                role ENUM("visiteur", "client", "admin") null default "client",
                user_phone VARCHAR(20) not null,
                user_password VARCHAR(100) null,
                adminId INT(11) null,
                FOREIGN KEY (adminId) REFERENCES administrateur (admin_id)

            )') !==false){
                if($serveurRest->exec('CREATE TABLE reservation(
                    reservation_id INT(11) PRIMARY KEY not null AUTO_INCREMENT,
                    reservation_datetime DATETIME not null,
                    numberOfPeople INT(11) not null,
                    statut VARCHAR(20) null,
                    userId INT not null,
                    FOREIGN KEY (userId) REFERENCES users (user_id)
                
                )') !==false){
                    if($serveurRest->exec('CREATE TABLE allergies(
                        allergies_id INT(11) PRIMARY KEY not null AUTO_INCREMENT,
                        allergies_list VARCHAR(200) not null,
                        reservationId INT(11) not null,
                        FOREIGN KEY (reservationId) REFERENCES reservation (reservation_id)
                    )') !==false){
                    if($serveurRest->exec('CREATE TABLE restaurant(
                        restaurant_id INT(11) PRIMARY KEY not null AUTO_INCREMENT,
                        maxCapacity INT(11) not null,
                        stockReservation INT(11) not null,
                        reservationId INT(11) not null,
                        FOREIGN KEY (reservationId) REFERENCES reservation (reservation_id)
                    )') !==false){
                    if($serveurRest->exec('CREATE TABLE meals(
                        meals_id INT(11) PRIMARY KEY not null AUTO_INCREMENT,
                        meals_title VARCHAR(50) not null,
                        meals_description VARCHAR(60) not null,
                        meals_price FLOAT not null,
                        restaurantId INT(11) not null,
                        FOREIGN KEY (restaurantId) REFERENCES restaurant (restaurant_id)
                    )') !==false){
                        if($serveurRest->exec('CREATE TABLE mealsPhoto(
                            mealsPhoto_id INT(11) PRIMARY KEY not null AUTO_INCREMENT,
                            mealsPhoto_title VARCHAR(25) not null,
                            mealsPhoto_image VARCHAR(100) not null,
                            mealsId int(11) not null,
                            FOREIGN KEY (mealsId) REFERENCES meals (meals_id)
                        )') !==false){
                            if($serveurRest->exec('CREATE TABLE menu(
                                menu_id INT(11) PRIMARY KEY not null AUTO_INCREMENT,
                                menu_title VARCHAR(25) not null,
                                menu_price FLOAT not null,
                                mealsId INT(11) not null,
                                FOREIGN KEY (mealsId) REFERENCES meals (meals_id)
                            )') !==false){
                                if($serveurRest->exec('CREATE TABLE formula (
                                    formula_id INT(11) PRIMARY KEY not null AUTO_INCREMENT,
                                    formula_name VARCHAR(25) not null,
                                    formula_price FLOAT not null,
                                    formula_description VARCHAR(100) not null,
                                    menuId INT(11) not null,
                                    FOREIGN KEY (menuId) REFERENCES menu (menu_id)
                                )')!==false){
                                    if($serveurRest->exec('CREATE TABLE mealsCategory(
                                        mealsCategory_id INT(11) PRIMARY KEY not null AUTO_INCREMENT,
                                        mealsCategory_name VARCHAR(50) not null,
                                        mealsId INT(11) not null,
                                        FOREIGN KEY (mealsId) REFERENCES meals (meals_id)
                                    )')!==false){
                                        echo "Installation BDD réussie";
                                    }else{
                                        echo "Impossible de créer la table mealsCategory<br>";
                                    }
                                }else{
                                    echo "Impossible de créer la table formula<br>";
                                }
                            }else{echo "Impossible de créer la table menu<br>";
                            }
                        }else{echo "Impossible de créer la table mealsPhot<br>";
                        }
                    }else{echo "Impossible de créer la table meals<br>";
                    }
                    }else{echo "Impossible de créer la table restaurant<br>";
                    }
                    }else{echo "Impossible de créer la table reservation<br>";
                    }
                }else{echo "Impossible de créer la table use<br>";
                }
            }else{echo "Impossible de créer la table admin<br>";
            }
        }

    }

}catch(PDOException $error){
    die($error->getMessage());
}