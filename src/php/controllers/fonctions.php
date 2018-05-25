<?php
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
    if (isset($_SESSION['user_name']))
        return true;
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
 * Sécurise un tableau à la faille XSS
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

/**
 * formatage de la date us en fr
 * @param PDO $bdd
 * @param int $n
 * @return array
 */
function recupereSubjects($bdd,$n){
    $subjects = get_subjects($bdd,$n);
    foreach ($subjects as $key=>$elm){

        $subjects[$key]['date'] = dateFr($subjects[$key]['date']);

    }
    return $subjects;
}

/**
 * Formate une date US en date FR
 * @param string $dateUS
 * @return string
 */
function dateFr($dateUS){
    $dateFR = strftime('%d-%m-%Y',strtotime($dateUS));
    $dateFRslash=str_replace (  '-' , '/' ,$dateFR);
    return $dateFRslash;
}