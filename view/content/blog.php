<?php

namespace Anax\View;

$route = "blog";
$resultset = $app->ch->handleRoute($route);
?>

<main>
    <div class="contentBody">
        <article>
        <!-- If a blog is selected -->
        <?php if (!is_array($resultset)) : ?>
        <header>
            <h1><?= esc($resultset->title) ?></h1>
            <p><i>Published: <time datetime="<?= esc($resultset->published_iso8601) ?>" pubdate><?= esc($resultset->published) ?></time></i></p>
        </header>

        <?= $app->tf->parse(esc($resultset->data), $resultset->filter) ?>
        <?php endif; ?>

        <!-- If no blog is selected -->
        <?php if (is_array($resultset)) : ?>
        <h1>Publicerade blogginlägg</h1>
        <?php foreach ($resultset as $row) : ?>
        <section>
            <header>
                <h1><a href="?p=<?= esc($row->slug) ?>"><?= esc($row->title) ?></a></h1>
                <p><i>Published: <time datetime="<?= esc($row->published_iso8601) ?>" pubdate><?= esc($row->published) ?></time></i></p>
            </header>
            <?= $app->tf->parse(esc($row->data), $row->filter) ?>
        </section>
        <?php endforeach; ?>
        <?php endif;?>

        </article>
    </div>
</main>
