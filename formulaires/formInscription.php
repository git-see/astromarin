<link rel="stylesheet" href="/style.css">
<?php
require_once ('../librairies/Rendus.php');
?>
<?php
$pageTitle = "INSCRIPTION";
\Rendus::render('../', 'formulaires/inscription', compact('pageTitle'));
?>