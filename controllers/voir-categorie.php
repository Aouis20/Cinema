<?php
// Récupération des paramètres en GET
$categoryid = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
$categorytype = filter_input(INPUT_GET, "type");
if(!$categoryid) {
    http_response_code(400);
    echo "400 BAD REQUEST";
    exit();
}
// PDO
require_once('../inc/functions.php');

// Requete films
$stmt = $pdo->prepare("
SELECT title
FROM film_category fc
JOIN film f
	ON fc.film_id = f.film_id
    AND fc.category_id = :categoryid
");
$stmt->execute([
    "categoryid" => $categoryid
]);
$films = $stmt->fetchAll(PDO::FETCH_ASSOC);
?><!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Voir categories</title>
    </head>
    <body>
    <!-- HEADER -->
        <section>
            <?php require_once('../tpl/header.php') ?>
        </section>

    <!-- MAIN -->
        <section>
            <h1><?= $categorytype ?></h1>
            <ul>
                <?php foreach ($films as $film): ?>
                <li><?= $film["title"]?></li>
                <?php endforeach;?>
            </ul>
        </section>
    </body>
</html>