<?php
header('Content-Type: application/json');
$conn = pg_connect("host=localhost port=5432 dbname=webformdb user=postgres password=Pass@123");
if (!$conn) {
    echo json_encode([]);
    exit;
}

$result = pg_query($conn, "SELECT name, email, message FROM users ORDER BY name ASC LIMIT 6");
$messages = [];
while ($row = pg_fetch_assoc($result)) {
    $messages[] = $row;
}
echo json_encode($messages);
pg_close($conn);
?>
