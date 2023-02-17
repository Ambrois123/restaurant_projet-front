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