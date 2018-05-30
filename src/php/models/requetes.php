<?php
/*
 * Toutes les requêtes de ce fichier sont préparées et vérifiées afin d'éviter les injections SQL
 * Pour les moins vérifiées, il est garenti qu'elles ne peuvent pas être exécutés avec un input utilisateur en paramètre
*/
include "connexionPDO.php";

/**
 * READ
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
 * Récupère les éléments d'une table en fonction des attributs passés en paramètre
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
 * @param array $values
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
 * DELETE
 * Supprime l'entrée d'une table en ciblant son id
 * @param PDO $bdd
 * @param int $id
 * @param array $table
 * @return bool
 */
function supprimer(PDO $bdd, int $id, array $table): bool{

	$req = $bdd->prepare('DELETE FROM ' . $table . ' WHERE id= :id');
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
 * Retourne un array contenant les n derniers sujets ajoutés
 * Utilisation d'une jointure de table double
 * @param PDO $bdd
 * @param int $n
 * @return array
 */
function get_subjects(PDO $bdd, int $n): array {

    $statement = $bdd->prepare('SELECT subjects.id AS subject_id, subjects.dateTime AS subjectDateTime,MAX(responses.dateTime) AS lastResponseDateTime, subjects.category, subjects.content AS subjectContent,users.name AS subjectUserName
                                         FROM ((subjects 
                                         INNER JOIN users ON subjects.user_id = users.id )
                                         /*Pour aussi récupérer les sujets qui n ont pas encore de réponses on utilise LEFT JOIN*/
                                         LEFT JOIN responses ON responses.subject_id = subjects.id)
                                         GROUP BY subjects.id
                                         ORDER  BY lastResponseDateTime DESC
                                         LIMIT '.$n);
    $statement->execute();
    $return = $statement->fetchAll();
    return $return;
}

/**
 * Retourne un array contenant les dernieres réponses ajoutées
 * Utilisation d'une jointure de table double
 * @param PDO $bdd
 * @return array
 */

function get_responses(PDO $bdd): array {

    $statement = $bdd->prepare('SELECT responses.dateTime AS responseDateTime,users.name AS responseUserName,responses.content AS responseContent, subjects.id AS subject_id
                                         FROM ((responses
                                         INNER JOIN users ON responses.user_id = users.id)
                                         INNER JOIN subjects ON responses.subject_id = subjects.id)
                                         ORDER BY responses.dateTime ASC
                                         ');
    $statement->execute();
    return $statement->fetchAll();
}

/**
 * Retourne le nombre total de sujets stockés dans la bdd
 * @param PDO $bdd
 * @return array
 */

function getNumSubjects(PDO $bdd): array {

    $statement = $bdd->prepare('SELECT COUNT(*) FROM subjects');
    $statement->execute();
    return $statement->fetch();
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

