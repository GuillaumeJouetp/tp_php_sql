<?php
/*
 * Toutes les requêtes de ce fichier sont préparées et vérifiées afin d'éviter les injections SQL
 * Pour les moins vérifiées, il est garentis qu'elles ne peuvent pas être exécutés avec un input utilisateur en paramètre
*/
include "connexionPDO.php";

/**
 * Récupère tous les éléments d'une table
 * @param PDO $bdd
 * @param string $table
 * @return array
 */
function recupereTous(PDO $bdd, string $table): array {
    $query = 'SELECT * FROM ' . $table;
    return $bdd->query($query)->fetchAll();
}

/**
 * READ
 * Recherche des éléments en fonction des attributs passés en paramètre
 * @param PDO $bdd
 * @param string $table
 * @param array $attributs
 * @return array
 */
function recherche(PDO $bdd, string $table, array $attributs): array {

    $where = "";
    foreach($attributs as $key => $value) {
        $where .= "$key = :$key" . ", ";
    }
    $where = substr_replace($where, '', -2, 2);

    $statement = $bdd->prepare('SELECT * FROM ' . $table . ' WHERE ' . $where);


    foreach($attributs as $key => $value) {
        $statement->bindParam(":$key", $value);
    }
    $statement->execute();

    return $statement->fetchAll();

}

/**
 * CREATE
 * Insère une nouvelle entrée à une table
 * @param PDO $bdd
 * @param array $values (Souvent le $_POST)
 * @param string $table
 * @return boolean
 */
function insertion(PDO $bdd, array $values, string $table): bool {

    $attributs = '';
    $valeurs = '';
    foreach ($values as $key => $value) {

        $attributs .= $key . ', ';
        $valeurs .= ':' . $key . ', ';
        $v[] = $value;
    }

    $attributs = substr_replace($attributs, '', -2, 2); //Enleve la dernière virgule pour ne pas faire échouer la requète
    $valeurs = substr_replace($valeurs, '', -2, 2); // Pareil

    $query = ' INSERT INTO ' . $table . ' (' . $attributs . ') VALUES (' . $valeurs . ')';

    $donnees = $bdd->prepare($query);
    $requete = "";
    foreach ($values as $key => $value) {
        $requete = $requete . $key . ' : ' . $value . ', ';
        $donnees->bindParam($key, $values[$key]);
    }

    return $donnees->execute();
}

/**
 * REMOVE
 * Supprime une entrée dans devices ciblant son id
 * @param PDO $bdd
 * @param int $id
 * @param string $table
 * @return boolean
 */
function supprimer(PDO $bdd, int $id): bool{

	$req = $bdd->prepare('DELETE FROM devices WHERE id= :id');
	$req->bindParam(':id',$id);
    return $req->execute();
}

/**
 * Retourne l'id, le prénom, nom et mot de passe d'un utilisateur en fonction de son email (identification a la connexion)
 * @param PDO $bdd
 * @param string $table
 * @param string $mail
 * @return array
 */
function getId(PDO $bdd, string $table, string $mail): array {

    $statement = $bdd->prepare('SELECT id, name,last_name, pass FROM ' . $table . ' WHERE mail = :mail');
    $statement->execute(array(':mail' => $mail));
    return $statement->fetch();
}


/**
 * Vérifie si l'email en entrée est déjà dans la base de données
 * @param PDO $bdd
 * @param string $email
 * @return bool
 */
function isEmailAlreadyExist(PDO $bdd, string $email): bool {
    $statement = $bdd->prepare('SELECT COUNT(*) FROM users WHERE mail = :email');
    $statement->execute(array(':email' => $email));
    return $statement->fetchColumn() > 0 ? true : false;
}

/**
 * Retourne un array contenant les n derniers sujets ajoutés (avec le contenu, le prenom de la personne qui l'a ecrit en utilisant une jointure de table et la date du post)
 * @param PDO $bdd
 * @param int $n
 * @return array
 */
function get_subjects(PDO $bdd, int $n): array {

    $statement = $bdd->prepare('SELECT subjects.content,subjects.date,users.name FROM subjects INNER JOIN users ON subjects.user_id = users.id ORDER BY date DESC LIMIT '.$n);
    $statement->execute();
    return $statement->fetchAll();
}

/**
 * Retourne un array contenant les n derniers sujets ajoutés (avec le contenu, le prenom de la personne qui l'a ecrit en utilisant une jointure de table, la date du post et le contenue des réponses en utilisant une jointure de table double)
 * @param PDO $bdd
 * @param int $n
 * @return array
 */

function get_subjects_and_responses(PDO $bdd, int $n): array {

    $statement = $bdd->prepare('SELECT subjects.content,subjects.date,users.name FROM subjects INNER JOIN users ON subjects.user_id = users.id ORDER BY date DESC LIMIT '.$n);
    $statement->execute();
    return $statement->fetchAll();
}

/**
 * Retourne le prenom d'un user ciblant son id
 * @param PDO $bdd
 * @param int $id
 * @return array
 */

function getPrenom(PDO $bdd, int $id): array {

    $statement = $bdd->prepare('SELECT name FROM users WHERE id='.$id);
    $statement->execute();
    return $statement->fetch();
}

