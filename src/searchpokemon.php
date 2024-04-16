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
$hp = $_POST['min_hp'];
$attack = $_POST['min_attack'];
$defense = $_POST['min_defense'];
$spa = $_POST['min_sp_attack'];
$speed = $_POST['min_speed'];
$spd = $_POST['min_sp_defense'];

$set = $mysqli->query("SET SQL_BIG_SELECTS=1");

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

    $wq .= implode(", ", $wrapped_weaknesses) . ") IN (SELECT Type_Strength.Name";
    // for ($i = 0; $i < $count-1; $i++) {
    //     $wq .= ", Name";
    // }

    for ($i = 0; $i < $count-1; $i++) {
        $wq .= ", v" . $i . ".Name";
    }

    $wq .= " FROM Type_Strength";
    for ($i = 0; $i < $count-1; $i++) {
        $wq .= ", Type_Strength v" . $i;
        // $wq .= " JOIN Type_Strength v" . $i . " ON Type_Strength.Strength=v" . $i . ".Strength";
    }
    // $sq .= " WHERE Type1=Type_Strength.Name OR Type2=Type_Strength.Name)";

    $wq .= " WHERE Type_Strength.Strength=Type1 OR Type_Strength.Strength=Type2)";

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
        // $sq .= " JOIN Type_Strength v" . $i . " ON Type_Strength.Name=v" . $i . ".Name";
    }
    $sq .= " WHERE Type1=Type_Strength.Name OR Type2=Type_Strength.Name)";

} 

if ($first == 1) {
    $min = " AND ";
} else {
    $min = " WHERE ";
    $first = 1;
}

$min .= "HP > " . $hp . " AND Attack > " . $attack . " AND Defense > " . $defense . " AND Sp_Atk > " . $spa . " AND Sp_Def > " . $spd . " AND Speed > " . $speed;
//attack defense hp sp attack sp defense speed"

$query .= $nameq . $ptypeq . $type2q . $wq . $sq . $min;
// echo $query;
$result = $mysqli->query($query);

if (!$result) {
    die('Query failed: ' . $mysqli->error);
}

header("Location: http://saltine.wuaze.com/team_creator.php");

// Free resultset
$result->free();

// Close connection
$mysqli->close();
?>
