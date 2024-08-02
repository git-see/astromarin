<?php
session_start();

require_once('librairies/patron.php');
require_once('librairies/models/Consulter.php');

$model = new Consulter();

if (isset($_GET['id']) && !empty($_GET['id'])) {

    $aujourdhui = new DateTime();
    $aujourdhuiFR = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::NONE);

    $id = strip_tags(stripslashes(htmlentities(trim($_GET['id']))));

    $result = $model->afficherUn($id);

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
