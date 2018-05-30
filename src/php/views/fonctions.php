<?php

/**
 * On renvoie le nom et prénom de la personne actuellement connectée, si pas de connexion on renvoie false
 * @param string $string
 * @return boolean or string
 */
function displayBienvenue($string){

    if (isUserConnected()) {
        $prenom = $_SESSION['user_name'];
        $nom = $_SESSION['user_last_name'];
        return $string.' '. $prenom .' '.$nom. ' !';
    }
    return false;
}

/**
 * On renvoie le bouton de deconnexion uniquement si l'utilisateur est connecté
 * @return string or void
 */
function displayDeconnexion(){
    if(isUserConnected()){
        return '<button><a href="index.php?cible=mainController&function=deconnexion"> Déconnexion </a> </button>';
    }
}

/**
 * On affiche le formulaire de connexion uniquement si l'utilisateur est déconnecté (état par défaut)
 * @return void
 */
function displayConnexion(){
    if(isUserConnected()){
        echo displayDeconnexion();
    }
    else{
        include 'connexion.php';
    }
}

/**
 * On affiche le bouton inscription dans le menu uniquement si l'utilisateur est déconnecté (état par défaut)
 * @return void
 */
function displayInscription(){
    if(!isUserConnected()){
        echo ("<a href=\"index.php?cible=mainController&function=bouttonInscription\" class=\"liens\">&#9998; Inscription</a>");
    }
}

/**
 * Formate une dateTime SQL en format date : jj/mm/aaaa
 * @param string $dateUS
 * @return string
 */
function dateFr($dateUS){
    $dateFR = strftime('%d-%m-%Y',strtotime($dateUS));
    $dateFRslash=str_replace (  '-' , '/' ,$dateFR);
    return $dateFRslash;
}

/**
 * Formate une dateTime SQL en format heure FR : 00h00
 * @param string $heureUS
 * @return string
 */
function heureFr(string $heureUS){
    $heureFr = explode(' ',$heureUS);
    $heureFr1 = substr_replace($heureFr[1], '', -3, 3);
    $heureFr2 =str_replace (  ':' , 'h' ,$heureFr1);
    return $heureFr2;
}

/**
 * On formate la date de post des sujets récupérée de la bdd en vue de l'affichage
 * @param PDO $bdd
 * @param int $n
 * @return array
 */
function recupereSubjects($bdd,$n){
    $subjects = get_subjects($bdd,$n);
    foreach ($subjects as $key=>$elm){

        $subjects[$key]['subjectDate'] = dateFr($subjects[$key]['subjectDateTime']);
        $subjects[$key]['subjectTime'] = heureFr($subjects[$key]['subjectDateTime']);

    }
    return $subjects;
}

/**
 * On formate la date de post des sujets récupérée de la bdd en vue de l'affichage
 * @param PDO $bdd
 * @return array
 */
function recupereResponses($bdd){
    $responses = get_responses($bdd);
    foreach ($responses as $key=>$elm){

        $responses[$key]['responseDate'] = dateFr($responses[$key]['responseDateTime']);
        $responses[$key]['responseTime'] = heureFr($responses[$key]['responseDateTime']);

    }
    return $responses;
}

/**
 * Affiche les n derniers sujets auquel un utilisateur a répondu
 * @param PDO $bdd
 * @param int $n
 * @return void
 */

function displaySubjects($bdd,$n){
    /*Récupère les n derniers sujets ajouté sa la bdd*/
    $subjects = recupereSubjects($bdd,$n);
    foreach ($subjects as $key=>$elm){
        echo(
            "<p>"
                . $subjects[$key]['subjectContent'] ." <br>
                <em>Posté par</em> <strong>". $subjects[$key]['subjectUserName'] ."</strong> <em>le ". $subjects[$key]['subjectDate'] ." à " . $subjects[$key]['subjectTime'] . " </em>
            </p>"
        );
    }
}

/**
 * Affiche les n derniers sujets (ainsi que toutes leurs réponses) auquel un utilisateur a répondu
 * @param PDO $bdd
 * @param int $n
 * @return void
 */
function displaySubjectsAndResponse($bdd,$n){
    /*Récupère les n derniers sujets ajouté sa la bdd ainsi que leurs réponses*/
    $subjects = recupereSubjects($bdd, $n);
    $responses = recupereResponses($bdd);
    foreach ($subjects as $key => $elm) {
                /*Affichage du sujet*/
                echo(
                    "<div class='subjectWrapper'><p>"
                        . $subjects[$key]['subjectContent'] . " <br>
                            <em>Posté par</em> <strong>" . $subjects[$key]['subjectUserName'] . "</strong> <em>le " . $subjects[$key]['subjectDate'] . " à " . $subjects[$key]['subjectTime'] . "  </em> <br>
                            <em>Catégorie : </em> <strong>" . $subjects[$key]['category'] . "</strong>
                    </p>"
                    );
                foreach ($responses as $keyR => $elmR) {
                    if ($subjects[$key]['subject_id']===$responses[$keyR]['subject_id']) {
                        /*Affichage des réponses du sujet*/
                        echo(
                            "<p class='marginleft'>
                                   >> " .$responses[$keyR]['responseContent']. " <br>
                                   <em>Posté par</em> <strong>" . $responses[$keyR]['responseUserName'] . "</strong> <em>le " . $responses[$keyR]['responseDate'] . " à " . $responses[$keyR]['responseTime'] . " </em>
                               </p>"
                        );
                    }
                }
                $get = $subjects[$key]['subject_id'];
                /*Affichage de la zone de texte qui permet de répondre au sujet*/
                echo("
                     <form class='marginleft' action=\"index.php?cible=mainController&function=postResponse&subject_id=$get\" method=\"post\">
                         <label> <span> Votre réponse : </span>
                             <br>
                             <textarea cols=\"80\" rows=\"10\" name=\"content\">Votre réponse</textarea>
                         </label>          
                         <br>
                         <button type=\"submit\">Envoyer</button>
                         <br>
                     </form>
                    </div>"
                );

    }
}