<?php
require_once("database.php");

/**
 * Retourne les données d'une note en fonction de son idnote
 * @param mixed $branche, $date 
 * @return false|array 
 */
function read($recherche)
{
    static $ps = null;
    $sql = "SELECT idnote, branche, DATE_FORMAT(`date`, '%Y-%m-%d') as `date`, note, remarque, coefficient";
    $sql .= " FROM `notes`";
    $sql .= " WHERE `branche` LIKE :search OR `date` = :search LIMIT 50";

    if ($ps == null) {
        $ps = connectDB()->prepare($sql);
    }
    $answer = false;
    try {
        $recherche = '%' . $recherche . '%';
        $ps->bindParam(":search", $recherche, PDO::PARAM_STR);

        if ($ps->execute())
            $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $answer;
}

function readById($idNote)
{
    static $ps = null;
    $sql = "SELECT idnote, branche, DATE_FORMAT(`date`, '%Y-%m-%d') as `date`, note, remarque, coefficient FROM `notes` WHERE idNote=:idNote";

    if ($ps == null) {
        $ps = connectDB()->prepare($sql);
    }
    $answer = false;
    try {
        $ps->bindParam(":idNote", $idNote, PDO::PARAM_INT);

        if ($ps->execute())
            $answer = $ps->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $answer;
}

function add($branche, $date, $note, $remarque)
{
    static $ps = null;
    $sql = 'INSERT INTO `notes` (`idnote`, `branche`, `date`, `note`, `remarque`, `coefficient`)'
        . ' VALUES (NULL, :branche, :date, :note, :remarque, NULL)';
    if ($ps == null) {
        $ps = connectDB()->prepare($sql);
    }
    $answer = false;
    try {
        $ps->bindParam(":branche", $branche, PDO::PARAM_STR);
        $ps->bindParam(":date", $date, PDO::PARAM_STR);
        $ps->bindParam(":note", $note, PDO::PARAM_STR);
        $ps->bindParam(":remarque", $remarque, PDO::PARAM_STR);
        if ($ps->execute())
            $answer = true;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $answer;
}

function delete($idNote)
{
    static $ps = null;
    $sql = 'DELETE FROM `notes` WHERE `notes`.`idnote` = :idNote';
    if ($ps == null) {
        $ps = connectDB()->prepare($sql);
    }
    $answer = false;
    try {
        $ps->bindParam(":idNote", $idNote, PDO::PARAM_STR);
        if ($ps->execute())
            $answer = true;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $answer;
}

function update($branche, $date, $note, $remarque, $idNote)
{
    // Faire update
    static $ps = null;
    $sql = "UPDATE `notes` SET `branche` = :branche, `date` = :date, `note` = :note, `remarque` = :remarque WHERE `notes`.`idnote` = :idNote";
    if ($ps == null) {
        $ps = connectDB()->prepare($sql);
    }
    $answer = false;
    try {
        $ps->bindParam(":branche", $branche, PDO::PARAM_STR);
        $ps->bindParam(":date", $date, PDO::PARAM_STR);
        $ps->bindParam(":note", $note, PDO::PARAM_STR);
        $ps->bindParam(":remarque", $remarque, PDO::PARAM_STR);
        $ps->bindParam(":idNote", $idNote, PDO::PARAM_INT);
        if ($ps->execute()) {
            $answer = true;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    return $answer;
}

function NotesToHtmlTable($array)
{
    try {
        foreach ($array as $value) {
            echo "<tr>"
                . "<td>" . $value["idnote"] . "</td>"
                . "<td>" . $value["branche"] . "</td>"
                . "<td>" . $value["date"] . "</td>"
                . "<td>" . $value["note"] . "</td>"
                . "<td>" . $value["remarque"] . "</td>"
                . "<td>" . $value["coefficient"] . "</td>"
                . "</tr>";
        }
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
}

function brancheToSelect($branche)
{
    try {
        $branches = array(
            "Langue & Société",
            "Société",
            "Anglais",
            "Mathématiques",
            "Physique",
            "Education Physique"
        );
        foreach ($branches as $b) {
            echo "<option value='" . $b . "' " . ($branche == $b ? 'selected' : '') . ">" . $b . "</option>";
        }
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
}
