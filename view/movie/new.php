<?php

namespace Anax\View;

?>

<div class="movieWrap">
    <form method="post">
        <fieldset>
        <legend>Edit</legend>

        <p>
            <label>Title:<br>
            <input type="text" name="movieTitle"/>
            </label>
        </p>

        <p>
            <label>Year:<br>
            <input type="number" name="movieYear"/>
        </p>

        <p>
            <label>Image:<br>
            <input type="text" name="movieImage"/>
            </label>
        </p>

        <p>
            <input type="submit" name="doSave" value="Save">
        </p>
        <p>
            <a href='<?= $app->url->create("movie") ?>'>Show all</a>
        </p>
        </fieldset>
    </form>
</div>
