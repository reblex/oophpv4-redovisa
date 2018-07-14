<?php

$app->router->get("content", function () use ($app) {
    $session = new \reblex\Session\Session("my_session");
    $session->start();

    $data = [
        "title" => "Content",
        "session" => $session

    ];

    $app->view->add("content/content", $data);
    $app->page->render($data);
});

$app->router->get("content/blog", function () use ($app) {
    $session = new \reblex\Session\Session("my_session");
    $session->start();

    $data = [
        "title" => "Content",
        "session" => $session

    ];

    $app->view->add("content/blog", $data);
    $app->page->render($data);
});

$app->router->get("content/blockTest", function () use ($app) {
    $session = new \reblex\Session\Session("my_session");
    $session->start();

    $data = [
        "title" => "Content",
        "session" => $session

    ];

    $app->view->add("content/blockTest", $data);
    $app->page->render($data);
});

$app->router->get("content/page", function () use ($app) {
    $session = new \reblex\Session\Session("my_session");
    $session->start();

    $data = [
        "title" => "Content",
        "session" => $session

    ];

    $app->view->add("content/page", $data);
    $app->page->render($data);
});

$app->router->get("content/pages", function () use ($app) {
    $session = new \reblex\Session\Session("my_session");
    $session->start();

    $data = [
        "title" => "Content",
        "session" => $session

    ];

    $app->view->add("content/pages", $data);
    $app->page->render($data);
});

$app->router->any(["GET", "POST"], "content/create", function () use ($app) {
    $session = new \reblex\Session\Session("my_session");
    $session->start();

    $data = [
        "title" => "Content",
        "session" => $session

    ];

    $app->view->add("content/create", $data);
    $app->page->render($data);
});

$app->router->get("content/admin", function () use ($app) {
    $session = new \reblex\Session\Session("my_session");
    $session->start();

    $data = [
        "title" => "Content",
        "session" => $session

    ];

    $app->view->add("content/admin", $data);
    $app->page->render($data);
});

$app->router->any(["GET", "POST"], "content/edit", function () use ($app) {
    $session = new \reblex\Session\Session("my_session");
    $session->start();

    $data = [
        "title" => "Content",
        "session" => $session

    ];

    $app->view->add("content/edit", $data);
    $app->page->render($data);
});

$app->router->get("content/delete", function () use ($app) {
    $session = new \reblex\Session\Session("my_session");
    $session->start();

    $data = [
        "title" => "Content",
        "session" => $session

    ];

    $app->view->add("content/delete", $data);
    $app->page->render($data);
});
