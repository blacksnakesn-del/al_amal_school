<?php

require_once dirname(__DIR__). '/app/models/Database.models.php';
require_once dirname(__DIR__). '/app/models/Auth.models.php';
require_once dirname(__DIR__). '/app/models/Note.models.php';
require_once dirname(__DIR__). '/app/models/AnneeCourant.models.php';


session_start();

$db = new Database();

$pdo = $db->getConnexion();

$auth = new Auth($pdo);
$note = new Note($pdo);
$annee = new AnneeCourante($pdo);