<?php

namespace Anax\View;

$route = "page";
$resultset = $app->ch->handleRoute($route);
$pageLocation = $app->url->create("content/page");
?>
<main>
    <div class="contentBody">
        <h1>Publicerade sidor</h1>
        <table>
            <tr class="first">
                <th>Id</th>
                <th>Title</th>
                <th>Type</th>
                <th>Status</th>
                <th>Published</th>
                <th>Deleted</th>
            </tr>
        <?php foreach ($resultset as $row) : ?>
            <tr>
                <td><?= $row->id ?></td>
                <td><a href="<?=$pageLocation?>?p=<?= $row->path ?>"><?= $row->title ?></a></td>
                <td><?= $row->type ?></td>
                <td><?= $row->status ?></td>
                <td><?= $row->published ?></td>
                <td><?= $row->deleted ?></td>
            </tr>
        <?php endforeach; ?>
        </table>
    </div>
</main>
