<?php

namespace Anax\View;

?>

<h1>Guess my number (GET)</h1>

<?php
if (!is_null($guessRes)) {
    echo "Your guess " . $_GET["guess"] . " is " . $guessRes;
}

$cheatUrl = $_SERVER['REQUEST_URI'];
$cheatUrl .= (strpos($_SERVER['REQUEST_URI'], '?') !== false) ? "&cheat=true" : "?cheat=true";


$cheat = isset($_GET["cheat"]) ? "Correct Number: $number" : "";
?>



<?php
if ($guessRes != "<b>correct!</b>" && $guessesLeft > 0) {
    echo "<p>Guess a number between 1 and 100, you have $guessesLeft tries left.<br>$cheat </p>
    <form class='guessForm' method='get'>
        <input type='hidden' name='number' value='$number'>
        <input type='hidden' name='guessesLeft' value='$guessesLeft'>
        <input type='number' name='guess'>
        <input type='submit' value='Guess'>
    </form>";
} elseif ($guessesLeft == 0 && $guessRes != "<b>correct!</b>") {
    echo "<p>You ran out of tries. The correct number was $number.";
}
?>


<a href="get"><p>Reset the game</p></a>
<button type="button" onclick="location.href = '<?= $cheatUrl ?>'">Cheat</button>
