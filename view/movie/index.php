<?php

namespace Anax\View;

$defaultRoute = $app->url->create("movie") . "?";

$search = $app->request->getGet("search", "");
?>

<div class="movieWrap">
    <form class="searchMovie" method="get">
        <legend>Search By Title or Year</legend>
            <label>Search:
                <input type="search" name="search" value="<?= $search ?>"/>
            </label>
        <input type="submit" name="doSearch" value="title">
        <input type="submit" name="doSearch" value="year">
    </form>

    <br><br><br>
    <a href='<?= $app->url->create("movie") ?>'>Show all</a>

    <p>Items per page:
        <a href="<?= mergeQueryString(["hits" => 2], $defaultRoute) ?>">2</a> |
        <a href="<?= mergeQueryString(["hits" => 4], $defaultRoute) ?>">4</a> |
        <a href="<?= mergeQueryString(["hits" => 8], $defaultRoute) ?>">8</a>
    </p>

    <table>
        <tr class="first">
            <th>Id <?= orderby2("id", $defaultRoute) ?></th>
            <th>Bild <?= orderby2("image", $defaultRoute) ?></th>
            <th>Titel <?= orderby2("title", $defaultRoute) ?></th>
            <th>År <?= orderby2("year", $defaultRoute) ?></th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    <?php
    if (!$res) {
        echo("<tr><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><tr>");
    }
    ?>
    <?php $id = -1; foreach ($res as $row) :
        $id++;
    ?>
        <tr>
            <td><?= $row->id ?></td>
            <td><img class="thumb" src="<?= "../htdocs/" . $row->image ?>"></td>
            <td><?= $row->title ?></td>
            <td><?= $row->year ?></td>
            <td><a href='<?= $app->url->create("movie/edit?movieId={$row->id}") ?>'>Edit</a></td>
            <td><a href='<?= $app->url->create("movie/delete?movieId={$row->id}") ?>'>Delete</a></td>
        </tr>
    <?php endforeach; ?>
    </table>

    <p>
        Pages:
        <?php for ($i = 1; $i <= $max; $i++) : ?>
            <a href="<?= mergeQueryString(["page" => $i], $defaultRoute) ?>"><?= $i ?></a>
        <?php endfor; ?>
    </p>

    <br>

    <a href='<?= $app->url->create("movie/new") ?>'>Add a Movie</a>

</div>
