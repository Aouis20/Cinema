<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Liste des films</title>
    </head>
    <body>
    <!-- HEADER -->
        <section>
            <?php require_once('../tpl/header.php') ?>
        </section>

    <!-- MAIN -->
        <section>
            <div>
                <h1>Tous les films</h1>
                <?php if($page > 0): ?>
                <a href="films.php?page=<?= $page - 1 ?>">Page précédente</a>
                <?php endif; ?>
                <?php if($page < ($max / $nb) - 1): ?>
                <a href="films.php?page=<?= $page + 1 ?>">Page suivante</a>
                <?php endif; ?>
            </div>
            <table border=1>
                <tr>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Durée</th>
                    <th>Infos</th>
                </tr>
                <?php foreach($films as $film): ?>
                <tr>
                    <td><?= $film["title"] ?></td>
                    <td><?= $film["description"] ?></td>
                    <td><?=
                    (floor($film["length"] / 60) > 0 ?
                        floor($film["length"] / 60) . "h" :
                        "")
                    . " " .
                    ($film["length"] % 60 > 0 ?
                        $film["length"] % 60 . "min" :
                        "") 
                    ?></td>
                    <td><a href="voir-film.php?id=<?= $film["film_id"] ?>">Voir les détails</a></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </section>
    </body>
</html>