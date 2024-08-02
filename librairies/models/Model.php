<?php

require_once('../../../librairies/database/database.php');

class Model
{

    protected $db;

    public function __construct()
    {
        $this->db = getPdo();
    }







}