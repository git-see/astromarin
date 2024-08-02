<?php

require_once('../../../librairies/models/Model.php');

class Consulter extends Model
{



    /*
* Retourne la liste de tous les signes
*
* @return array
*/
    public function afficherTout()
    {
        $sql = 'SELECT `id`, `signe`, `image` FROM `signes`';
        $query = $this->db->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    /*
* Retourne une seule prédiction pour toutes les périodes et selon le signe
*
* @return array|bool   true si le signe est trouvé sinon false
*/
    public function afficherUn(int $id)
    {
        $sql = 'SELECT signes.signe, jour.textAmourJour, jour.textTravailJour, jour.textSanteJour, mois.dateMois, mois.textAmourMois, mois.textTravailMois, mois.textSanteMois, annee.textAmourAnnee, annee.textTravailAnnee, annee.textSanteAnnee
    FROM signes, jour, mois, annee
    WHERE signes.id = :id
    AND signes.id = jour.signes_id
    AND signes.id = mois.signes_id
    AND signes.id = annee.signes_id';
        $query = $this->db->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch();

        return $result;
    }
}
