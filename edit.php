<?php

require 'db.php';

$id = $_GET['id'];

$sql = "SELECT * FROM customers WHERE id = :id";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':id' => $id
]);

$customer = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>顧客編集</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">

<h1>顧客編集</h1>

<form action="update.php" method="post">

<input
type="hidden"
name="id"
value="<?= $customer['id'] ?>"
>

<p>
名前
<input
type="text"
name="name"
value="<?= htmlspecialchars($customer['name']) ?>"
>
</p>

<p>
電話番号
<input
type="text"
name="phone"
value="<?= htmlspecialchars($customer['phone']) ?>"
>
</p>

<p>
会社名
<input
type="text"
name="company"
value="<?= htmlspecialchars($customer['company']) ?>"
>
</p>

<button type="submit">
更新
</button>

</form>
</div>
</body>
</html>