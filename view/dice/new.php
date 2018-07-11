<?php

namespace Anax\View;

$createUrl = $app->url->create("dice/new");
?>

<h1>Skapa nytt Dice100-spel</h1>


<form class="dice100form" action="<?= $createUrl ?>" method="post">
    <p>
        Mängd spelare
        <input type="number" name="numPlayers" value="2">
    </p>
    <p>
        Ska alla motståndare vara AI?
        <input type="checkbox" name="AI" value="AI" checked="checked">
    </p>
    <p>
        Mängd tärningar/spelare
        <input type="number" name="numDices" value="1">
    </p>

    <input type="submit" name="start" value="Starta!">
</form>
