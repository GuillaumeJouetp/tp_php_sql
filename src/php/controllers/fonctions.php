<?php
/*On inclue les requêtes sql*/
include "models/requetes.php";

/*Fonctions de debugs - start*/
function debugTable($bdd, $table){
    debug1(recupereTous($bdd, $table));
}

function debug1($data){
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function debug2($data){
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}
/*Fonctions de debugs - end*/


/**
 * Vérifie si l'input utilisateur est un email
 * @param string
 * @return bool
 */
function isAnEmail($mail){
    if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $mail)) {
        return true;
    }
    return false;
}

/**
 * Vérifie si l'utilisateur est connecté
 * @return bool
 */
function isUserConnected(){
    return isset($_SESSION['user_name'])?true:false;
}

/**
 * Vérifie si l'utilisateur est admin
 * @param $bdd
 * @return bool
 */
function isUserAdmin($bdd){
    return isset($_SESSION['user_id']) && rechercheUserStatus($bdd,$_SESSION['user_id'])['status'] ==='admin' ? true:false;
}

/**
 * Crypte la chaine en entrée avec l'algorithme Bcrypt
 * @param string $password
 * @return string
 */
function cryptage($password){
    /* $hash = password_hash($password, PASSWORD_DEFAULT); */
    /* $hash = password_hash($password, PASSWORD_ARGON2I); */
    $hash = password_hash($password, PASSWORD_BCRYPT);
    return $hash;
}

/**
 * Vérifie si la chaine en entrée contient au moins 8 caractères, une majuscule et un chiffre
 * @param string $password
 * @return bool
 */
function isAPassword($password){
    if (empty($password) || strlen($password) < 8 || !preg_match('/(?=.*[0-9])[A-Z]|(?=.*[A-Z])[0-9]/', $password)) {
        return false;
    } else {
        return is_string($password);
    }
}

/**
 * Sécurise un string à la faille XSS
 * @param string $myInput
 * @return string
 */
function secu($myInput){
    $myInput = htmlspecialchars($myInput);
    return $myInput;
}

/**
 * Sécurise un tableau à la faille XSS (sera notemment utilisé pour sécurise $_POST une bonne fois pour toute)
 * @param array $tab
 * @return array
 */
function secuTab($tab){
    $myDic = array();
    foreach ($tab as $cle => $elt) {
        $cle = htmlspecialchars($cle);
        $elt = htmlspecialchars($elt);
        $myDic[$cle] = $elt;
    }
    return $myDic;
}

