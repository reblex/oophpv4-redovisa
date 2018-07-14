<?php

namespace Anax\View;

/**
 * Template file to render a view.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>

<navbar class="navbar">
    <a href="<?= url("") ?>">Hem</a> |
    <a href="<?= url("redovisning") ?>">Redovisning</a> |
    <a href="<?= url("om") ?>">Om</a> |
    <a href="<?= url("gissa") ?>">Gissa</a> |
    <a href="<?= url("dice") ?>">Dice100</a> |
    <a href="<?= url("movie") ?>">Movie</a> |
    <a href="<?= url("test") ?>">Test</a> |
    <a href="<?= url("content") ?>">Content</a>
</navbar>
