<?php

namespace Anax\View;

?>

<h1>Guess my number (POST)</h1>

<?php
if (!is_null($guessRes)) {
    echo "Your guess " . $_POST["guess"] . " is " . $guessRes;
}

if ($guessRes != "<b>correct!</b>" && $guessesLeft > 0) {
    echo "<p>Guess a number between 1 and 100, you have $guessesLeft tries left.<br>$cheat </p>
    <form class='guessForm' method='post'>
        <input type='hidden' name='number' value='$number'>
        <input type='hidden' name='guessesLeft' value='$guessesLeft'>
        <input type='number' name='guess'>
        <input type='submit' value='Guess'>
        <input type='submit' name='Cheat' value='Cheat'>
    </form>";
} elseif ($guessesLeft == 0 && $guessRes != "<b>correct!</b>") {
    echo "<p>You ran out of tries. The correct number was $number.";
}
?>

<button type="button" onclick="location.href = 'post'">Randomize</button>
