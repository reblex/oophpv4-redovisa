<?php
$route = "";
$resultset = $app->ch->handleRoute($route);
?>

<main>
    <div class="contentBody">
        <a href="<?= $app->url->create('content/blog') ?>">Blogg</a>
        <br>
        <a href="<?= $app->url->create('content/page') ?>">Sidor</a>
        <br>
        <a href="<?= $app->url->create('content/blockTest') ?>">Testsida för block</a>
        <br>
        <?php
            $admin_url = $app->url->create('content/admin');
            echo "<a href=\"$admin_url\">Admin</a>";

        ?>
    </div>
</main>
