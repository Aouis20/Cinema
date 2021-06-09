<?php
// Récupération des paramètres en GET
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if(!$id) {
    http_response_code(400);
    echo "400 BAD REQUEST";
    exit();
}
// PDO
require_once('../inc/functions.php');

// Requête film
$stmt = $pdo->prepare("SELECT * FROM film WHERE film_id = :id");
$stmt->execute([
    "id" => $id
]);
$film = $stmt->fetch(PDO::FETCH_ASSOC);
if(!$film) {
    http_response_code(404);
    echo "404 NOT FOUND";
    exit();
}

// Requête category
$stmt2 = $pdo->prepare("
    SELECT c.* FROM film_category fc 
    JOIN category c ON c.category_id = fc.category_id 
        AND fc.film_id = :id
");
$stmt2->execute([
    "id" => $id
]);
$category = $stmt2->fetch(PDO::FETCH_ASSOC);

// Requête Actors
$stmt3 = $pdo->prepare("
    SELECT a.* FROM film_actor fa 
    JOIN actor a ON a.actor_id = fa.actor_id 
        AND fa.film_id = :id
");
$stmt3->execute([
    "id" => $id
]);
$actors = $stmt3->fetchAll(PDO::FETCH_ASSOC);
?><!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Correction Sakila</title>
    </head>
    <body>
    <!-- HEADER -->
        <section>
            <?php require_once('../tpl/header.php') ?>
        </section>

    <!-- MAIN -->
        <section>
            <h1><?= $film["title"] ?></h1>
            <p><?= $film["description"] ?></p>
            <em><?=
                (floor($film["length"] / 60) > 0 ?
                    floor($film["length"] / 60) . "h" :
                    "")
                . " " .
                ($film["length"] % 60 > 0 ?
                    $film["length"] % 60 . "min" :
                    "") 
            ?></em>
            <strong><?= $category["name"] ?></strong>
            <ul>
                <?php foreach($actors as $actor): ?>
                <li><?= ucwords(strtolower($actor["first_name"])) . " " . $actor["last_name"]?></li>
                <?php endforeach; ?>                                                                    
            </ul>
            <a href="voir-film.php?id=<?= $id - 1 ?>">Film précédent</a>
            <a href="voir-film.php?id=<?= $id + 1 ?>">Film suivant</a>
        </section>
    </body>
</html>