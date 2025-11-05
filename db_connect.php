<?php
$conn = pg_connect("host=localhost port=5432 dbname=webformdb user=postgres password=Pass@123");

if (!$conn) {
    die("❌ Database connection failed: " . pg_last_error());
}
?>
