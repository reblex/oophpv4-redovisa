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
        "title"  => "Movie | View All",
        "res"    => $res,
        "max"    => $max
    ];


    $app->view->add("movie/index", $data);
    $app->page->render($data);
});

/**
 * Edit movie.
 */
$app->router->any(["GET", "POST"], "movie/edit", function () use ($app) {
    $app->db->connect();

    if ($app->request->getGet("movieId") == null) {
        $app->response->redirect($app->url->create("movie"));
    }

    $movieId = $app->request->getPost("movieId") ?: $app->request->getGet("movieId");
    $movieTitle = $app->request->getPost("movieTitle");
    $movieYear = $app->request->getPost("movieYear");
    $movieImage = $app->request->getPost("movieImage");

    if ($app->request->getPost("doSave") !== null) {
        $sql = "UPDATE movie SET title = ?, year = ?, image = ? WHERE id = ?;";
        $app->db->execute($sql, [$movieTitle, $movieYear, $movieImage, $movieId]);
        $app->response->redirect($app->url->create("movie"));
    }

    $sql = "SELECT * FROM movie WHERE id = ?;";
    $movie = $app->db->executeFetchAll($sql, [$movieId]);
    $movie = $movie[0];


    $data = [
        "title"  => "Movie | Edit",
        "movie"    => $movie
    ];


    $app->view->add("movie/edit", $data);
    $app->page->render($data);
});

/**
 * New movie.
 */
$app->router->any(["GET", "POST"], "movie/new", function () use ($app) {
    $app->db->connect();

    if ($app->request->getPost("doSave") !== null) {
        $movieTitle = $app->request->getPost("movieTitle");
        $movieYear = $app->request->getPost("movieYear");
        $movieImage = $app->request->getPost("movieImage");

        if ($movieImage == "") {
            $movieImage = "img/noimage.png";
        }

        $sql = "INSERT INTO movie (title, year, image) VALUES (?, ?, ?);";
        $app->db->execute($sql, [$movieTitle, $movieYear, $movieImage]);
        $app->response->redirect($app->url->create("movie"));
    }

    $data = [
        "title"  => "Movie | New"
    ];


    $app->view->add("movie/new", $data);
    $app->page->render($data);
});

/**
 * Delete movie.
 */
$app->router->get("movie/delete", function () use ($app) {
    $app->db->connect();

    if ($app->request->getGet("movieId") == null) {
        $app->response->redirect($app->url->create("movie"));
    }

    $movieId =  $app->request->getGet("movieId");
    $sql = "DELETE FROM movie WHERE id = ?;";
    $app->db->execute($sql, [$movieId]);

    $app->response->redirect($app->url->create("movie"));
});
