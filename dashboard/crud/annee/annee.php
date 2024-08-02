<?php
session_start();

require_once('../../../librairies/database/database.php');
require_once('../../../librairies/patron.php');

if (!isset($_SESSION["user"]) && !($_SESSION["user"]["statut"] == "Admin")) {

    redirect('../../../../formulaires/formConnexion.php', '');
} else {

    $result = annee();
}
?>
<link rel="stylesheet" href="/style.css">
<?php
$pageTitle = "- GESTION ANNÉE";
render('../../../', 'annee/annee', compact('pageTitle', 'result'));
?>