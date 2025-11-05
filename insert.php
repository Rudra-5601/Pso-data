<?php
// Database connection
$conn = pg_connect("host=localhost port=5432 dbname=webformdb user=postgres password=Pass@123");

// Check connection
if (!$conn) {
    die("❌ Database connection failed");
}

// Get form data safely
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Insert query
$query = "INSERT INTO users (name, email, message) VALUES ('$name', '$email', '$message')";
$result = pg_query($conn, $query);

if ($result) {
    // Redirect to home.html after successful login
    header("Location: home.html");
    exit();
} else {
    echo "<h3>❌ Error inserting data.</h3>";
}

// Close connection
pg_close($conn);
?>
