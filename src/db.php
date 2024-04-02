<?php
// Connect to MySQL server, select database
$conn = mysqli_connect('mysql.eecs.ku.edu', '447s24_b915h027', 'Na9oang9', '447s24_b915h027'); //using my credentials rn... don't know if that's right
// Check connection
if (!$conn) {
    die('Could not connect: ' . mysqli_connect_error());
}
echo 'Connected successfully<br>';

// Send SQL query
$query = 'SELECT * FROM CRUISE'; //need to find a way to connect the sql queries to what the user puts in html
$result = mysqli_query($conn, $query);
if (!$result) {
    die('Query failed: ' . mysqli_error($conn));
}

// Print results in HTML
echo "<table>\n";
while ($line = mysqli_fetch_assoc($result)) {
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
        echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t</tr>\n";
}
echo "</table>\n";

echo "Number of fields: " . mysqli_num_fields($result) . "<br>";
echo "Number of records: " . mysqli_num_rows($result) . "<br>";

// Free resultset
mysqli_free_result($result);

// Close connection
mysqli_close($conn);
?>