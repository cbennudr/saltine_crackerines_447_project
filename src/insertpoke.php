<?php
session_start();
// Connect to MySQL server, select database
$mysqli = new mysqli('sql211.infinityfree.com', 'if0_36325610', 'Crackerines', 'if0_36325610_pokemon');

// Check connection
if ($mysqli->connect_error) {
    die('Could not connect: ' . $mysqli->connect_error);
}

// Send SQL query

$idquery = $mysqli->query("SELECT ID FROM Pokemon WHERE Name='" . $_GET['id'] . "'");
// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
//     // You can access the 'id' parameter sent from JavaScript here
//     $id = $_POST['id'];
// }
$row = mysqli_fetch_assoc($idquery);

$result = $mysqli->query("INSERT INTO Pokemon_In_Team VALUES ('" . $_SESSION['user'] . "', " . $row['ID'] . ")");

if (!$result) {
    die('Query failed: ' . $mysqli->error);
}

header("Location: http://saltine.wuaze.com/team_creator.php");

// Free resultset
$result->free();

// Close connection
$mysqli->close();
?>
