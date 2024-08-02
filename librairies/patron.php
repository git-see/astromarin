<?php

/*
* Retourne la connexion le template
*
* @return 2 string et 1 array
*/
function render(string $path1, string $path2, array $variables = [])
{
    extract($variables);
    ob_start();
    require($path1 . 'templates/' . $path2 . '.php');
    $pageContent = ob_get_clean();
    require($path1 . 'templates/layout.php');
}

/*
* Retourne une redirection
*
* @return 2 string et 1 array
*/
function redirect(string $url, string $msg)
{
    header("Location: $url");
    die($msg);
}

/*
* Retourne la liste de tous les signes
*/
function afficherTout()
{
    $db = getPdo();
    $sql = 'SELECT `id`, `signe`, `image` FROM `signes`';
    $query = $db->prepare($sql);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

/*
* Retourne une seule prédiction pour toutes les périodes et selon le signe
*/
function afficherUn(int $id)
{
    $db = getPdo();
    $sql = 'SELECT signes.signe, jour.textAmourJour, jour.textTravailJour, jour.textSanteJour, mois.dateMois, mois.textAmourMois, mois.textTravailMois, mois.textSanteMois, annee.textAmourAnnee, annee.textTravailAnnee, annee.textSanteAnnee
    FROM signes, jour, mois, annee
    WHERE signes.id = :id
    AND signes.id = jour.signes_id
    AND signes.id = mois.signes_id
    AND signes.id = annee.signes_id';
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch();

    return $result;
}

/*
* Retourne la liste des signes à gérer pour l'année
*/
function annee()
{
    $db = getPdo();
    $sql = 'SELECT * FROM signes, annee WHERE signes.id = annee.signes_id LIMIT 12';
    $query = $db->prepare($sql);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

/*
* Ajoute une prédiction annuelle
*/
function ajoutAn()
{
    $db = getPdo();
    $signe = strip_tags($_POST['signes_id']);
    $dateAnnee = strip_tags($_POST['dateAnnee']);
    $textAmourAnnee = strip_tags($_POST['textAmourAnnee']);
    $textTravailAnnee = strip_tags($_POST['textTravailAnnee']);
    $textSanteAnnee = strip_tags($_POST['textSanteAnnee']);
    $sql = 'INSERT INTO annee (signes_id, dateAnnee, textAmourAnnee, textTravailAnnee, textSanteAnnee) VALUES (:signes_id, :dateAnnee, :textAmourAnnee, :textTravailAnnee, :textSanteAnnee)';
    $query = $db->prepare($sql);
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
function modifieAn1()
{
    $db = getPdo();
    $id = strip_tags($_POST['id']);
    $dateAnnee = strip_tags($_POST['dateAnnee']);
    $textAmourAnnee = strip_tags($_POST['textAmourAnnee']);
    $textTravailAnnee = strip_tags($_POST['textTravailAnnee']);
    $textSanteAnnee = strip_tags($_POST['textSanteAnnee']);
    $sql = 'UPDATE annee SET dateAnnee = :dateAnnee, textAmourAnnee = :textAmourAnnee, textTravailAnnee = :textTravailAnnee, textSanteAnnee = :textSanteAnnee WHERE id = :id;';
    $query = $db->prepare($sql);
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
function modifieAn2($id)
{
    $db = getPdo();
    $id = strip_tags($_GET['id']);
    $sql = 'SELECT * FROM annee WHERE id = :id;';
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $modifie = $query->fetch();

    return $modifie;
}

/*
* Modifie une prédiction annuelle 3/3
*/
function modifieAn3($id)
{
    $db = getPdo();
    $sql2 = 'SELECT signe FROM signes,annee WHERE signes.id = annee.signes_id AND annee.id = :id';
    $query2 = $db->prepare($sql2);
    $query2->bindValue(':id', $id, PDO::PARAM_INT);
    $query2->execute();
    $sign = $query2->fetch();

    return $sign;
}

/*
* Supprime une prédiction annuelle 1/2
*/
function supprimeAn1($id)
{
    $db = getPdo();
    $sql = 'SELECT * FROM annee WHERE id = :id;';
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $recuperer = $query->fetch();

    return $recuperer;
}

/*
* Supprime une prédiction annuelle 2/2
*/
function supprimeAn2($id)
{
    $db = getPdo();
    $sql = 'DELETE FROM annee WHERE id = :id;';
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
}

/*
* Retourne la liste des signes à gérer pour aujourd'hui
*/
function jour()
{
    $db = getPdo();
    $sql = 'SELECT * FROM signes, jour WHERE signes.id = jour.signes_id LIMIT 12';
    $query = $db->prepare($sql);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

/*
* Ajoute une prédiction quotidienne
*/
function ajoutJour()
{
    $db = getPdo();
    $signe = strip_tags($_POST['signes_id']);
    $dateJour = strip_tags($_POST['dateJour']);
    $textAmourJour = strip_tags($_POST['textAmourJour']);
    $textTravailJour = strip_tags($_POST['textTravailJour']);
    $textSanteJour = strip_tags($_POST['textSanteJour']);
    $sql = 'INSERT INTO jour (signes_id, dateJour, textAmourJour, textTravailJour, textSanteJour) VALUES (:signes_id, :dateJour, :textAmourJour, :textTravailJour, :textSanteJour)';
    $query = $db->prepare($sql);
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
function modifieJour1()
{
    $db = getPdo();
    $id = strip_tags($_POST['id']);
    $dateJour = strip_tags($_POST['dateJour']);
    $textAmourJour = strip_tags($_POST['textAmourJour']);
    $textTravailJour = strip_tags($_POST['textTravailJour']);
    $textSanteJour = strip_tags($_POST['textSanteJour']);
    $sql = 'UPDATE jour SET dateJour = :dateJour, textAmourJour = :textAmourJour, textTravailJour = :textTravailJour, textSanteJour = :textSanteJour WHERE id = :id;';
    $query = $db->prepare($sql);
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
function modifieJour2($id)
{
    $db = getPdo();
    $id = strip_tags($_GET['id']);
    $sql = 'SELECT * FROM jour WHERE id = :id;';
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $modifie = $query->fetch();

    return $modifie;
}

/*
* Modifie une prédiction quotidienne 3/3
*/
function modifieJour3($id)
{
    $db = getPdo();
    $sql2 = 'SELECT signe FROM signes,jour WHERE signes.id = jour.signes_id AND jour.id = :id';
    $query2 = $db->prepare($sql2);
    $query2->bindValue(':id', $id, PDO::PARAM_INT);
    $query2->execute();
    $sign = $query2->fetch();

    return $sign;
}

/*
* Supprime une prédiction quotidienne 1/2
*/
function supprimeJour1($id)
{
    $db = getPdo();
    $sql = 'SELECT * FROM jour WHERE id = :id;';
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $recuperer = $query->fetch();

    return $recuperer;
}

/*
* Supprime une prédiction annuelle 2/2
*/
function supprimeJour2($id)
{
    $db = getPdo();
    $sql = 'DELETE FROM jour WHERE id = :id;';
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
}

/*
* Retourne la liste des signes à gérer pour le mois
*/
function mois()
{
    $db = getPdo();
    $sql = 'SELECT * FROM signes, mois WHERE signes.id = mois.signes_id LIMIT 12';
    $query = $db->prepare($sql);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

/*
* Ajoute une prédiction mensuelle
*/
function ajoutMois()
{
    $db = getPdo();
    $signe = strip_tags($_POST['signes_id']);
    $dateMois = strip_tags($_POST['dateMois']);
    $textAmourMois = strip_tags($_POST['textAmourMois']);
    $textTravailMois = strip_tags($_POST['textTravailMois']);
    $textSanteMois = strip_tags($_POST['textSanteMois']);
    $sql = 'INSERT INTO mois (signes_id, dateMois, textAmourMois, textTravailMois, textSanteMois) VALUES (:signes_id, :dateMois, :textAmourMois, :textTravailMois, :textSanteMois)';
    $query = $db->prepare($sql);
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
function modifieMois1()
{
    $db = getPdo();
    $id = strip_tags($_POST['id']);
    $dateMois = strip_tags($_POST['dateMois']);
    $textAmourMois = strip_tags($_POST['textAmourMois']);
    $textTravailMois = strip_tags($_POST['textTravailMois']);
    $textSanteMois = strip_tags($_POST['textSanteMois']);
    $sql = 'UPDATE mois SET dateMois = :dateMois, textAmourMois = :textAmourMois, textTravailMois = :textTravailMois, textSanteMois = :textSanteMois WHERE id = :id;';
    $query = $db->prepare($sql);
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
function modifieMois2($id)
{
    $db = getPdo();
    $id = strip_tags($_GET['id']);
    $sql = 'SELECT * FROM mois WHERE id = :id;';
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $modifie = $query->fetch();

    return $modifie;
}

/*
* Modifie une prédiction mensuelle 3/3
*/
function modifieMois3($id)
{
    $db = getPdo();
    $sql2 = 'SELECT signe FROM signes,mois WHERE signes.id = mois.signes_id AND mois.id = :id';
    $query2 = $db->prepare($sql2);
    $query2->bindValue(':id', $id, PDO::PARAM_INT);
    $query2->execute();
    $sign = $query2->fetch();

    return $sign;
}

/*
* Supprime une prédiction mensuelle 1/2
*/
function supprimeMois1($id)
{
    $db = getPdo();
    $sql = 'SELECT * FROM mois WHERE id = :id;';
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $recuperer = $query->fetch();

    return $recuperer;
}

/*
* Supprime une prédiction annuelle 2/2
*/
function supprimeMois2($id)
{
    $db = getPdo();
    $sql = 'DELETE FROM mois WHERE id = :id;';
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
}
















