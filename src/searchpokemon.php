<?php
session_start();
// Connect to MySQL server, select database
$mysqli = new mysqli('sql211.infinityfree.com', 'if0_36325610', 'Crackerines', 'if0_36325610_pokemon');

// Check connection
if ($mysqli->connect_error) {
    die('Could not connect: ' . $mysqli->connect_error);
}

// Send SQL query
$pokename = $_POST['pokename'];
$mysqli->query('DELETE FROM Filtered');
$query = 'INSERT INTO Filtered SELECT DISTINCT LOWER(Name) FROM Pokemon WHERE Name LIKE "%' . $pokename . '%"';
$result = $mysqli->query($query);

if (!$result) {
    die('Query failed: ' . $mysqli->error);
}

header("Location: http://saltine.wuaze.com/team_creator.php");

// Array to store Pokémon names
// $pokemonNames = [];
// while ($row = $result->fetch_assoc()) {
//     // Push Pokémon names into the array
//     $pokemonNames[] = strtolower($row['Name']);
// }

// Store the Pokémon names in the session variable
// $_SESSION["filtered"] = $pokemonNames;

// Free resultset
$result->free();

// Close connection
$mysqli->close();



// // Print results in HTML
// echo "<table>\n";
// $table = "<table>";
// while ($line = $result->fetch_assoc()) {
//     echo "\t<tr>\n";
//     foreach ($line as $col_value) {
//         echo "\t\t<td>$col_value</td>\n";
//         $table .= "<tr>
//                   <td>{$col_value}</td>
//                </tr>";
//     }
//     echo "\t</tr>\n";
// }
// echo "</table>\n";
// $table .= "</table>";

// $_SESSION["table"] = $table;

// echo "Number of fields: " . $result->field_count . "<br>";
// echo "Number of records: " . $result->num_rows . "<br>";

// // Free resultset
// $result->free();

// // Close connection
// $mysqli->close();
?>
