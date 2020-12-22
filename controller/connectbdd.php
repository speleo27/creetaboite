
<?php
$host = "localhost";
$dbname = "cgsmxggl_creetaboite";
$user = "creetaboite";
$password = "7EM]*gmqAbCY";
try {
    $bdd = new PDO('mysql:host=' . $host . ';dbname=' . $dbname . ';charset=utf8;', $user, $password);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?> 