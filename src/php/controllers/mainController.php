<?php
/* Si la fonction n'est pas définie ou est vide, on choisit d'afficher la vue par default */
if (!isset($_GET['function']) || empty($_GET['function'])) {
    $function = "default";
} else {
    $function = $_GET['function'];
}

/*Variable qui regit la validitée des formulaires selon plusieurs critères*/
$validation=true;
/*Variable contenant les différents messages d'erreur possible*/
$error = '';

/*Ajout d'icone aux messages d'erreurs parce que c'est fun*/
$danger='&#9888;';

switch ($function) {
    case 'default':
        $title= "Accueil";
        $vue = "accueil";
        break;

    case 'bouttonInscription':
        /*Cas ou on appuie sur inscription dans le menu*/
        $vue = 'inscription';
        break;

    case 'bouttonActualite':
        /*Cas ou on appuie sur actualité dans le menu*/
        $vue = 'sujet';
        break;

    case 'bouttonContact':
        /*Cas ou on appuie sur inscription dans le menu*/
        $vue = 'contact';
        break;

    case 'bouttonAdministration':
        /*Cas ou on appuie sur inscription dans le menu*/
        $vue = 'administration';
        break;

    case 'inscription':
        $dataInscription = array();
        /* Cas ou le formulaire d'inscription est rempli ($_POST_SEC = Array([name] => {value}, [mail] => {value}, [pass] => {value}, [passConf] => {value})*/
        if (!isAnEmail($_POST_SEC['mail'])) {
            $validation = false;
            $error= $danger.' Veuillez entrer un mail valide '.$danger;
        }
        if (isEmailAlreadyExist($bdd,$_POST_SEC['mail'])) {
            $validation = false;
            $error= $danger.' Cette adresse mail est déjà utilisée '.$danger;
        }
        if(!isAPassword($_POST_SEC['pass'])){
            $Validation = false;
            $error = $danger." Veuillez entrer un mot de passe d'au moins 8 caractères (un chiffre et une majuscule) '.$danger";
        }
        // Verifie si le mot de passe et la confirmation sont les mêmes
        if($_POST_SEC['passConf'] != $_POST_SEC['pass']){
            $Validation = false;
            $error = $danger." Les mots de passe ne sont pas identiques ".$danger;
        }
        /*Si toutes les vérification sont eféctués on ajoute les données de l'utilisateur dans la bdd*/
        if ($validation) {

            $dataInscription['name']= $_POST_SEC['name'];
            $dataInscription['last_name']= $_POST_SEC['last_name'];
            $dataInscription['mail']= $_POST_SEC['mail'];
            /*Hachage du mot de passe dans la base de donnée*/
            $dataInscription['pass']= cryptage($_POST_SEC['pass']);

            insertion($bdd,$dataInscription, 'users');
            $_SESSION['user_name']=$_POST_SEC['name'];
            $_SESSION['user_last_name']=$_POST_SEC['last_name'];
            header('location: index.php');
        }
        else{
            $vue = 'inscription';
        }
        break;

    case 'connexion':
        /* Cas de connexion d'un user */
        /* On verifie que le mail est contenue dans la base de donnée*/
        if (isEmailAlreadyExist($bdd,$_POST_SEC['mail'])) {
            $userDatas = getId($bdd, 'users', $_POST_SEC['mail']);

            /*Fonction qui verifie l'intégrité du mot de passe*/
            if(password_verify($_POST_SEC['pass'], $userDatas['pass'])) {

                /* Bonne identification -> creation de la session et redirection vers l'index */
                $_SESSION['user_name']=$userDatas['name'];
                $_SESSION['user_last_name']=$userDatas['last_name'];
                $_SESSION["user_id"]=$userDatas['id'];
                header('location: index.php');

            } else {
                /* Mauvais mot de passe */
                $vue = "accueil";
                $title = "Connexion";
                /*On ne précise pas quel champs un incorrect pour ne pas donner trop d'infos sur le contenue de la bdd*/
                $error = $danger." Adresse mail ou mot de passe incorrect ".$danger;
            }

        } else {

            // Adresse inexistante
            $vue = "Accueil";
            $title = "Connexion";
            /*On ne précise pas quel champs un incorrect pour ne pas donner trop d'infos sur le contenue de la bdd*/
            $error = $danger." Adresse mail ou mot de passe incorrect ".$danger;
        }
        break;


    case 'postSubject':

        if(isUserConnected()) {
            /*On ajoute le contenue du sujet à la bdd*/
            $dataSubject = array();
            $dataSubject['content'] = $_POST_SEC['content'];
            $dataSubject['date'] = date("Y-m-d H:i:s");
            $dataSubject['user_id'] = $_SESSION['user_id'];
            insertion($bdd, $dataSubject, 'subjects');
            header('location: index.php');
        }
        else{
            $vue='accueil';
            $error='Inscrivez vous au forum pour pouvoir poster un sujet !';
        }
        break;

    case 'deconnexion':
        session_destroy();
        header('location: index.php');
        break;


    default :
        /* si aucune fonction ne correspond au paramètre function passé en GET */
        $vue = "error404";
        $title = "error404";
}
/*On include le header pour la factorisation de code*/
require "views/header.php";
include('views/' . $vue . '.php');