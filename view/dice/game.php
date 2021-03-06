<?php

namespace Anax\View;

$game = $data["dicegame"];

$rollUrl = $app->url->create("dice/roll");
$stopUrl = $app->url->create("dice/stop");
$restartUrl = $app->url->create("dice/new");
$currentPlayerName = $game->getPlayerName();
$playerHistogram = $game->getHistogram(0);
$aiHistogram = $game->getHistogram(1);
$disabled = $game->getGameOver() ? "disabled" : "";
$playerName = $game->getPlayerName(0);
$aiName = $game->getPlayerName(1);
?>

<div class="dicegame">
    <div class="dicegameStatus">
        <h2>Current Game Status</h2>
        <b>Current Player: <?= $currentPlayerName ?></b>
        <br><br>
        <div class="status">
            <u>Score</u>
            <br>
            <i>
                <?= $game->getScore() ?>
            </i>
            <br>
            <?= $game->getStatus() ?>
        </div>
    </div>
    <div class="dicegameHistory">
        <h2>Game History (Latest at the top)</h2>
        <div class="history">
            <?php foreach ($game->getHistory() as $event) : ?>
                <?= $event ?>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="dicegameOptions">
        <a href="<?= $rollUrl ?>" class="diceButtonLink">
            <button type="button" class="diceButton" <?= $disabled ?>>Roll</button>
        </a>
        <a href="<?= $stopUrl ?>" class="diceButtonLink">
            <button type="button" class="diceButton" <?= $disabled ?>>Stop</button>
        </a>
        <a href="<?= $restartUrl ?>" class="diceButtonLink">
            <button type="button" class="diceButton diceButtonRestart">New Game</button>
        </a>
    </div>
    <div class="dicegameHistograms">
        <h2>Histograms</h2>
        <div class="histogram">
            <h3><?= $playerName ?></h3>
            <?= $playerHistogram ?>
        </div>
        <div class="histogram">
            <h3><?= $aiName ?></h3>
            <?= $aiHistogram ?>
        </div>
    </div>
</div>
