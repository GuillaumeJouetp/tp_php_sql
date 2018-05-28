<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name=description content="Page du site internet de l'isep dans laquelle on peut retrouver une interface pour ajouter des sujets et y répondre. Présence d'un forum " >
    <meta name=keywords content="Isep, forum, inscription, sujet, école, numérique, contact, dragon ball z" >

    <title><?php echo $title ?></title>
    <!-- Importation de l'icone du site -->
    <link rel="icon" type="image/png" href="../../res/img/favicon.png" />
    <!-- Importation du style permettant de minimifier les différences de rendu entre les navigateurs-->
    <link rel="stylesheet" href="../css/reset.css">
    <!-- Importation du style commmun à toutes les pages-->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/formControl.css">
    <!-- Importation dynamique du style spécifique à la page-->
    <link rel="stylesheet" href="../css/<?php echo $vue?>.css">

</head>
<body>

    <header>
        <img id='logo' src="../../res/img/Logo_isep.png" alt="Image du logo de l'isep" title="Logo de l'isep" />
        <nav>
            <a href="index.php?cible=mainController" class="liens">&starf; Accueil</a>
            <!-- La page d'inscription ne s'affiche uniquement quand l'utlisateur n'est pas connecté-->
            <?php displayInscription() ?>
            <a href="index.php?cible=mainController&function=bouttonActualite" class="liens">&#9872; Actualité</a>
            <a href="index.php?cible=mainController&function=bouttonContact" class="liens">&#9993; Contact</a>
            <a href="index.php?cible=mainController&function=bouttonAdministration" class="liens">&#9991; Administration</a>
            <span class="bienvenue"><?php echo displayBienvenue('Bienvenue');?></span>
        </nav>
        <!-- Tous les messages d'erreurs seront affichés ici (factorisation pour les erreurs)-->
        <span class="warning"><?= $error ?></span>
    </header>
