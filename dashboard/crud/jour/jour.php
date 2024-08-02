<?php
session_start();

require_once('../../../librairies/database/database.php');
require_once('../../../librairies/patron.php');
require_once('../../../librairies/models/Jour.php');

$jour = new jour();


if (!isset($_SESSION["user"]) && !($_SESSION["user"]["statut"] == "Admin")) {

    redirect('../../../../formulaires/formConnexion.php', '');
} else {

    $result = $jour->jour();
}
?>
<link rel="stylesheet" href="/style.css">
<?php
$pageTitle = "- GESTION JOUR";
render('../../../', 'jour/jour', compact('pageTitle', 'result'));
?>