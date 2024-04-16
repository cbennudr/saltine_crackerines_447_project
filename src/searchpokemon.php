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
$type1 = $_POST['primary_type'];
$type2 = $_POST['secondary_type'];
$mysqli->query('DELETE FROM Filtered');
$query = 'INSERT INTO Filtered SELECT DISTINCT LOWER(Name) FROM Pokemon';
$nameq = '';
$ptypeq = '';
$type2q = '';
$_SESSION['form_data'] = $_POST;
$first = 0;
$weaknesses = "";
$wq = '';
$strengths = '';
$sq = '';

if ($pokename != '') {
    $nameq = ' WHERE Name LIKE "%' . $pokename . '%"';
    $first = 1;
} 
if ($type1 != 'primary_type') {
    if ($first == 1) {
        $ptypeq = " AND Type1 = '" . $type1 . "'";
    } else {
        $first = 1;
        $ptypeq = " WHERE Type1 = '" . $type1 . "'";
    }
}
if ($type2 != 'secondary_type') {
    if ($first == 1) {
        $type2q = " AND Type2 = '" . $type2 . "'";
    } else {
        $first = 1;
        $type2q = " WHERE Type2 = '" . $type2 . "'";
    }
}
if (isset($_POST['weakness'])) {
    $weaknesses = $_POST['weakness'];
    // Process the selected weaknesses here
    if ($first == 1) {
        $wq = " AND (";
    } else {
        $wq = " WHERE (";
        $first = 1;
    }

    $count = count($weaknesses);
    $wrapped_weaknesses = array_map(function($weakness) {
        return "'" . $weakness . "'";
    }, $weaknesses);

    $wq .= implode(", ", $wrapped_weaknesses) . ") IN (SELECT Name";
    for ($i = 0; $i < $count-1; $i++) {
        $wq .= ", Name";
    }

    $wq .= " FROM Type_Strength WHERE Strength=Type1 OR Strength=Type2)";
} 
if (isset($_POST['strength'])) {
    $strengths = $_POST['strength'];
    // Process the selected weaknesses here
    if ($first == 1) {
        $sq = " AND (";
    } else {
        $sq = " WHERE (";
        $first = 1;
    }

    $count = count($strengths);
    $wrapped_strengths = array_map(function($strength) {
        return "'" . $strength . "'";
    }, $strengths);

    $sq .= implode(", ", $wrapped_strengths) . ") IN (SELECT Type_Strength.Strength";
    for ($i = 0; $i < $count-1; $i++) {
        $sq .= ", v" . $i . ".Strength";
    }

    $sq .= " FROM Type_Strength";
    for ($i = 0; $i < $count-1; $i++) {
        $sq .= ", Type_Strength v" . $i;
    }
    $sq .= " WHERE Type1=Type_Strength.Name OR Type2=Type_Strength.Name)";
} 

$query .= $nameq . $ptypeq . $type2q . $wq . $sq;
// echo $query;
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
