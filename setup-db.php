<?php
$host = 'localhost';   // atau '127.0.0.1'
$user = 'root';
$pass = '';            // kosong untuk XAMPP default
$db   = 'Typify-App-ellen'; // ganti dengan nama database Typify

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Read SQL file
$sql_file = file_get_contents(__DIR__ . '/database/typify.sql');

// Split queries
$queries = array_filter(
    array_map(
        'trim',
        preg_split('/;[\s\n]+/', $sql_file)
    )
);

// Execute queries
$executed = 0;
$skipped = 0;

foreach ($queries as $query) {
    if (empty($query)) continue;
    
    // Handle CREATE DATABASE specially
    if (stripos($query, 'CREATE DATABASE') !== false) {
        try {
            @mysqli_query($conn, $query);
            $executed++;
            echo "✅ Database created<br>";
        } catch (Exception $e) {
            $skipped++;
            echo "⚠️ Database already exists (skipped)<br>";
        }
        // Always select the database
        @mysqli_select_db($conn, 'typify');
        continue;
    }
    
    // Handle USE database
    if (stripos($query, 'USE typify') !== false) {
        @mysqli_select_db($conn, 'typify');
        $skipped++;
        continue;
    }
    
    try {
        if (@mysqli_query($conn, $query)) {
            $executed++;
            echo "✅ Query executed<br>";
        } else {
            echo "❌ Error: " . mysqli_error($conn) . "<br>";
        }
    } catch (Exception $e) {
        echo "❌ Error: " . $e->getMessage() . "<br>";
    }
}

mysqli_close($conn);
echo "<hr>";
echo "<strong style='color: green;'>✅ Database setup complete!</strong><br>";
echo "Executed: $executed queries<br>";
echo "Skipped: $skipped queries<br>";
echo "<br><a href='http://localhost/Typify-App-ellen/pages/auth/register.php' style='padding: 10px 20px; background: #243b6b; color: white; text-decoration: none; border-radius: 8px; display: inline-block;'>Go to Register →</a>";
?>
