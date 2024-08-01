<?php
session_start();

require_once ('../../../librairies/database/database.php');
require_once ('../../../librairies/patron.php');

if (!isset($_SESSION["user"]) && !($_SESSION["user"]["statut"] == "Admin")) {

    redirect('../../../../formulaires/formConnexion.php', '');

}

if ($_POST) {

    if (
        isset($_POST['signes_id']) && !empty($_POST['signes_id'])
        && isset($_POST['dateAnnee']) && !empty($_POST['dateAnnee'])
        && isset($_POST['textAmourAnnee']) && !empty($_POST['textAmourAnnee'])
        && isset($_POST['textTravailAnnee']) && !empty($_POST['textTravailAnnee'])
        && isset($_POST['textSanteAnnee']) && !empty($_POST['textSanteAnnee'])
    ) {

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

        $_SESSION['message'] = "Prédiction ajoutée";
        require_once('../../../database/deconnexionBDD.php');

        header('Location: annee.php');
    } else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}
?>
<link rel="stylesheet" href="/style.css">
<?php
$pageTitle = "- RAJOUTER UNE PRÉDICTION SUPPRIMÉE";
render('../../../', 'annee/ajouter', compact('pageTitle', 'result'));
?>