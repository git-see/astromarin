<?php

require_once('../../../librairies/models/Model.php');

class Annee extends Model
{



    /*
* Retourne la liste des signes à gérer pour l'année
*
* @return array
*/
    public function annee()
    {
        $sql = 'SELECT * FROM signes, annee WHERE signes.id = annee.signes_id LIMIT 12';
        $query = $this->db->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    /*
* Ajoute une prédiction annuelle
*/
    public function ajout()
    {
        $signe = strip_tags($_POST['signes_id']);
        $dateAnnee = strip_tags($_POST['dateAnnee']);
        $textAmourAnnee = strip_tags($_POST['textAmourAnnee']);
        $textTravailAnnee = strip_tags($_POST['textTravailAnnee']);
        $textSanteAnnee = strip_tags($_POST['textSanteAnnee']);

        $sql = 'INSERT INTO annee (signes_id, dateAnnee, textAmourAnnee, textTravailAnnee, textSanteAnnee) VALUES (:signes_id, :dateAnnee, :textAmourAnnee, :textTravailAnnee, :textSanteAnnee)';

        $query = $this->db->prepare($sql);
        $query->bindValue(':signes_id', $signe, PDO::PARAM_INT);
        $query->bindValue(':dateAnnee', $dateAnnee, PDO::PARAM_STR);
        $query->bindValue(':textAmourAnnee', $textAmourAnnee, PDO::PARAM_STR);
        $query->bindValue(':textTravailAnnee', $textTravailAnnee, PDO::PARAM_STR);
        $query->bindValue(':textSanteAnnee', $textSanteAnnee, PDO::PARAM_STR);

        $query->execute();
    }

    /*
* Modifie une prédiction annuelle 1/3
*/
    public function modifie1()
    {
        $id = strip_tags($_POST['id']);
        $dateAnnee = strip_tags($_POST['dateAnnee']);
        $textAmourAnnee = strip_tags($_POST['textAmourAnnee']);
        $textTravailAnnee = strip_tags($_POST['textTravailAnnee']);
        $textSanteAnnee = strip_tags($_POST['textSanteAnnee']);
        $sql = 'UPDATE annee SET dateAnnee = :dateAnnee, textAmourAnnee = :textAmourAnnee, textTravailAnnee = :textTravailAnnee, textSanteAnnee = :textSanteAnnee WHERE id = :id;';
        $query = $this->db->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':dateAnnee', $dateAnnee, PDO::PARAM_STR);
        $query->bindValue(':textAmourAnnee', $textAmourAnnee, PDO::PARAM_STR);
        $query->bindValue(':textTravailAnnee', $textTravailAnnee, PDO::PARAM_STR);
        $query->bindValue(':textSanteAnnee', $textSanteAnnee, PDO::PARAM_STR);
        $query->execute();
    }

    /*
* Modifie une prédiction annuelle 2/3
*/
    public function modifie2($id)
    {
        $id = strip_tags($_GET['id']);
        $sql = 'SELECT * FROM annee WHERE id = :id;';
        $query = $this->db->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $modifie = $query->fetch();

        return $modifie;
    }

    /*
* Modifie une prédiction annuelle 3/3
*/
    public function modifie3($id)
    {
        $sql = 'SELECT signe FROM signes,annee WHERE signes.id = annee.signes_id AND annee.id = :id';
        $query = $this->db->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $sign = $query->fetch();

        return $sign;
    }

    /*
* Supprime une prédiction annuelle 1/2
* 
* @param integer $id
* @return void
*/
    public function supprime1($id)
    {
        $sql = 'SELECT * FROM annee WHERE id = :id;';
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
    public function supprime2($id)
    {
        $sql = 'DELETE FROM annee WHERE id = :id;';
        $query = $this->db->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
    }
}
