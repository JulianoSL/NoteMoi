<?php
/*
Auteur   :  Juliano Souza Luz , Dan Bonvallat , Erik Magnus Rapin
Date     :  Fin 2020
Desc.    :  fonctions pour l'ensemble du site d'article
Version  :  1.0
*/
require_once("constantes.inc.php");

/**
 * Connecteur de la base de données du .
 * Le script meurt (die) si la connexion n'est pas possible.
 * @static var PDO $dbc
 * @return \PDO
 */
function dbData()
{
    static $dbc = null;

    // Première visite de la fonction
    if ($dbc == null) {
        // Essaie le code ci-dessous
        try {
            $dbc = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, DBUSER, DBPWD, array(
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4",
                PDO::ATTR_PERSISTENT => true,
                PDO::ERRMODE_EXCEPTION => PDO::ATTR_ERRMODE
            ));
        }
        // Si une exception est arrivée
        catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage() . '<br />';
            echo 'N° : ' . $e->getCode();
            // Quitte le script et meurt
            die('Could not connect to MySQL');
        }
    }
    // Pas d'erreur, retourne un connecteur
    return $dbc;
}
/**
 * affiche les utilisateurs
 *
 * @return void
 */
function afficherUtilisateurs()
{
    static $ps = null;
    $sql = "SELECT idAvis, titreAvis, commentaireAvis FROM avis WHERE idProduit = :idProduit";

    $answer = false;
    try {
        if ($ps == null) {
            $ps = dbData()->prepare($sql);
        }
        $ps->execute();

        $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $answer = array();
        echo $e->getMessage();
    }
    return $answer;
}

/**
 * recherche les avis par l'id produit
 *
 * @param [int] $id
 * @return void
 */
function rechercheAvisParIdProduit($id)
{
    static $ps = null;
    $sql = "SELECT idAvis, titreAvis, commentaireAvis FROM avis WHERE idProduit = :idProduit";

    $answer = false;
    try {
        if ($ps == null) {
            $ps = dbData()->prepare($sql);
        }
        $ps->bindParam(':idProduit', $id, PDO::PARAM_INT);
        $ps->execute();

        $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $answer = array();
        echo $e->getMessage();
    }
    return $answer;
}
/**
 * recherche les utilisateurs par le nom
 *
 * @param string $nom
 * @return array
 */
function rechercheUtilisateurParNom($nom)
{
    static $ps = null;
    $sql = "SELECT `IdUtilisateur`, `Nom`, `Mdp`, `Role` FROM notemoi.utilisateur WHERE Nom like :Nom";

    $answer = false;
    try {
        if ($ps == null) {
            $ps = dbData()->prepare($sql);
        }
        $ps->bindParam(':Nom', $nom, PDO::PARAM_STR);
        $ps->execute();

        $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $answer = array();
        echo $e->getMessage();
    }
    return $answer;
}
/**
 * ajouter un utilisateur dans la bd
 *
 * @param [string] $username
 * @param [string] $password
 * @return void
 */
function AjouterUtilisateur($username, $password)
{
    static $ps = null;
    $sql = "INSERT INTO notemoi.utilisateur (Nom, Mdp, Role) VALUES (:username, :password, 'utilisateur')";

    $answer = false;
    try {
        if ($ps == null) {
            $ps = dbData()->prepare($sql);
        }
        $ps->bindParam(':username', $username, PDO::PARAM_STR);
        $ps->bindParam(':password', $password, PDO::PARAM_STR);
        $ps->execute();

        $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $answer = array();
        echo $e->getMessage();
    }
    return $answer;
}
/**
 * rechercher un avis
 *
 * @return void
 */
function rechercherAvis($offset)
{
    static $ps = null;
    $sql = "SELECT * FROM avis LIMIT 5 OFFSET :OFFSET";

    $answer = false;
    try {
        if ($ps == null) {
            $ps = dbData()->prepare($sql);
        }
        $ps->bindParam(':OFFSET', $offset, PDO::PARAM_INT);
        $ps->execute();

        $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $answer = array();
        echo $e->getMessage();
    }
    return $answer;
}
/**
 * retourne le nom du produit en fontion de son id
 *
 * @param [type] $idProduit
 * @return void
 */
function GetNameFromIdProduit($idProduit)
{
    static $ps = null;
    $sql = "SELECT Nom FROM produit WHERE idProduit = :ID_PRODUIT";

    $answer = false;
    try {
        if ($ps == null) {
            $ps = dbData()->prepare($sql);
        }
        $ps->bindParam(':ID_PRODUIT', $idProduit, PDO::PARAM_STR);
        $ps->execute();

        $answer = $ps->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $answer = array();
        echo $e->getMessage();
    }
    return $answer;
}
/**
 * recupere le nom de l'utilisateur depuis son id
 *
 * @param [type] $idUser
 * @return void
 */
function GetNameFromIdUser($idUser)
{
    static $ps = null;
    $sql = "SELECT Nom FROM utilisateur WHERE IdUtilisateur = :ID_USER";

    $answer = false;
    try {
        if ($ps == null) {
            $ps = dbData()->prepare($sql);
        }
        $ps->bindParam(':ID_USER', $idUser, PDO::PARAM_STR);
        $ps->execute();

        $answer = $ps->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $answer = array();
        echo $e->getMessage();
    }
    return $answer;
}

/**
 * Retourne toutes les informations du produit séléctionné
 *
 * @param [int] $idAvis
 * @return void
 */
function returnAvis($idAvis)
{
    static $ps = null;
    $sql = "SELECT idAvis, Commentaire, Note, IdUtilisateur, idProduit FROM avis WHERE IdAvis = :ID_AVIS";

    $answer = false;
    try {
        if ($ps == null) {
            $ps = dbData()->prepare($sql);
        }
        $ps->bindParam(':ID_AVIS', $idAvis, PDO::PARAM_INT);
        $ps->execute();

        $answer = $ps->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $answer = array();
        echo $e->getMessage();
    }
    return $answer;
}

/**
 * retourne l'id et le nom de l'utilisateur
 *
 * @param [int] $idUtilisateur
 * @return void
 */
function returnNameUtilisateur($idUtilisateur)
{
    static $ps = null;
    $sql = "SELECT idUtilisateur, Nom FROM utilisateur WHERE IdUtilisateur = :ID_USER";

    $answer = false;
    try {
        if ($ps == null) {
            $ps = dbData()->prepare($sql);
        }
        $ps->bindParam(':ID_USER', $idUtilisateur, PDO::PARAM_INT);
        $ps->execute();

        $answer = $ps->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $answer = array();
        echo $e->getMessage();
    }
    return $answer;
}

/**
 * Retourne les informations du produit séléctionné
 *
 * @param [int] $idProduit
 * @return void
 */
function returnProduit($idProduit)
{
    static $ps = null;
    $sql = "SELECT idUtilisateur, Nom FROM utilisateur WHERE IdUtilisateur = :ID_PRODUIT";

    $answer = false;
    try {
        if ($ps == null) {
            $ps = dbData()->prepare($sql);
        }
        $ps->bindParam(':ID_PRODUIT', $idProduit, PDO::PARAM_INT);
        $ps->execute();

        $answer = $ps->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $answer = array();
        echo $e->getMessage();
    }
    return $answer;
}


/**
 * affiche les avis 
 *
 * @param [array] $avis
 * @return void
 */
function afficherToutAvis($avis)
{
    foreach ($avis as $key => $value) {
        echo '<a class="underline-none" href="index.php?body=avis.php&idAvis=' . $value["IdAvis"] . '"><div class="w3-row-padding">' .
            '<div class="w3-container w3-card w3-white w3-margin-bottom">' .
            '<h2 class="w3-text-grey w3-padding-16"><i class="fa fa-suitcase fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>' . GetNameFromIdProduit($value["IdProduit"])["Nom"] . '</h2>' .
            '<div class="w3-container">' .
            '<h5 class="w3-opacity"><b>Note : ' . $value["Note"] . '</b></h5>' .
            '<h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>' . $value["Date"] . ' - <span class="w3-tag w3-teal w3-round">Avis de ' . GetNameFromIdUser($value["IdUtilisateur"])["Nom"] . '</span></h6>' .
            '<p>' . substr($value["Commentaire"], 0, 30) . '...</p>' .
            '</div>' .
            '</div>   ' .
            '</div></a>';
    }
}
/**
 * selectionne tout les produits de la bd
 *
 * @return array
 */
function selectAllProduct()
{
    static $ps = null;
    $sql = "SELECT idProduit,Nom, produit.Image, Marque, Prix, produit.Type FROM produit";

    $answer = false;
    try {
        if ($ps == null) {
            $ps = dbData()->prepare($sql);
        }
        $ps->execute();

        $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $answer = array();
        echo $e->getMessage();
    }
    return $answer;
}
/**
 * select un produit en fonction de son nom
 *
 * @param string $nomProduit
 * @return array
 */
function selectProductFromName($nomProduit)
{
    static $ps = null;
    $sql = "SELECT idProduit,Nom, `Image`, Marque, Prix, `Type` FROM produit WHERE Nom LIKE :NOM_PRODUIT";

    $answer = false;
    try {
        if ($ps == null) {
            $ps = dbData()->prepare($sql);
        }
        $ps->bindParam(':NOM_PRODUIT', $nomProduit, PDO::PARAM_STR);
        $ps->execute();

        $answer = $ps->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $answer = array();
        echo $e->getMessage();
    }
    return $answer;
}
/**
 * retourne l'id du dernier utilisateur inscrit
 *
 * @return void
 */
function GetLastIdUser()
{
    static $ps = null;
    $sql = "SELECT IdUtilisateur FROM utilisateur ORDER BY IdUtilisateur DESC LIMIT 1";

    $answer = false;
    try {
        if ($ps == null) {
            $ps = dbData()->prepare($sql);
        }
        $ps->execute();

        $answer = $ps->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $answer = array();
        echo $e->getMessage();
    }
    return $answer;
}
/**
 * ajoute un avis dans la bd
 *
 * @param string $commentaire
 * @param int $idProduit
 * @param int $idUtilisateur
 * @param string $note
 * @return void
 */
function ajouterAvis($commentaire, $idProduit, $idUtilisateur, $note)
{
    static $ps = null;
    $sql = 'INSERT INTO avis (Commentaire,IdProduit,IdUtilisateur,Note)VALUES (:COMMENTAIRE, :ID_PRODUIT,:ID_UTILISATEUR,:NOTE)';

    $answer = false;
    try {
        if ($ps == null) {
            $ps = dbData()->prepare($sql);
        }
        $ps->bindParam(':COMMENTAIRE', $commentaire, PDO::PARAM_STR);
        $ps->bindParam(':ID_PRODUIT', $idProduit, PDO::PARAM_INT);
        $ps->bindParam(':ID_UTILISATEUR', $idUtilisateur, PDO::PARAM_INT);
        $ps->bindParam(':NOTE', $note, PDO::PARAM_STR);

        $answer = $ps->execute();
    } catch (Exception $e) {
        $answer = array();
        echo $e->getMessage();
    }
    return $answer;
}

/**
 * compte le nombre d'avis de la base de données
 *
 * @return int
 */
function countNombreAvis()
{
    static $ps = null;
    $sql = 'SELECT COUNT(idAvis) FROM avis ';

    $answer = false;
    try {
        if ($ps == null) {
            $ps = dbData()->prepare($sql);
        }
        $ps->execute();

        $answer = $ps->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $answer = array();
        echo $e->getMessage();
    }
    return $answer;
}
