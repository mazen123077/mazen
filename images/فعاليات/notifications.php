
<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>الإشعارات</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Tajawal&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Tajawal', sans-serif; background: #f8f9fa; }
    h2 { margin-top: 20px; }
    .badge { font-size: 0.9em; }
  </style>
</head>
<body class="container">
  <h2 class="text-center my-4">🔔 إدارة الإشعارات</h2>
  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>العنوان</th>
        <th>الرسالة</th>
        <th>النوع</th>
        <th>التاريخ</th>
        <th>الحالة</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $stmt = $pdo->query("SELECT * FROM notifications ORDER BY created_at DESC");
      $i = 1;
      while ($row = $stmt->fetch()):
        $status = $row['is_read'] ? 'مقروء' : 'غير مقروء';
        $status_class = $row['is_read'] ? 'success' : 'warning';
        $type_class = match($row['type']) {
          'success' => 'bg-success',
          'info' => 'bg-info',
          'warning' => 'bg-warning',
          'error' => 'bg-danger',
          default => 'bg-secondary'
        };
      ?>
      <tr>
        <td><?= $i++ ?></td>
        <td><?= $row['title'] ?></td>
        <td><?= $row['message'] ?></td>
        <td><span class="badge <?= $type_class ?> text-white"><?= $row['type'] ?></span></td>
        <td><?= $row['created_at'] ?></td>
        <td><span class="badge bg-<?= $status_class ?>"><?= $status ?></span></td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</body>
</html>
