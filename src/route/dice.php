<?php
/**
 * Game specific routes for dice100 game.
 */
//var_dump(array_keys(get_defined_vars()));

use \reblex\Session\Session;
use \reblex\DiceGame\Game;

/**
 * Setup a new dice100 game
 */
$app->router->any(["GET", "POST"], "dice/new", function () use ($app) {
    $session = new Session("my_session");
    $session->start();

    // If the form has been posted; remove old, create new and redirect.
    $start = $app->request->getPost("start") == "Starta!" ? true : false;
    if ($start) {
        // Remove dicegame from session if it already exists.
        if ($session->has("dicegame")) {
            $session->delete("dicegame");
        }

        $playerName = $app->request->getPost("playerName") == "" ? "Human" : $app->request->getPost("playerName");
        $dicegame = new Game($app->request->getPost("numDices", 1), $playerName);
        $session->set("dicegame", $dicegame);

        $app->response->redirect($app->url->create("dice"));
    }

    $data = [
        "title" => "Nytt Dice100-spel",
    ];

    $app->view->add("dice/new", $data);
    $app->page->render($data);
});


/**
 * Main view for playing dice100
 */
$app->router->get("dice", function () use ($app) {
    $session = new Session("my_session");
    $session->start();

    // if there is NOT a current dice100 game, redirect to create
    // a new game.
    if (!$session->has("dicegame")) {
        $app->response->redirect($app->url->create("dice/new"));
    }
    $dicegame = $session->get("dicegame");

    // If it's not the humans turn, play all the AIs.. if it's an AI game.
    if ($dicegame->getCurrentPlayerIndex() != 0) {
        $dicegame->playAI();
    }

    $data = [
        "title" => "Dice100",
        "dicegame" => $dicegame
    ];

    $app->view->add("dice/game", $data);
    $app->page->render($data);
});


/**
 * Roll dice
 */
$app->router->get("dice/roll", function () use ($app) {
    $session = new Session("my_session");
    $session->start();

    // if there is NOT a current dice100 game, redirect to create
    // a new game.
    if (!$session->has("dicegame")) {
        $app->response->redirect($app->url->create("dice/new"));
    }

    $dicegame = $session->get("dicegame");
    $dicegame->roll();

    $session->set("dicegame", $dicegame);

    $app->response->redirect($app->url->create("dice"));
});


/**
 * Stop, sum score, and go to next player
 */
$app->router->get("dice/stop", function () use ($app) {
    $session = new Session("my_session");
    $session->start();

    // if there is NOT a current dice100 game, redirect to create
    // a new game.
    if (!$session->has("dicegame")) {
        $app->response->redirect($app->url->create("dice/new"));
    }

    $dicegame = $session->get("dicegame");
    $dicegame->stop();

    $session->set("dicegame", $dicegame);

    $app->response->redirect($app->url->create("dice"));
});
