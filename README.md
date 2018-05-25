# Compétences visés

- Je souhaiterais être évalué sur toutes les compétences excepté les compétences javascript que je n'ai pas eu le temps de mettre en place

# Information sur le site

- Ce site est développé en php avec la structure MVC
- Du fait de sa simplicité il n'y a qu'un unique controleur qui sert à tout faire
- La base de donnée est constituée de 3 tables : users, subjects et responses. La table responses contient la clé étrangère de subject qui contient elle même la clé étrangère de users (Cela permet de situer qui publie quoi et pour quel sujet)

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
- La page actualité permet de voir les sujets en cours ainsi que leurs réponses. Elle permet aussi de répondre à ces sujets - Sujet 1 : 2 réponses | Sujet 2 : 1 réponse | Sujet 3 : 3 réponses | Sujet 4 : 0 réponses (Page non finie dans la limite de temps, le système de tri n'a pas été fait et on ne peut pas répondre aux sujets : 404)
- La page contact ne contient rien
- La page administration ne contient rien