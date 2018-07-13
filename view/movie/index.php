<?php

namespace Anax\View;

if (!$res) {
    return;
}
$defaultRoute = $app->url->create("movie") . "?"
?>

<p>Items per page:
    <a href="<?= mergeQueryString(["hits" => 2], $defaultRoute) ?>">2</a> |
    <a href="<?= mergeQueryString(["hits" => 4], $defaultRoute) ?>">4</a> |
    <a href="<?= mergeQueryString(["hits" => 8], $defaultRoute) ?>">8</a>
</p>

<table>
    <tr class="first">
        <th>Rad</th>
        <th>Id <?= orderby2("id", $defaultRoute) ?></th>
        <th>Bild <?= orderby2("image", $defaultRoute) ?></th>
        <th>Titel <?= orderby2("title", $defaultRoute) ?></th>
        <th>År <?= orderby2("year", $defaultRoute) ?></th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
<?php $id = -1; foreach ($res as $row) :
    $id++;
?>
    <tr>
        <td><?= $id ?></td>
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
