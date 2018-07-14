<?php

namespace Anax\View;

$route = "page";
$resultset = $app->ch->handleRoute($route);
if (is_array($resultset)) {
    $location = $app->url->create("content/pages");
    $p = $app->request->getGet("p");
    header("Location: $location");
    die();
}
?>

<main>
    <div class="contentBody">
        <article>
            <header>
                <?= $app->tf->parse(esc($resultset->title), $resultset->filter) ?>
            </header>
            <?= $app->tf->parse(esc($resultset->data), $resultset->filter) ?>
        </article>
    </div>
</main>
