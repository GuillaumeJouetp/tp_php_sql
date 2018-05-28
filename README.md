# Compétences visés

- Je souhaiterais être évalué sur toutes les compétences excepté les compétences javascript que je n'ai pas eu le temps de mettre en place

# Information sur le site

- Ce site est développé en php avec la structure MVC
- Ce site est un forum 
- Du fait de sa simplicité il n'y a qu'un unique controleur qui sert à tout faire
- La base de donnée est constituée de 3 tables : users, subjects et responses. La table responses contient la clé étrangère de subject qui contient elle même la clé étrangère de users (Cela permet de situer qui publie quoi et pour quel sujet)
- Le formulaire d'inscription est vérifié en php (coté serveur) pour garantir la sécurité et en js (coté client) pour garantir l'intéractivité

# Utilisation du site

- Avant de tester le site il faut installer la base de données qui se situe dans src/sql/isep_tp_php.sql
- Si vous voulez tester le site vous pouvez vous creer un compte et ajouter des sujets
- Si vous voulez tester les comptes déjà inscrits voici les identifiants :

    Sangoku :
    ````
    mail : sangoku@planetvegeta.com
    mdp  : Jadorelesramens1
    ````
    
    Sangohan :
    ````
    mail : sangohan@terre.com
    mdp  : KAMEHAMEHA7
    ````
    
    Krillin :
    ````
    mail : krillin@terre.com
    mdp  : Jedeviendraisplusfort1jour
    ````
    
    Freezer :
    ````
    mail : freezer@namek.com
    mdp  : AmoiLes7boulesDeCristals
    ````

- La page accueil permet de se connecter et d'ajouter des sujets au forum (On ne peut ajouter un sujet si on n'est pas connecté). De plus on peut voir un prévisualisation des 4 derniers sujets en cours a coté (sans les réponses et ordonnés par date)
- La page inscription permet de s'incrire au forum
- La page actualité permet de voir les sujets en cours ainsi que leurs réponses. Elle permet aussi de répondre à ces sujets (Page non finie il reste à faire le système de tri)
- La page contact ne contient rien
- La page administration ne contient rien

//TODO 

- Implémenter le système de tri sur la page actualité
- Implémenter l'ajout de catégorie à un sujet (Pour l'instant lors de l'ajout la valeur par defaut 'Autre' est active)