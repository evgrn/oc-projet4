<?php
// Définition de la racine
define('ROOT', dirname(__DIR__));

// Initialisation de l'application
require ROOT . '/app/App.php';
App::init();

// Initialisation du routeur
\App\Router::route();
