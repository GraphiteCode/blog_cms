<?php
//Notifications
$alert = '';

//Roots
define('BASE_URL', 'http://localhost:8888/cms_pdo_2');

//Connection
try {
    $pdo = new PDO('mysql:host=localhost;dbname=cms', 'root', 'root');
} catch (PDOException $e) {
    exit('Database error.');
}

//Functions
function formatDate($date)
{
    $date = new DateTime($date);
    return $date->format('M jS, Y');
}

function esc($text)
{
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}
