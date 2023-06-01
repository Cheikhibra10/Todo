<?php
function est_vide($valeur) {
    return empty($valeur);
}

function est_entier($valeur) {
    return is_numeric($valeur);
}

function valide_libelle(array &$arrayError, string $key, $valeur) {
    if (est_vide(trim($valeur))) {
        $arrayError[$key] = "Champ obligatoire";
    }
}

function valide_password(array &$arrayError, $valeur , string $key, int $min=6, int $max=8){
    if (est_vide($valeur)) {
        $arrayError[$key]="Le password est obligatoire";
    } elseif (strlen($valeur) < $min || strlen($valeur) > $max) {
        $arrayError[$key]="Le password doit etre entre $min et $max";
    
        } 
}

function validation_password( $valeur, string $key , array &$arrayError, $min = 6, $max = 8){
    if (est_vide($valeur)) {
        $arrayError[$key] = "le password est obligatoire";
    }elseif ((strlen($valeur) < $min)||(strlen($valeur) > $max)) {
        $arrayError[$key] = "le password doit être compris entre $min et $max";
    }
}

function valide_champs(array &$arrayError, string $key, $valeur) {
    if (est_vide(trim($valeur))) {
        $arrayError[$key] = "Champ obligatoire";
    } elseif(!est_entier($valeur)) {
        $arrayError[$key] = "Veuillez saisir un nombre";
    }
}


function is_email($valeur):bool{
    if (filter_var($valeur, FILTER_VALIDATE_EMAIL)) {
        return true;
      }else {
        return false;
      }
}
function form_valid($arrayError):bool{
    if (count($arrayError)==0){
        return true;
    }
    return false;
}
function valid_champ_user(array &$arrayError, $valeur, string $key) {
    if (est_vide($valeur)) {
        $arrayError[$key] = "Champ obligatoire";
    }
} 

function validation_login(string $valeur, string  $key, array &$arrayError){
    if (est_vide($valeur)) {
        $arrayError[$key] = "le login est obligatoire";
    }elseif (!is_email($valeur)) {
        $arrayError[$key] = "le login doit être un email";
    }
        
}

function valid_nbr_reponse(array &$arrayError,  string $key, $valeur) {
    if (est_vide($valeur)) {
        $arrayError[$key] = "Champ obligatoire";
    }
}



function valid_point(array &$arrayError, $valeur, string $key) {
    if (est_vide($valeur)) {
        $arrayError[$key] = "Champ obligatoire";
    }
} 

function valid_input(array &$arrayError, $valeur, string $key) {
    if (est_vide($valeur)) {
        $arrayError[$key] = "Champ obligatoire";
    }
} 

function validation_champs(  $valeur, string  $key,  &$arrayError,$str){
    $valeur= str_replace(" ","",$str);
    if (est_vide($valeur)) {
        $arrayError[$key] = "Ce champ est obligatoire";
    }elseif(!is_numeric($valeur)){
        $arrayError[$key] = "Ce champ doit être numérique";

    }
}
function type_reponse(array &$arrayError, $valeur, string $key){
    if (est_vide($valeur)) {
        $arrayError[$key] = "Veuillez donner le type de réponse";
    }   
}
function reponse( $valeur, string  $key,  &$arrayError, $str){
    $valeur= str_replace(" ","",$str);
    if(est_vide($valeur)) {
        $arrayError[$key] = "Veuillez donner la réponse";
    }   
}
/*function valide_email_regex(array &$arrayError, string $key, $valeur) {
    $pattern = "/@+\.+";
    if (est_vide(trim($valeur))) {
        $arrayError[$key] = "Champ obligatoire";
    } elseif(preg_match($pattern, $valeur) == 0) {
        $arrayError[$key] = "Veuillez saisir une adresse mail valide";
    }
}
*/
