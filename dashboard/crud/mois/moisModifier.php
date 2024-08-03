<?php
session_start();

require_once('../../../librairies/autoload.php');
require_once('../../../librairies/database/Database.php');

\Astromarin::crud('\Controllers\Mois', 'rectifier');