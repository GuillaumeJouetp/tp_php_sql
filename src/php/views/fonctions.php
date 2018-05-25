<?php

function displayBienvenue($string){

    if (isUserConnected()) {
        $prenom = $_SESSION['user_name'];
        $nom = $_SESSION['user_last_name'];
        return $string.' '. $prenom .' '.$nom. ' !';
    }
    return false;
}

function displayDeconnexion(){
    if(isUserConnected()){
        return '<button><a href="index.php?cible=mainController&function=deconnexion"> Déconnexion </a> </button>';
    }
}

function displayConnexion(){
    if(isUserConnected()){
        echo displayDeconnexion();
    }
    else{
        include 'connexion.php';
    }
}

function getConnexion(){
    if(isUserConnected()){
        echo displayDeconnexion();
        return null;
    }
    else{
        return 'connexion.php';
    }
}

function displayInscription(){
    if(!isUserConnected()){
        echo ("<a href=\"index.php?cible=mainController&function=bouttonInscription\" class=\"liens\">&#9998; Inscription</a>");
    }
}

function displaySubjects($bdd,$n){
    /*Récupère les n derniers sujets ajouté sa la bdd*/
    $subjects = recupereSubjects($bdd,$n);
    foreach ($subjects as $key=>$elm){
        echo(
            "<p>"
                . $subjects[$key]['content'] ." <br>
                <em>Posté par</em> <strong>". $subjects[$key]['name'] ."</strong> <em>le ". $subjects[$key]['date'] ." </em>
            </p>"
        );
    }
}

function displaySubjectsAndResponse($bdd,$n){
    /*Récupère les n derniers sujets ajouté sa la bdd ainsi que leurs réponses*/
    $subjects = recupereSubjects($bdd,$n);
    foreach ($subjects as $key=>$elm){
        echo(
            "<p>"
            . $subjects[$key]['content'] ." <br>
                <em>Posté par</em> <strong>". $subjects[$key]['name'] ."</strong> <em>le ". $subjects[$key]['date'] ." </em>
            </p>"
            ."<form action=\"index.php?cible=mainController&function=postResponse\" method=\"post\">
                <label> <span> Votre réponse : </span>
                    <br>
                    <textarea cols=\"100\" rows=\"10\" name=\"content\">Votre réponse</textarea>
                </label>
                    <br>
                <button type=\"submit\">Envoyer</button>
                <br>
            </form>"
        );
    }
}