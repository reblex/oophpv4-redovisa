<?php

namespace reblex\ContentHandler;

class ContentHandler
{
    public function __construct($app)
    {
        $this->app = $app;
        $this->db = $app->db;
        $this->db->connect();
    }



    public function getBlock($blockSlug)
    {
        $sql = "SELECT * FROM content WHERE type=? AND slug=?;";
        $resultset = $this->db->executeFetch($sql, ["block", $blockSlug]);
        return $resultset;
    }

    public function getDatSlug($slug)
    {
        $slugOkay = false;
        $num = 1;
        while ($slugOkay == false) {
            if ($this->db->executeFetch("SELECT * FROM content WHERE slug = ?", [$slug]) !== false) {
                $slug = "$slug$num";
            } else {
                $slugOkay = true;
            }
            $num++;
        }
    }

    public function delete()
    {
        $contentId = $this->app->request->getPost("contentId") ?: $this->app->request->getGet("id");
        if (is_numeric($contentId)) {
            $sql = "UPDATE content SET deleted=NOW() WHERE id=?;";
            $this->db->execute($sql, [$contentId]);
            $this->app->response->redirect($this->app->url->create("content/admin"));
        }
    }

    public function handlePage()
    {
        $resultset = null;
        if ($this->app->request->getGet("p")) {
            $sql = <<<EOD
SELECT
*,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS modified_iso8601,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS modified
FROM content
WHERE
path = ?
AND type = ?
AND (deleted IS NULL OR deleted > NOW())
AND published <= NOW()
;
EOD;
            $resultset = $this->db->executeFetch($sql, [$this->app->request->getGet("p"), "page"]);
        } else {
            $sql = <<<EOD
SELECT
*,
CASE
WHEN (deleted <= NOW()) THEN "isDeleted"
WHEN (published <= NOW()) THEN "isPublished"
ELSE "notPublished"
END AS status
FROM content
WHERE
type=?
AND (deleted IS NULL OR deleted > NOW())
AND published <= NOW()
;
EOD;
            $resultset = $this->db->executeFetchAll($sql, ["page"]);
        }
        return $resultset;
    }

    public function getBlog()
    {
        if ($this->app->request->getGet("p")) {
            $sql = <<<EOD
SELECT
*,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
FROM content
WHERE
slug = ?
AND type = ?
AND (deleted IS NULL OR deleted > NOW())
AND published <= NOW()
ORDER BY published DESC
;
EOD;
            $slug = $this->app->request->getGet("p");
            $resultset = $this->db->executeFetch($sql, [$slug, "post"]);
        } else {
            $sql = <<<EOD
SELECT
*,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
FROM content
WHERE
type=?
AND (deleted IS NULL OR deleted > NOW())
AND published <= NOW()
ORDER BY published DESC
;
EOD;
            $resultset = $this->db->executeFetchAll($sql, ["post"]);
        }
        return $resultset;
    }

    public function doSave()
    {
        $contentId = $this->app->request->getPost("contentId") ?: $this->app->request->getGet("id");
        $params = getPost([
            "contentTitle",
            "contentPath",
            "contentSlug",
            "contentData",
            "contentType",
            "contentFilter",
            "contentPublish",
            "contentId"
        ]);

        if ($params["contentPublish"] == "") {
            $params["contentPublish"] = null;
        }

        if (!$params["contentSlug"]) {
            $slug = slugify($params["contentTitle"]);
            $params["contentSlug"] = $this->getDatSlug($slug);
        }

        if (!$params["contentPath"]) {
            $params["contentPath"] = null;
        }

        $sql = "UPDATE content SET title=?, path=?, slug=?, data=?, type=?, filter=?, published=?, updated=NOW() WHERE id = ?;";
        $this->db->execute($sql, array_values($params));
        $this->app->response->redirect($this->app->url->create("content/edit?id=$contentId"));
    }

    public function doEdit()
    {
        $contentId = $this->app->request->getPost("contentId") ?: $this->app->request->getGet("id");
        if (!is_numeric($contentId)) {
            echo("Not valid for content id.");
        } elseif ($this->app->request->getPost("doDelete", "notSet") != "notSet") {
            $this->app->response->redirect($this->app->url->create("content/delete?id=$contentId"));
        } elseif ($this->app->request->getPost("doSave", "notset") != "notset") {
            $this->doSave();
        }

        $sql = "SELECT * FROM content WHERE id = ?;";
        return $this->db->executeFetch($sql, [$contentId]);
    }

    public function doCreate()
    {
        if (getPost("doCreate", "notSet") != "notSet") {
            $title = $this->app->request->getPost("contentTitle");

            $sql = "INSERT INTO content (title) VALUES (?);";
            $this->db->execute($sql, [$title]);
            $id = $this->db->lastInsertId();
            $this->app->response->redirect($this->app->url->create("content/edit?id=$id"));
        }
    }

    public function handleRoute($route)
    {
        $resultset = null;

        switch ($route) {
            case "":
                $sql = "SELECT * FROM content;";
                $resultset = $this->db->executeFetchAll($sql);
                break;

            case "reset":
                // $view[] = "view/reset.php";
                break;

            case "admin":
                $sql = "SELECT * FROM content;";
                $resultset = $this->db->executeFetchAll($sql);
                break;

            case "edit":
                $resultset = $this->doEdit();
                break;

            case "create":
                $this->doCreate();
                break;

            case "delete":
                $this->delete();
                break;


            case "page":
                $resultset = $this->handlePage();
                break;

            case "blog":
                $resultset = $this->getBlog();
                break;
        };

        return $resultset;
    }
}
