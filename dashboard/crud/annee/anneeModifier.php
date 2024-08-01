<?php
session_start();

require_once ('../../../librairies/database/database.php');
require_once ('../../../librairies/patron.php');

if (!isset($_SESSION["user"]) && !($_SESSION["user"]["statut"] == "Admin")) {

    redirect('../../../../formulaires/formConnexion.php', '');

}

if ($_POST) {
    if (
        isset($_POST['id']) && !empty($_POST['id'])
        && isset($_POST['dateAnnee']) && !empty($_POST['dateAnnee'])
        && isset($_POST['textAmourAnnee']) && !empty($_POST['textAmourAnnee'])
        && isset($_POST['textTravailAnnee']) && !empty($_POST['textTravailAnnee'])
        && isset($_POST['textSanteAnnee']) && !empty($_POST['textSanteAnnee'])
    ) {

        $db = getPdo();

        $id = strip_tags($_POST['id']);
        $dateAnnee = strip_tags($_POST['dateAnnee']);
        $textAmourAnnee = strip_tags($_POST['textAmourAnnee']);
        $textTravailAnnee = strip_tags($_POST['textTravailAnnee']);
        $textSanteAnnee = strip_tags($_POST['textSanteAnnee']);

        // MODIFIER
        $sql = 'UPDATE annee SET dateAnnee = :dateAnnee, textAmourAnnee = :textAmourAnnee, textTravailAnnee = :textTravailAnnee, textSanteAnnee = :textSanteAnnee WHERE id = :id;';

        $query = $db->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':dateAnnee', $dateAnnee, PDO::PARAM_STR);
        $query->bindValue(':textAmourAnnee', $textAmourAnnee, PDO::PARAM_STR);
        $query->bindValue(':textTravailAnnee', $textTravailAnnee, PDO::PARAM_STR);
        $query->bindValue(':textSanteAnnee', $textSanteAnnee, PDO::PARAM_STR);
        $query->execute();

        $_SESSION['message'] = "Prédiction modifiée";
        require_once('../../../database/deconnexionBDD.php');

        header('Location: annee.php');
    } else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

// RÉCUPÉRER ET AFFICHER
if (isset($_GET['id']) && !empty($_GET['id'])) {

    $db = getPdo();

    $id = strip_tags($_GET['id']);
    $sql = 'SELECT * FROM annee WHERE id = :id;';
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $modifie = $query->fetch();

    if (!$modifie) {
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: index.php');
    }
} else {
    $_SESSION['erreur'] = "URL invalide";
    header('Location: index.php');
}
if (
    isset($_GET['id']) && !empty($_GET['id'])
) {
    $sql2 = 'SELECT signe FROM signes,annee WHERE signes.id = annee.signes_id AND annee.id = :id';
    $query2 = $db->prepare($sql2);
    $query2->execute(['id' => $_GET['id']]);
    $sign = $query2->fetch();
}
?>

<link rel="stylesheet" href="/style.css">
<?php
$pageTitle = "- MODIFIER UNE PRÉDICTION";
render('../../../', 'annee/modifier', compact('pageTitle', 'sign', 'modifie', 'result'));
?>