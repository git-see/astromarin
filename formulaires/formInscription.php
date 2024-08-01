<link rel="stylesheet" href="/style.css">
<?php
require_once ('../librairies/patron.php');
?>
<?php
$pageTitle = "INSCRIPTION";
render('../', 'formulaires/inscription', compact('pageTitle'));
?>