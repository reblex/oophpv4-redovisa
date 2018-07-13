<?php
/**
 * Game specific routes.
 */
//var_dump(array_keys(get_defined_vars()));


/**
 * Show all movies.
 */
$app->router->get("movie", function () use ($app) {
    $app->db->connect();

    // Get number of hits per page
    $hits = $app->request->getGet("hits", 4);
    if (!(is_numeric($hits) && $hits > 0 && $hits <= 8)) {
        die("Not valid for hits.");
    }

    // Get max number of pages
    $sql = "SELECT COUNT(id) AS max FROM movie;";
    $max = $app->db->executeFetchAll($sql);
    $max = ceil($max[0]->max / $hits);

    // Get current page
    $page = $app->request->getGet("page", 1);
    if (!(is_numeric($hits) && $page > 0 && $page <= $max)) {
        die("Not valid for page.");
    }
    $offset = $hits * ($page - 1);

    // Only these values are valid
    $columns = ["id", "title", "year", "image"];
    $orders = ["asc", "desc"];

    // Get settings from GET or use defaults
    $orderBy = $app->request->getGet("orderby") ?: "id";
    $order = $app->request->getGet("order") ?: "asc";

    // Incoming matches valid value sets
    if (!(in_array($orderBy, $columns) && in_array($order, $orders))) {
        die("Not valid input for sorting.");
    }

    $sql = "SELECT * FROM movie ORDER BY $orderBy $order LIMIT $hits OFFSET $offset;";
    $res = $app->db->executeFetchAll($sql);


    $data = [
        "title"  => "Movie database | oophp",
        "res"    => $res,
        "max"    => $max
    ];


    $app->view->add("movie/index", $data);
    $app->page->render($data);
});
