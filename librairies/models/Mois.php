<?php

require_once('../../../librairies/models/Model.php');

class Mois extends Model
{



    /*
* Retourne la liste des signes à gérer pour le mois
*/
    function mois()
    {
        $db = getPdo();
        $sql = 'SELECT * FROM signes, mois WHERE signes.id = mois.signes_id LIMIT 12';
        $query = $this->db->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    /*
* Ajoute une prédiction mensuelle
*/
    function ajout()
    {
        $db = getPdo();
        $signe = strip_tags($_POST['signes_id']);
        $dateMois = strip_tags($_POST['dateMois']);
        $textAmourMois = strip_tags($_POST['textAmourMois']);
        $textTravailMois = strip_tags($_POST['textTravailMois']);
        $textSanteMois = strip_tags($_POST['textSanteMois']);
        $sql = 'INSERT INTO mois (signes_id, dateMois, textAmourMois, textTravailMois, textSanteMois) VALUES (:signes_id, :dateMois, :textAmourMois, :textTravailMois, :textSanteMois)';
        $query = $this->db->prepare($sql);
        $query->bindValue(':signes_id', $signe, PDO::PARAM_INT);
        $query->bindValue(':dateMois', $dateMois, PDO::PARAM_STR);
        $query->bindValue(':textAmourMois', $textAmourMois, PDO::PARAM_STR);
        $query->bindValue(':textTravailMois', $textTravailMois, PDO::PARAM_STR);
        $query->bindValue(':textSanteMois', $textSanteMois, PDO::PARAM_STR);

        $query->execute();
    }

    /*
* Modifie une prédiction mensuelle 1/3
*/
    function modifie1()
    {
        $db = getPdo();
        $id = strip_tags($_POST['id']);
        $dateMois = strip_tags($_POST['dateMois']);
        $textAmourMois = strip_tags($_POST['textAmourMois']);
        $textTravailMois = strip_tags($_POST['textTravailMois']);
        $textSanteMois = strip_tags($_POST['textSanteMois']);
        $sql = 'UPDATE mois SET dateMois = :dateMois, textAmourMois = :textAmourMois, textTravailMois = :textTravailMois, textSanteMois = :textSanteMois WHERE id = :id;';
        $query = $this->db->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':dateMois', $dateMois, PDO::PARAM_STR);
        $query->bindValue(':textAmourMois', $textAmourMois, PDO::PARAM_STR);
        $query->bindValue(':textTravailMois', $textTravailMois, PDO::PARAM_STR);
        $query->bindValue(':textSanteMois', $textSanteMois, PDO::PARAM_STR);
        $query->execute();
    }

    /*
* Modifie une prédiction mensuelle 2/3
*/
    function modifie2($id)
    {
        $db = getPdo();
        $id = strip_tags($_GET['id']);
        $sql = 'SELECT * FROM mois WHERE id = :id;';
        $query = $this->db->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $modifie = $query->fetch();

        return $modifie;
    }

    /*
* Modifie une prédiction mensuelle 3/3
*/
    function modifie3($id)
    {
        $db = getPdo();
        $sql = 'SELECT signe FROM signes,mois WHERE signes.id = mois.signes_id AND mois.id = :id';
        $query = $this->db->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $sign = $query->fetch();

        return $sign;
    }

    /*
* Supprime une prédiction mensuelle 1/2
* 
* @param integer $id
* @return void
*/
    function supprime1($id)
    {
        $db = getPdo();
        $sql = 'SELECT * FROM mois WHERE id = :id;';
        $query = $this->db->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $recuperer = $query->fetch();

        return $recuperer;
    }

    /*
* Supprime une prédiction annuelle 2/2
* 
* @param integer $id
* @return void
*/
    function supprime2($id)
    {
        $db = getPdo();
        $sql = 'DELETE FROM mois WHERE id = :id;';
        $query = $this->db->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
    }
}
