<!--
Fais le 25/05/2018 par Guillaume JOUET-PASTRE G9A
Le modèle de la page index et la structure des controleurs ont été fortement inspirés du code exemple de Mr.Feller lors de la présentation MVC
De même pour certaines requêtes dans requetes.php
-->

<?php
/**
 * MVC :
 * - index.php : identifie le routeur à appeler en fonction de l'url
 * - Contrôleur : Crée les variables, élabore leurs contenus, identifie la vue et lui envoie les variables
 * - Modèle : contient les fonctions liées à la BDD et appelées par les contrôleurs
 * - Vue : contient ce qui doit être affiché
 * PHILOSOPHIE DU MVC : l'index appelle le bon controleur (grâce à la variable cible), qui lui appelle la bonne vue (gâce à la variable function) !toujours dans cet ordre!
 **/

/*Démarrage de la session pour toutes les pages*/
 session_start();



/* Appel des fonctions concernant les contrôleurs */
include "controllers/fonctions.php";
/* Appel des fonctions concernant les vues */
include "views/fonctions.php";

/* On évite la faille xss POUR TOUTES LES PAGES, On utilisera à l'avenir $_POST_SEC à la place de $_POST? PAREIL POUR $_GET */
$_POST_SEC = secuTab($_POST);
$_GET_SEC = secuTab($_GET);
/*On précise le fuseau horaire pour toutes les fonctions relatives au temps*/
date_default_timezone_set('Europe/Paris');

/* On identifie le contrôleur à appeler dont le nom est contenu dans cible passé en GET */
if(isset($_GET['cible']) && !empty($_GET['cible'])) {
    // Si la variable cible est passée en GET
    $url = $_GET['cible'];

} else {
    /* Si aucun contrôleur défini en GET, on bascule sur mainControleur */
    $url = 'mainController';
}

//titre par défaut pour les pages qui n'auraient pas de titre
$title='Isep';

/* On appelle le contrôleur correspondant à la cible */
include('controllers/' . $url . '.php');
?>


<!-- Pas d'inquiétude, les balises ouvrantes sont dans header.php qui est systématiquement appelé avant -->
    </body>
</html>
