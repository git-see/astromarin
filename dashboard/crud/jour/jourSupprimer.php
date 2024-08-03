<?php
session_start();

require_once('../../../librairies/autoload.php');
require_once('../../../librairies/database/Database.php');

$controller = new \Controllers\Jour();
$controller->effacer();