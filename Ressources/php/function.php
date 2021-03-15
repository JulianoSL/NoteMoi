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

function AfficherAvis($tableAvis)
{
    $text = "";
    foreach ($tableAvis as $key) 
    {
        $text .= "<div>";
        $text .= "<h2>" . $key["titre"] ."</h2>";
        $text .= "<p>" . $key["commentaire"] ."</p>";
        $text .= "</div>";
    }
    return $text;
}

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
