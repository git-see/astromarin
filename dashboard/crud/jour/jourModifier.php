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
        && isset($_POST['dateJour']) && !empty($_POST['dateJour'])
        && isset($_POST['textAmourJour']) && !empty($_POST['textAmourJour'])
        && isset($_POST['textTravailJour']) && !empty($_POST['textTravailJour'])
        && isset($_POST['textSanteJour']) && !empty($_POST['textSanteJour'])
    ) {

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

        $_SESSION['message'] = "Prédiction modifiée";
        require_once('../../../database/deconnexionBDD.php');

        header('Location: jour.php');
    } else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

if (isset($_GET['id']) && !empty($_GET['id'])) {

    $db = getPdo();

    $id = strip_tags($_GET['id']);
    $sql = 'SELECT * FROM jour WHERE id = :id;';
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
    $sql2 = 'SELECT signe FROM signes,jour WHERE signes.id = jour.signes_id AND jour.id = :id';
    $query2 = $db->prepare($sql2);
    $query2->execute(['id' => $_GET['id']]);
    $sign = $query2->fetch();
}
?>
<link rel="stylesheet" href="/style.css">
<?php
$pageTitle = "- MODIFIER JOUR";
render('../../../', 'jour/modifier', compact('pageTitle', 'sign', 'modifie', 'result'));
?>