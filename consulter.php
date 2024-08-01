<?php
session_start();

require_once ('librairies/database/database.php');
require_once ('librairies/patron.php');

if (isset($_GET['id']) && !empty($_GET['id'])) {

    $db = getPdo();

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

    require_once('librairies/database/deconnexionBDD.php');
} else {
    echo 'Une erreur est survenue';
    redirect('index.php', '');
}
?>

<?php
$pageTitle = "CONSULTER";
render('', 'consulterContent', compact('pageTitle', 'aujourdhuiFR', 'aujourdhui', 'result'));
?>
