<?php
// PDO
require_once('../inc/functions.php');
$stmt = $pdo->prepare("SELECT * FROM actor");
$stmt->execute();
$actors = $stmt->fetchAll(PDO::FETCH_ASSOC);