<span class="emptyPage">Ceci est la page d'administration ! un peu vide n'est-ce pas ... &#9785; </span>
<?php if (isUserAdmin($bdd)){
    echo '<span class="emptyPage">  Vous êtes admin ! <span/>';
}