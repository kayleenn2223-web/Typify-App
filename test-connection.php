<?php
set_time_limit(5);
echo "Attempting to connect to MySQL...\n";
$start = time();

$conn = @mysqli_connect('127.0.0.1', 'root', '', '', 3306);
$elapsed = time() - $start;

if ($conn) {
    echo "✅ MySQL connected successfully in {$elapsed} seconds!";
    $result = mysqli_query($conn, "SHOW DATABASES");
    if ($result) {
        echo "\nDatabases: ";
        while ($row = mysqli_fetch_row($result)) {
            echo $row[0] . " ";
        }
    }
} else {
    echo "❌ MySQL NOT connected after {$elapsed} seconds\n";
    echo "Error: " . mysqli_connect_error();
}
?>
