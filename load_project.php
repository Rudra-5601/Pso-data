<?php
include 'db_connect.php';

$id = $_GET['id'];
$query = "SELECT * FROM project_master WHERE id=$1";
$res = pg_query_params($conn, $query, [$id]);
$row = pg_fetch_assoc($res);

echo json_encode($row);

pg_close($conn);
?>
