<?php
include 'db_connect.php';
$query = "
  SELECT pso_data.id, project_master.customer_name, project_master.project_name,
         pso_data.received_date, pso_data.send_date, pso_data.enquiry_no,
         pso_data.sales_person, pso_data.revision_no
  FROM pso_data
  JOIN project_master ON pso_data.project_id = project_master.id
  ORDER BY pso_data.id DESC
";
$result = pg_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View PSO Data</title>
  <style>
    body { font-family: Poppins, sans-serif; background: #f2f4f8; }
    table { width: 95%; margin: 30px auto; border-collapse: collapse; background: white; }
    th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
    th { background: #5563DE; color: white; }
    a.edit-btn { color: #007bff; text-decoration: none; font-weight: bold; }
    a.edit-btn:hover { text-decoration: underline; }
  </style>
</head>
<body>
  <h1 style="text-align:center;">📋 PSO Data Records</h1>
  <table>
    <tr>
      <th>Customer</th>
      <th>Project</th>
      <th>Received Date</th>
      <th>Send Date</th>
      <th>Enquiry No</th>
      <th>Sales Person</th>
      <th>Revision</th>
      <th>Action</th>
    </tr>
    <?php while ($row = pg_fetch_assoc($result)): ?>
      <tr>
        <td><?= htmlspecialchars($row['customer_name']) ?></td>
        <td><?= htmlspecialchars($row['project_name']) ?></td>
        <td><?= htmlspecialchars($row['received_date']) ?></td>
        <td><?= htmlspecialchars($row['send_date']) ?></td>
        <td><?= htmlspecialchars($row['enquiry_no']) ?></td>
        <td><?= htmlspecialchars($row['sales_person']) ?></td>
        <td><?= htmlspecialchars($row['revision_no']) ?></td>
        <td><a class="edit-btn" href="edit_pso.php?id=<?= $row['id'] ?>">Edit</a></td>
      </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>
<?php pg_close($conn); ?>
