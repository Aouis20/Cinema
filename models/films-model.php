<?php
// Récupération du paramètre de la page
$page = filter_input(INPUT_GET, "page", FILTER_VALIDATE_INT);
if($page < 1) $page = 0;

// Nombre de pages affichées : ici 50
$nb = 30;
$start = $page * $nb;

// PDO
require_once('../inc/functions.php');
// Requete films
$stmt = $pdo->prepare("SELECT * FROM film LIMIT :start, :nb");
$stmt->bindValue(":start", $start, PDO::PARAM_INT);
$stmt->bindValue(":nb", $nb, PDO::PARAM_INT);
$stmt->execute();
$films = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Requete result
$stmt2 = $pdo->prepare("SELECT COUNT(*) as cnt FROM film");
$stmt2->execute();
$result = $stmt2->fetch(PDO::FETCH_ASSOC);
$max = $result["cnt"];