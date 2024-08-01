<?php
session_start();
if (isset($_GET['id']) && !empty($_GET['id'])) {

    require_once('database/connexionBDD.php');

    $aujourdhui = new DateTime();
    $aujourdhuiFR = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::NONE);

    $id = strip_tags(stripslashes(htmlentities(trim($_GET['id']))));
    $sql = 'SELECT signes.signe, jour.textAmourJour, jour.textTravailJour, jour.textSanteJour, mois.dateMois, mois.textAmourMois, mois.textTravailMois, mois.textSanteMois, annee.textAmourAnnee, annee.textTravailAnnee, annee.textSanteAnnee
    FROM signes, jour, mois, annee
    WHERE signes.id = :id
    AND signes.id = jour.signes_id
    AND signes.id = mois.signes_id
    AND signes.id = annee.signes_id
';
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch();

    require_once('database/deconnexionBDD.php');
} else {
    echo 'Une erreur est survenue';
    header('Location: /index.php');
    exit();
}
?>

<?php
$pageTitle = "CONSULTER";
ob_start();
require('templates/consulterContent.php');
$pageContent = ob_get_clean();
require('templates/layout.php');
?>
