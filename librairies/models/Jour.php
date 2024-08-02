<?php

require_once('../../../librairies/models/Model.php');

class Jour extends Model
{



    /*
* Retourne la liste des signes à gérer pour aujourd'hui
*/
    function jour()
    {
        $sql = 'SELECT * FROM signes, jour WHERE signes.id = jour.signes_id LIMIT 12';
        $query = $this->db->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    /*
* Ajoute une prédiction quotidienne
*/
    function ajout()
    {
        $signe = strip_tags($_POST['signes_id']);
        $dateJour = strip_tags($_POST['dateJour']);
        $textAmourJour = strip_tags($_POST['textAmourJour']);
        $textTravailJour = strip_tags($_POST['textTravailJour']);
        $textSanteJour = strip_tags($_POST['textSanteJour']);
        $sql = 'INSERT INTO jour (signes_id, dateJour, textAmourJour, textTravailJour, textSanteJour) VALUES (:signes_id, :dateJour, :textAmourJour, :textTravailJour, :textSanteJour)';
        $query = $this->db->prepare($sql);
        $query->bindValue(':signes_id', $signe, PDO::PARAM_INT);
        $query->bindValue(':dateJour', $dateJour, PDO::PARAM_STR);
        $query->bindValue(':textAmourJour', $textAmourJour, PDO::PARAM_STR);
        $query->bindValue(':textTravailJour', $textTravailJour, PDO::PARAM_STR);
        $query->bindValue(':textSanteJour', $textSanteJour, PDO::PARAM_STR);

        $query->execute();
    }

    /*
* Modifie une prédiction quotidienne 1/3
*/
    function modifie1()
    {
        $id = strip_tags($_POST['id']);
        $dateJour = strip_tags($_POST['dateJour']);
        $textAmourJour = strip_tags($_POST['textAmourJour']);
        $textTravailJour = strip_tags($_POST['textTravailJour']);
        $textSanteJour = strip_tags($_POST['textSanteJour']);
        $sql = 'UPDATE jour SET dateJour = :dateJour, textAmourJour = :textAmourJour, textTravailJour = :textTravailJour, textSanteJour = :textSanteJour WHERE id = :id;';
        $query = $this->db->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':dateJour', $dateJour, PDO::PARAM_STR);
        $query->bindValue(':textAmourJour', $textAmourJour, PDO::PARAM_STR);
        $query->bindValue(':textTravailJour', $textTravailJour, PDO::PARAM_STR);
        $query->bindValue(':textSanteJour', $textSanteJour, PDO::PARAM_STR);
        $query->execute();
    }

    /*
* Modifie une prédiction quotidienne 2/3
*/
    function modifie2($id)
    {
        $id = strip_tags($_GET['id']);
        $sql = 'SELECT * FROM jour WHERE id = :id;';
        $query = $this->db->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $modifie = $query->fetch();

        return $modifie;
    }

    /*
* Modifie une prédiction quotidienne 3/3
*/
    function modifie3($id)
    {
        $sql = 'SELECT signe FROM signes,jour WHERE signes.id = jour.signes_id AND jour.id = :id';
        $query = $this->db->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $sign = $query->fetch();

        return $sign;
    }

    /*
* Supprime une prédiction quotidienne 1/2
* 
* @param integer $id
* @return void
*/
    function supprime1($id)
    {
        $sql = 'SELECT * FROM jour WHERE id = :id;';
        $query = $this->db->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $recuperer = $query->fetch();

        return $recuperer;
    }

    /*
* Supprime une prédiction quotidienne 2/2
* 
* @param integer $id
* @return void
*/
    function supprime2($id)
    {
        $sql = 'DELETE FROM jour WHERE id = :id;';
        $query = $this->db->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
    }
}
