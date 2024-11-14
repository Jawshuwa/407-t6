
<?php
session_start();

if (!$_SESSION['username']) {
	echo "Only logged in users may acces this page. Click <a href='login_form.php'>here</a> to login <br>";
	exit;
}

include "db_connect.php";

$new_joke_question = addslashes($_GET['newjoke']);
$new_joke_answer = addslashes($_GET['jokeanswer']);
$userid = $_SESSION['userid'];

echo "<h2>Trying to add a new joke " . $new_joke_question . " and " . $new_joke_answer . "</h2>";

$stmt = $mysqli->prepare("INSERT INTO Jokes_table (JokeID, Joke_question, Joke_answer, user_id) VALUES (null, ?, ?, ?)");
$stmt->bind_param("ssi", $new_joke_question, $new_joke_answer, $userid);

$stmt->execute();
$stmt->close();

include "search_all_jokes.php";

echo "<a href = 'index.php'>Return to main</a>";
?>
