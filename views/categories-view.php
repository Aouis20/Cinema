<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Liste des catégories</title>
    </head>
    <body>
    <!-- HEADER -->
        <section>
            <?php require_once('../tpl/header.php') ?>
        </section>

    <!-- MAIN -->
        <section>
        <div>
            <h1>Toutes les catégories</h1>
        </div>
            <table border=1>
                <tr>
                    <th>Catégorie id</th>
                    <th>Nom</th>
                    <th>Détails</th>
                </tr>
                <?php foreach($categories as $categorie): ?>
                <tr>
                    <td><?= $categorie["category_id"] ?></td>
                    <td><?= $categorie["name"] ?></td>
                    <td><a href="voir-categorie.php?id=<?=$categorie["category_id"]?>&type=<?=$categorie["name"]?>">Voir les détails</a></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </section>
    </body>
</html>