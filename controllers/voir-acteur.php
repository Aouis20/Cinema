<?php
// Récupération des paramètres en GET
$actorid = filter_input(INPUT_GET, "actorid", FILTER_VALIDATE_INT);
if(!$actorid) {
    http_response_code(400);
    echo "400 BAD REQUEST";
    exit();
}
// PDO
require_once('../inc/functions.php');

// Requete acteurs
$stmt = $pdo->prepare("
SELECT title,:actorid 
FROM film_actor fa
JOIN film f
	ON fa.film_id = f.film_id
    AND fa.actor_id = :actorid
");
$stmt->execute([
    "actorid" => $actorid
]);
$actors = $stmt->fetchAll(PDO::FETCH_ASSOC);
?><!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Voir acteurs</title>
    </head>
    <body>
    <!-- HEADER -->
        <section>
            <?php require_once('../tpl/header.php') ?>
        </section>

    <!-- MAIN -->
        <section>
            <h1>Acteurs</h1>
            <ul>
                <?php foreach ($actors as $actor): ?>
                <li><?= $actor["title"]?></li>
                <?php endforeach;?>
            </ul>
        </section>
    </body>
</html>