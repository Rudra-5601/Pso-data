<?php
include 'db_connect.php';

// If ID not provided, redirect
if (!isset($_GET['id'])) {
    header("Location: view_data.php");
    exit;
}

$id = $_GET['id'];

// Fetch existing record
$query = "SELECT * FROM pso_data WHERE id = $1";
$result = pg_query_params($conn, $query, [$id]);
$data = pg_fetch_assoc($result);

if (!$data) {
    echo "<h3>❌ Record not found!</h3>";
    exit;
}

// Handle update request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $received_date = $_POST['received_date'];
    $send_date = $_POST['send_date'];
    $enquiry_no = $_POST['enquiry_no'];
    $product_line = $_POST['product_line'];
    $category = $_POST['category'];
    $modules_no = $_POST['modules_no'];
    $pallet_no = $_POST['pallet_no'];
    $drawn_by = $_POST['drawn_by'];
    $sales_person = $_POST['sales_person'];
    $revision_no = $_POST['revision_no'];
    $remarks = $_POST['remarks'];

    $update_query = "
        UPDATE pso_data SET
            received_date = $1,
            send_date = $2,
            enquiry_no = $3,
            product_line = $4,
            category = $5,
            modules_no = $6,
            pallet_no = $7,
            drawn_by = $8,
            sales_person = $9,
            revision_no = $10,
            remarks = $11
        WHERE id = $12
    ";

    $res = pg_query_params($conn, $update_query, [
        $received_date, $send_date, $enquiry_no, $product_line, $category,
        $modules_no, $pallet_no, $drawn_by, $sales_person, $revision_no, $remarks, $id
    ]);

    if ($res) {
        echo "<script>alert('✅ Record updated successfully!'); window.location.href='view_data.php';</script>";
    } else {
        echo "<script>alert('❌ Failed to update record.');</script>";
    }
}
pg_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit PSO Data</title>
  <link rel="stylesheet" href="edit_pso.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
  <div class="container">
    <form method="POST" class="edit-form">
      <h1>✏️ Edit PSO Data</h1>

      <div class="form-grid">
        <div class="form-group">
          <label>Received Date</label>
          <input type="date" name="received_date" value="<?= $data['received_date'] ?>" required>
        </div>

        <div class="form-group">
          <label>Send Date</label>
          <input type="date" name="send_date" value="<?= $data['send_date'] ?>">
        </div>

        <div class="form-group">
          <label>Enquiry Number</label>
          <input type="text" name="enquiry_no" value="<?= htmlspecialchars($data['enquiry_no']) ?>">
        </div>

        <div class="form-group">
          <label>Product Line</label>
          <input type="text" name="product_line" value="<?= htmlspecialchars($data['product_line']) ?>">
        </div>

        <div class="form-group">
          <label>Category</label>
          <input type="text" name="category" value="<?= htmlspecialchars($data['category']) ?>">
        </div>

        <div class="form-group">
          <label>Modules No</label>
          <input type="number" name="modules_no" value="<?= htmlspecialchars($data['modules_no']) ?>">
        </div>

        <div class="form-group">
          <label>Pallet Numbers</label>
          <input type="number" name="pallet_no" value="<?= htmlspecialchars($data['pallet_no']) ?>">
        </div>

        <div class="form-group">
          <label>Drawn By</label>
          <input type="text" name="drawn_by" value="<?= htmlspecialchars($data['drawn_by']) ?>">
        </div>

        <div class="form-group">
          <label>Sales Person</label>
          <input type="text" name="sales_person" value="<?= htmlspecialchars($data['sales_person']) ?>">
        </div>

        <div class="form-group">
          <label>Revision Number</label>
          <input type="text" name="revision_no" value="<?= htmlspecialchars($data['revision_no']) ?>">
        </div>

        <div class="form-group full-width">
          <label>Remarks</label>
          <textarea name="remarks" rows="3"><?= htmlspecialchars($data['remarks']) ?></textarea>
        </div>
      </div>

      <div class="button-container">
        <button type="submit" class="submit-btn">💾 Save Changes</button>
        <a href="view_data.php" class="back-btn">← Back</a>
      </div>
    </form>
  </div>
</body>
</html>
