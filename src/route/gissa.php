<?php
/**
 * Game specific routes.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Guess my number with GET
 */
$app->router->get("gissa/get", function () use ($app) {

    $number = isset($_GET["number"]) ? $_GET["number"] : null;
    $guessesLeft = isset($_GET["guessesLeft"]) ? $_GET["guessesLeft"] : null;

    $guessObj = new \reblex\Guess\Guess($number, $guessesLeft);

    $number = $guessObj->getNumber();
    $guessesLeft = $guessObj->getGuessesLeft();

    $guessRes = null;

    if (isset($_GET["guess"])) {
        $guessRes = $guessObj->makeGuess($_GET["guess"]);
        $guessesLeft = $guessObj->getGuessesLeft();
    }

    $data = [
        "title" => "Gissa med GET",
        "guessRes" => $guessRes,
        "guessesLeft" => $guessesLeft,
        "number" => $number,
    ];

    $app->view->add("guess/get", $data);
    $app->page->render($data);
});

/*
 * Guess my number with POST
 */
$app->router->any(["GET", "POST"], "gissa/post", function () use ($app) {
    $number = isset($_POST["number"]) ? $_POST["number"] : null;
    $guessesLeft = isset($_POST["guessesLeft"]) ? $_POST["guessesLeft"] : null;

    $guessObj = new reblex\Guess\Guess($number, $guessesLeft);

    $number = $guessObj->getNumber();
    $guessesLeft = $guessObj->getGuessesLeft();

    $guessRes = null;
    $cheat = "";
    if (isset($_POST["Cheat"])) {
        $cheat = "Correct Number: $number";
    }

    if (isset($_POST["guess"])) {
        if ($_POST["guess"] != "") {
            $guessRes = $guessObj->makeGuess($_POST["guess"]);
            $guessesLeft = $guessObj->getGuessesLeft();
        }
    }

    $data = [
        "title" => "Gissa med POST",
        "guessRes" => $guessRes,
        "guessesLeft" => $guessesLeft,
        "number" => $number,
        "cheat" => $cheat,
    ];

    $app->view->add("guess/post", $data);
    $app->page->render($data);
});

/*
 * Guess my number with SESSION
 */
$app->router->any(["GET", "POST"], "gissa/session", function () use ($app) {
    $session = new reblex\Session\Session("index_session");
    $session->start();

    if (isset($_GET["reset"])) {
        session_unset();
        header("Location: session");
        exit;
    }

    if ($session->has("object")) {
        $guessObj = $session->get("object");
    } else {
        $guessObj = new reblex\Guess\Guess(null, null);
    }

    $number = $guessObj->getNumber();
    $guess = isset($_POST["guess"]) ? $_POST["guess"] : null;
    $guessesLeft = $guessObj->getGuessesLeft();

    if (isset($_POST["Cheat"])) {
        $session->set("Cheat", "true");
    }

    $cheat = "";
    if ($session->has("Cheat")) {
        $cheat = "Correct Number: $number";
    }

    $guessRes = null;
    if (array_key_exists("guessMade", $_SESSION)) {
        if ($session->getOnce("guessMade") == true) {
            $guessRes = $guessObj->makeGuess($guessObj->getGuess());
        }
    }

    $guessesLeft = $guessObj->getGuessesLeft();

    $data = [
        "title" => "Gissa med POST",
        "guessRes" => $guessRes,
        "guessesLeft" => $guessesLeft,
        "cheat" => $cheat,
        "guess" => $guess,
        "session" => $session,
        "guessObj" => $guessObj,

    ];

    $app->view->add("guess/session", $data);
    $app->page->render($data);
});
