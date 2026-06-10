<?php

require 'db.php';

$keyword = $_GET['keyword'] ?? '';

if ($keyword !== '') {
    $sql = "SELECT * FROM customers 
            WHERE name LIKE :keyword 
            OR phone LIKE :keyword 
            OR company LIKE :keyword";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':keyword' => '%' . $keyword . '%'
    ]);
    $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $sql = "SELECT * FROM customers";
    $customers = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>顧客一覧</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<h1>顧客一覧</h1>
<form action="index.php" method="get" class="search-form">
  <input
    type="text"
    name="keyword"
    placeholder="名前・電話番号・会社名で検索"
    value="<?= htmlspecialchars($keyword) ?>"
  >
  <button type="submit">検索</button>
  <a href="index.php">リセット</a>
</form>
<p>
<a class="btn" href="create.php">顧客登録</a>
</p>

<table border="1">

<tr>
<th>ID</th>
<th>名前</th>
<th>電話番号</th>
<th>会社名</th>
<th>操作</th>
</tr>

<?php foreach($customers as $customer): ?>

<tr>
<td><?= $customer['id'] ?></td>
<td><?= htmlspecialchars($customer['name']) ?></td>
<td><?= htmlspecialchars($customer['phone']) ?></td>
<td><?= htmlspecialchars($customer['company']) ?></td>


<td>
<a class="btn-edit" href="edit.php?id=<?= $customer['id'] ?>">編集</a>

<a
  class="btn-delete"
  href="delete.php?id=<?= $customer['id'] ?>"
  onclick="return confirm('本当に削除しますか？');"
>
  削除
</a>
</td>
</tr>

<?php endforeach; ?>

</table>
</div>
</body>
</html>