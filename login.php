<?php
$conn = pg_connect("host=localhost port=5432 dbname=webformdb user=postgres password=Pass@123");

if (!$conn) {
    die("❌ Database connection failed");
}

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = pg_query($conn, $query);

if (pg_num_rows($result) > 0) {
    echo "<h2>✅ Login Successful! Redirecting...</h2>";
    header("refresh:2; url=home.html");
} else {
    echo "<h3>❌ Invalid username or password</h3>";
    echo "<a href='index.html'>Try Again</a>";
}

pg_close($conn);
?>
