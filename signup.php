<?php
$conn = pg_connect("host=localhost port=5432 dbname=webformdb user=postgres password=Pass@123");

if (!$conn) {
    die("❌ Database connection failed");
}

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

$query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
$result = pg_query($conn, $query);

if ($result) {
    echo "<h2>✅ Signup Successful! Redirecting to login...</h2>";
    header("refresh:2; url=index.html");
} else {
    echo "<h3>❌ Error during signup. Please try again.</h3>";
}

pg_close($conn);
?>
