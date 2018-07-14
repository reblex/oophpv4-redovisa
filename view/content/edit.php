<?php

namespace Anax\View;

$route = "edit";
$resultset = $app->ch->handleRoute($route);
?>

<main>
    <div class="contentBody">
        <form method="post">
            <fieldset>
            <legend>Edit</legend>
            <input type="hidden" name="contentId" value="<?= esc($resultset->id) ?>"/>

            <p>
                <label>Title:<br>
                <input type="text" name="contentTitle" value="<?= esc($resultset->title) ?>"/>
                </label>
            </p>

            <p>
                <label>Path:<br>
                <input type="text" name="contentPath" value="<?= esc($resultset->path) ?>"/>
            </p>

            <p>
                <label>Slug:<br>
                <input type="text" name="contentSlug" value="<?= esc($resultset->slug) ?>"/>
            </p>

            <p>
                <label>Text:<br>
                <textarea name="contentData"><?= esc($resultset->data) ?></textarea>
             </p>

             <p>
                 <label>Type:<br>
                 <input type="text" name="contentType" value="<?= esc($resultset->type) ?>"/>
             </p>

             <p>
                 <label>Filter:<br>
                 <input type="text" name="contentFilter" value="<?= esc($resultset->filter) ?>"/>
             </p>

             <p>
                 <label>Publish:<br>
                 <input type="datetime-local" name="contentPublish" value="<?= esc(str_replace(' ', 'T', $resultset->published)) ?>"/>
             </p>

            <p>
                <button type="submit" name="doSave"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                <button type="reset"><i class="fa fa-undo" aria-hidden="true"></i> Reset</button>
                <button type="submit" name="doDelete"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
            </p>
            </fieldset>
        </form>

    </div>
</main>
