<?php
// Connection 
include 'db.php';
$title = "ISTE";
$filename = $title . ".xls"; // File Name
// Download file
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");

$query = "SELECT email,password, score FROM users ORDER BY score DESC";
$user_query = mysqli_query($conn, $query);
// Write data to file
$flag = false;
while ($row = mysqli_fetch_assoc($user_query)) {
    if (!$flag) {
        // display field/column names as first row
        echo implode("\t", array_keys($row)) . "\r\n";
        $flag = true;
    }
    echo implode("\t", array_values($row)) . "\r\n";
}
?>