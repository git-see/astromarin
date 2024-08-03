<?php
session_start();

require_once('../../../librairies/autoload.php');

$controller = new \Controllers\Mois();
$controller->effacer();
