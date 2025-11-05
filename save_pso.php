<?php
$conn = pg_connect("host=localhost port=5432 dbname=webformdb user=postgres password=Pass@123");

if (!$conn) {
    die("Database connection failed");
}

$customer_name = $_POST['customer_name'];
$project_name = $_POST['project_name'];
$city = $_POST['city'];
$region = $_POST['region'];

// Check if project already exists
$check_query = "SELECT id FROM project_master WHERE customer_name=$1 AND project_name=$2 AND city=$3 AND region=$4";
$result = pg_query_params($conn, $check_query, [$customer_name, $project_name, $city, $region]);

if (pg_num_rows($result) > 0) {
    $row = pg_fetch_assoc($result);
    $project_id = $row['id'];
} else {
    $insert_project = "INSERT INTO project_master (customer_name, project_name, city, region)
                       VALUES ($1, $2, $3, $4) RETURNING id";
    $res = pg_query_params($conn, $insert_project, [$customer_name, $project_name, $city, $region]);
    $row = pg_fetch_assoc($res);
    $project_id = $row['id'];
}

// Insert new PSO entry
$insert_pso = "INSERT INTO pso_data (project_id, received_date, send_date, enquiry_no, product_line, category, modules_no, pallet_no, drawn_by, sales_person, revision_no, remarks)
               VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12)";

pg_query_params($conn, $insert_pso, [
    $project_id,
    $_POST['received_date'],
    $_POST['send_date'],
    $_POST['enquiry_no'],
    $_POST['product_line'],
    $_POST['category'],
    $_POST['modules_no'],
    $_POST['pallet_no'],
    $_POST['drawn_by'],
    $_POST['sales_person'],
    $_POST['revision_no'],
    $_POST['remarks']
]);

echo "<h2>✅ PSO Data Submitted Successfully!</h2>";
echo "<a href='new_form.html'>Add Another Entry</a>";

pg_close($conn);
?>
