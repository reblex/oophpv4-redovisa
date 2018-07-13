<?php
/**
 * Testing routes
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Test textfilter
 */
$app->router->get("test", function () use ($app) {

    $data = [
        "title" => "Test index",
    ];

    $app->view->add("test/index", $data);
    $app->page->render($data);
});


/**
 * Test textfilter
 */
$app->router->get("test/textfilter", function () use ($app) {

    $data = [
        "title" => "Textfilter test",
    ];

    $app->view->add("test/textfilter", $data);
    $app->page->render($data);
});
