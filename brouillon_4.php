<?php 

//fonction pour vérifier si les champs sont vides

function isFieldsEmpty($fields){
    $isEmptyFields = false;
    foreach($fields as $field){
        if(empty($field)){
            $isEmptyFields = true;
        }
    }
    return $isEmptyFields;
}

//Enlever certaines sessions

if(isset($_SESSION['username']) && isset($_SESSION['email']) && isset($_SESSION['phone']) && isset($_SESSION['date']) 
&& isset($_SESSION['time']) && isset($_SESSION['couverts']) 
&& isset($_SESSION['allergies'])){

    unset($_SESSION['username']);
    unset($_SESSION['email']);
    unset($_SESSION['phone']);
    unset($_SESSION['date']);
    unset($_SESSION['time']);
    unset($_SESSION['couverts']);
    unset($_SESSION['allergies']);
}

$err_password_format = "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial."