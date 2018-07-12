<?php

namespace Anax\View;

$createUrl = $app->url->create("dice/new");
?>

<h1>Skapa nytt Dice100-spel</h1>


<form class="dice100form" action="<?= $createUrl ?>" method="post">
    <p>
        Player name
        <input type="text" name="playerName" placeholder="Human">
    </p>
    <p>
        Number of Dices/Player
        <input type="number" name="numDices" value="1">
    </p>

    <input type="submit" name="start" value="Starta!">
</form>
