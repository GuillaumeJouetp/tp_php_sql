<span class="emptyPage"> <?= $adminMessage ?> </span>
<?php if (isUserAdmin($bdd)){
    header("location: index.php?cible=mainController&function=bouttonActualite");
}