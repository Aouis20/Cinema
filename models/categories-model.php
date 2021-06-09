<?php
// PDO
require_once('../inc/functions.php');
$stmt = $pdo->prepare("SELECT * FROM category");
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);