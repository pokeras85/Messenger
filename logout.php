<?php

session_start();

include('Configuratiomn/database.php');

$database= new Database();


$database->deactivate($_SESSION['username']); //delete user from active user


session_destroy();

header('location: index.php');

