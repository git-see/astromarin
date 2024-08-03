<?php
session_start();

require_once('../../../librairies/controllers/Annee.php');

$controller = new \Controllers\Annee();
$controller->rectifier();
