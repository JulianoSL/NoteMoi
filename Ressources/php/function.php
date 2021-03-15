<?php
/*
Auteur   :  Juliano Souza Luz , Dan Bonvallat , Erik Magnus Rapin
Date     :  Fin 2020
Desc.    :  fonctions pour l'ensemble du site d'article
Version  :  1.0
*/
require_once("Ressources/php/constantes.inc.php");

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
 * recherche les utilisateur par le nom
 *
 * @param [string] $nom
 * @return void
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
 * ajoute un utilisateur
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
 * recherche tout dans la table des avis
 *
 * @return void
 */
function rechercherAvis()
{
    static $ps = null;
    $sql = "SELECT * FROM avis";

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

        $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $answer = array();
        echo $e->getMessage();
    }
    return $answer;
}

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

        $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $answer = array();
        echo $e->getMessage();
    }
    return $answer;
}

function afficherToutAvis($avis)
{
    foreach ($avis as $key => $value) {
        echo '<div class="w3-row-padding">' .
            '<div class="w3-container w3-card w3-white w3-margin-bottom">' .
            '<h2 class="w3-text-grey w3-padding-16"><i class="fa fa-suitcase fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>' . GetNameFromIdProduit($value["IdProduit"])[0]["Nom"] . '</h2>' .
            '<div class="w3-container">' .
            '<h5 class="w3-opacity"><b>Note : ' . $value["Note"] . '</b></h5>' .
            '<h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>' . $value["Date"] . ' - <span class="w3-tag w3-teal w3-round">Avis de ' . GetNameFromIdUser($value["IdUtilisateur"])[0]["Nom"] . '</span></h6>' .
            '<p>' . substr($value["Commentaire"], 0, 50) . '...</p>' .
            '</div>' .
            '</div>   ' .
            '</div>';
    }
}
