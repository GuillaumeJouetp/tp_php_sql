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
                . $subjects[$key]['subjectContent'] ." <br>
                <em>Posté par</em> <strong>". $subjects[$key]['subjectUserName'] ."</strong> <em>le ". $subjects[$key]['subjectDate'] ." à " . $subjects[$key]['time'] . " </em>
            </p>"
        );
    }
}

function displaySubjectsAndResponse($bdd,$n){
    /*Récupère les n derniers sujets ajouté sa la bdd ainsi que leurs réponses*/
    $subjects = recupereSubjects($bdd, $n);
    $responses = recupereResponses($bdd);
    foreach ($subjects as $key => $elm) {
                /*Affichage du sujet*/
                echo(
                    "<div class='subjectWrapper'><p>"
                        . $subjects[$key]['subjectContent'] . " <br>
                            <em>Posté par</em> <strong>" . $subjects[$key]['subjectUserName'] . "</strong> <em>le " . $subjects[$key]['subjectDate'] . " à " . $subjects[$key]['time'] . "  </em> <br>
                            <em>Catégorie : </em> <strong>" . $subjects[$key]['category'] . "</strong>
                    </p>"
                    );
                foreach ($responses as $keyR => $elmR) {
                    if ($subjects[$key]['subject_id']===$responses[$keyR]['subject_id']) {
                        /*Affichage des réponses*/
                        echo(
                            "<p class='marginleft'>
                                   >> " .$responses[$keyR]['responseContent']. " <br>
                                   <em>Posté par</em> <strong>" . $responses[$keyR]['responseUserName'] . "</strong> <em>le " . $responses[$keyR]['responseDate'] . " à " . $responses[$keyR]['time'] . " </em>
                               </p>"
                        );
                    }
                }
                $get = $subjects[$key]['subject_id'];
                /*Affichage de la réponse*/
                echo("
                     <form class='marginleft' action=\"index.php?cible=mainController&function=postResponse&subject_id=$get\" method=\"post\">
                         <label> <span> Votre réponse : </span>
                             <br>
                             <textarea cols=\"100\" rows=\"10\" name=\"content\">Votre réponse</textarea>
                         </label>          
                         <br>
                         <button type=\"submit\">Envoyer</button>
                         <br>
                     </form>
                    </div>"
                );

    }
}