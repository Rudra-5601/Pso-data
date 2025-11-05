<?php
header('Content-Type: application/json');
$conn = pg_connect("host=localhost port=5432 dbname=webformdb user=postgres password=Pass@123");
if (!$conn) {
    echo json_encode(["error" => "Database connection failed"]);
    exit;
}

$total_users = pg_fetch_result(pg_query($conn, "SELECT COUNT(*) FROM users"), 0, 0);
$total_messages = pg_fetch_result(pg_query($conn, "SELECT COUNT(message) FROM users"), 0, 0);
$active_projects = 8;

$months = ["Jan","Feb","Mar","Apr","May","Jun"];
$monthly_users = [12,19,8,15,10,20];
$admins = 5; $clients = 25; $guests = 10;

echo json_encode([
  "total_users"=>$total_users,
  "total_messages"=>$total_messages,
  "active_projects"=>$active_projects,
  "months"=>$months,
  "monthly_users"=>$monthly_users,
  "admins"=>$admins,
  "clients"=>$clients,
  "guests"=>$guests
]);
pg_close($conn);
?>
