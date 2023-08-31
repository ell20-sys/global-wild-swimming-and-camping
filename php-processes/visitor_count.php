<?php
// Connect to server and select database.
$con = mysqli_connect("localhost", "root", "", "gwsc_db") or die(mysqli_error($con));

// Select values from visitor_counter table
$sql = "SELECT * FROM visitor_counter";
$result = mysqli_query($con, $sql);

// Check if the query returned any rows
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);
    $counter = $row['counts'];
} else {
    // If no rows found, initialize counter to 1 and insert the value into the table
    $counter = 1;
    $sql1 = "INSERT INTO visitor_counter (counts) VALUES ('$counter')";
    $result1 = mysqli_query($con, $sql1);
}

// Incrementing counts value
$plus_counter = $counter + 1;
$sql2 = "UPDATE visitor_counter SET counts = '$plus_counter'";
$result2 = mysqli_query($con, $sql2);

mysqli_close($con);
?>