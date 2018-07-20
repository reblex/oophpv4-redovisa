<?php
namespace Anax\View;

?>

<h1>Här är lite statisk text.</h1>
<br>
<h2>Här nedanför kommer ett block från databasen. Supernajs.</h2>
<?= $app->ch->getBlock("blocksak")->data ?>
