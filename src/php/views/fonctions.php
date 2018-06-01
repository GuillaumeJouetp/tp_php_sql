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
 * @param $where
 * @return array
 */
function recupereSubjects($bdd,$n,$where){
    $subjects = get_subjects($bdd,$n,$where);
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
 * @param $Filter
 * @return void
 */

function displaySubjects($bdd,$n,$Filter){
    /*Récupère les n derniers sujets ajouté sa la bdd*/
    $subjects = recupereSubjects($bdd,$n,$Filter);
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
 * @param $Filter
 * @return void
 */
function displaySubjectsAndResponse($bdd,$n,$Filter){
    /*Récupère les n derniers sujets ajouté sa la bdd ainsi que leurs réponses*/
    $subjects = recupereSubjects($bdd, $n,$Filter);
    $responses = recupereResponses($bdd);

    if (empty($subjects)){
        echo "<span class='aucun'> Aucun sujet ne correspond au(x) filtre(s) appliqué(s)... &#9785; </span>";
    }
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
                            "<div class='responseWrapperr'><p class='marginleft'>
                                   >> " .$responses[$keyR]['responseContent']. " <br>
                                   <em>Posté par</em> <strong>" . $responses[$keyR]['responseUserName'] . "</strong> <em>le " . $responses[$keyR]['responseDate'] . " à " . $responses[$keyR]['responseTime'] . " </em>
                               </p>"
                        );
                        displayDeleteResponseButton($bdd,$responses[$keyR]['response_id']);
                        echo '</div>';
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
                    </div>
                    ");
                displayDeleteSubjectButton($bdd,$get);

    }
}

/**
 * Affiche des options html en fonctions des noms présents dans la bdd (la valeur de l'option correspond à l'id de l'utilisateur)
 * @param PDO $bdd
 * @return void
 */
function displayAuthorsOptions(PDO $bdd){
    $noms =  rechercheUsersWhoHavePosted($bdd);
    foreach ($noms as $key=>$elm){

        $name = $elm['name'].' ';
        $lastName = $elm['last_name'];
        $user_id = $elm['id'];

        echo("
            <option value=$user_id>$name $lastName</option>
        ");
    }
}

/**
 * Affiche des options html en fonctions des catégories présentes dans la bdd (la valeur de l'option correspond au nom de la catégorie)
 * @param PDO $bdd
 * @return void
 */
function displayCategoryOptions($bdd){
    $categories =  recherchedDistincitChamp($bdd,'subjects','category');
    foreach ($categories as $key=>$elm){
        $category = $elm['category'];

        echo("
            <option value=$category>$category</option>
        ");
    }
}

/**
 * Affiche le bouton d'administration supprimer le sujet si l'ultilisateur est admin
 * @param PDO $bdd
 * @param int $id
 * @return void
 */

function displayDeleteSubjectButton($bdd,$id){
    if(isUserAdmin($bdd)){
        echo("
        <form action=\"index.php ?cible=mainController&function=deleteSubject&subject_id=$id\" method=\"post\">
        <button type=\"submit\">Supprimer le sujet</button>
        </form>
        ");
    }
}

/**
 * Affiche le bouton d'administration supprimer la réponse si l'ultilisateur est admin
 * @param PDO $bdd
 * @param int $id
 * @return void
 */

function displayDeleteResponseButton($bdd,$id){
    if(isUserAdmin($bdd)){
        echo("
        <form action=\"index.php ?cible=mainController&function=deleteResponse&response_id=$id\" method=\"post\">
        <button class='inlineBlock' type=\"submit\">Supprimer la réponse</button>
        </form>
        ");
    }
}