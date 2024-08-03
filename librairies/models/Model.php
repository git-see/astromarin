<?php

namespace Models;

require_once('../../../librairies/database/database.php');

abstract class Model
{
    protected $db;
    protected $table;

    public function __construct()
    {
        $this->db = getPdo();
    }

    /*
* Lire tout
*/
    public function panorama()
    {
        $sql = "SELECT * FROM signes, {$this->table} WHERE signes.id = {$this->table}.signes_id";
        $query = $this->db->prepare($sql);
        $query->execute();
        $result = $query->fetchAll($this->db::FETCH_ASSOC);

        return $result;
    }

    /*
* Ajoute une prédiction
*/
    public function ajout()
    {
        $signe = strip_tags($_POST['signes_id']);
        $champDate = strip_tags($_POST['champDate']);
        $textAmour = strip_tags($_POST['textAmour']);
        $textTravail = strip_tags($_POST['textTravail']);
        $textSante = strip_tags($_POST['textSante']);

        $sql = "INSERT INTO {$this->table} (signes_id, champDate, textAmour, textTravail, textSante) VALUES (:signes_id, :champDate, :textAmour, :textTravail, :textSante)";

        $query = $this->db->prepare($sql);
        $query->bindValue(':signes_id', $signe, $this->db::PARAM_INT);
        $query->bindValue(':champDate', $champDate, $this->db::PARAM_STR);
        $query->bindValue(':textAmour', $textAmour, $this->db::PARAM_STR);
        $query->bindValue(':textTravail', $textTravail, $this->db::PARAM_STR);
        $query->bindValue(':textSante', $textSante, $this->db::PARAM_STR);

        $query->execute();
    }

    /*
* Modifie une prédiction 1/3
*/
    public function modifie1()
    {
        $id = strip_tags($_POST['id']);
        $champDate = strip_tags($_POST['champDate']);
        $textAmour = strip_tags($_POST['textAmour']);
        $textTravail = strip_tags($_POST['textTravail']);
        $textSante = strip_tags($_POST['textSante']);
        $sql = "UPDATE {$this->table} SET champDate = :champDate, textAmour = :textAmour, textTravail = :textTravail, textSante = :textSante WHERE id = :id;";
        $query = $this->db->prepare($sql);
        $query->bindValue(':id', $id, $this->db::PARAM_INT);
        $query->bindValue(':champDate', $champDate, $this->db::PARAM_STR);
        $query->bindValue(':textAmour', $textAmour, $this->db::PARAM_STR);
        $query->bindValue(':textTravail', $textTravail, $this->db::PARAM_STR);
        $query->bindValue(':textSante', $textSante, $this->db::PARAM_STR);
        $query->execute();
    }

    /*
* Modifie une prédiction 2/3
*/
    public function modifie2($id)
    {
        $id = strip_tags($_GET['id']);
        $sql = "SELECT * FROM {$this->table} WHERE id = :id;";
        $query = $this->db->prepare($sql);
        $query->bindValue(':id', $id, $this->db::PARAM_INT);
        $query->execute();
        $modifie = $query->fetch();

        return $modifie;
    }

    /*
* Modifie une prédiction 3/3
*/
    public function modifie3($id)
    {
        $sql = "SELECT signe FROM signes,{$this->table} WHERE signes.id = {$this->table}.signes_id AND {$this->table}.id = :id";
        $query = $this->db->prepare($sql);
        $query->bindValue(':id', $id, $this->db::PARAM_INT);
        $query->execute();
        $sign = $query->fetch();

        return $sign;
    }

    /*
* Supprime une prédiction 1/2
* 
* @param integer $id
* @return void
*/
    public function supprime1($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id;";
        $query = $this->db->prepare($sql);
        $query->bindValue(':id', $id, $this->db::PARAM_INT);
        $query->execute();
        $recuperer = $query->fetch();

        return $recuperer;
    }
    /*
* Supprime une prédiction 2/2
* 
* @param integer $id
* @return void
*/
    public function supprime2($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = :id;";
        $query = $this->db->prepare($sql);
        $query->bindValue(':id', $id, $this->db::PARAM_INT);
        $query->execute();
    }
}
