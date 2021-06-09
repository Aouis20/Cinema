<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Liste d'acteurs</title>
    </head>
    <body>
    <!-- HEADER -->
        <section>
            <?php require_once('../tpl/header.php') ?>
        </section>

    <!-- MAIN -->
        <section>
            <div>
                <h1>Tous les acteurs</h1>
            </div>
            <table border=1>
                <tr>
                    <th>Acteur id</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Détails</th>
                </tr>
                <?php foreach($actors as $actor): ?>
                <tr>
                    <td><?= $actor["actor_id"] ?></td>
                    <td><?= ucwords(strtolower($actor["first_name"])) ?></td>
                    <td><?= $actor["last_name"] ?></td>
                    <td><a href="voir-acteur.php?actorid=<?= $actor["actor_id"]?>">Voir les détails</a></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </section>
    </body>
</html>