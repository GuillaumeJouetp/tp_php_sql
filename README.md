# Compétences visés

- Je souhaiterais être évalué sur toutes les compétences.

# Information sur le site

- Ce site est un forum 
- Il est développé en php avec la structure MVC
- Du fait de sa simplicité il n'y a qu'un unique controleur qui sert à tout faire
- Le formulaire d'inscription est vérifié en php (coté serveur) pour garantir la sécurité et en js (coté client) pour garantir l'ergonomie

# Informations sur la base de donnée

La base de donnée est gérée en PDO et est constituée de 3 tables :
- ``users`` 
- ``subjects``  qui contient la clé étrangère de users (Pour savoir qui crée le sujet)
- ``responses`` qui contient les clés étrangères de subject et users (pour savoir qui répond et pour quel sujet)

# Utilisation du site

- La page accueil permet de se connecter et d'ajouter des sujets au forum (On ne peut ajouter un sujet si on n'est pas connecté). De plus on peut voir un prévisualisation des 4 derniers sujets en cours a coté (sans les réponses et ordonnés par date de dernières réponses)
- La page inscription permet de s'incrire au forum
- La page actualité permet de voir les sujets en cours ainsi que leurs réponses (Les sujets sont classés par ordre de dernières réponses). Elle permet aussi de répondre à ces sujets. On peut également appliquer des filtres pour n'afficher que certains sujets (ces filtres sont gérés en get comme demandé). L'administrateur peut supprimer des sujets ou des réponses comme il le souhaite.
- La page contact ne contient rien
- La page administration ne contient rien pour l'instant, elle indique juste si l'utilisateur est administrateur du forum


- Avant de tester le site il faut installer la base de données qui se situe dans src/sql/tpforum.sql
- Si vous voulez tester le site vous pouvez vous creer un compte et ajouter des sujets
- Si vous voulez tester les comptes déjà inscrits voici les identifiants :


    Guillaume (admin) :
    ````
    mail : guillaume.jouet-pastre@isep.fr
    mdp  : AZERTYUIOP1
    ````
        
    Sangoku (membre) :
    ````
    mail : sangoku@planetvegeta.com
    mdp  : Jadorelesramens1
    ````
    
    Sangohan (membre) :
    ````
    mail : sangohan@terre.com
    mdp  : KAMEHAMEHA7
    ````
    
    Krillin (membre) :
    ````
    mail : krillin@terre.com
    mdp  : Jedeviendraisplusfort1jour
    ````
    
    Freezer (membre) :
    ````
    mail : freezer@namek.com
    mdp  : AmoiLes7boulesDeCristals
    ````