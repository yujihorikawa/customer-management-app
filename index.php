<?php

require 'auth.php';
requireLogin();
require 'db.php';

$keyword = $_GET['keyword'] ?? '';

if ($keyword !== '') {
    $sql = "SELECT * FROM customers
            WHERE name LIKE :keyword
            OR phone LIKE :keyword
            OR email LIKE :keyword
            OR company LIKE :keyword
            ORDER BY id DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':keyword' => '%' . $keyword . '%'
    ]);
    $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $sql = "SELECT * FROM customers ORDER BY id DESC";
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
<div class="page-header">
  <h1>顧客一覧</h1>
  <div class="user-menu">
    <span><?= htmlspecialchars(currentUser(), ENT_QUOTES, 'UTF-8') ?> さん</span>
    <a href="logout.php">ログアウト</a>
  </div>
</div>

<form action="index.php" method="get" class="search-form">
  <input
    type="text"
    name="keyword"
    placeholder="名前・電話番号・メールアドレス・会社名で検索"
    value="<?= htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8') ?>"
  >
  <button type="submit">検索</button>
  <a href="index.php">リセット</a>
</form>

<p>
<a class="btn" href="create.php">顧客登録</a>
</p>

<table>
<tr>
<th>ID</th>
<th>名前</th>
<th>電話番号</th>
<th>メールアドレス</th>
<th>会社名</th>
<th>登録日時</th>
<th>操作</th>
</tr>

<?php foreach ($customers as $customer): ?>
<tr>
<td><?= htmlspecialchars($customer['id'], ENT_QUOTES, 'UTF-8') ?></td>
<td><?= htmlspecialchars($customer['name'], ENT_QUOTES, 'UTF-8') ?></td>
<td><?= htmlspecialchars($customer['phone'], ENT_QUOTES, 'UTF-8') ?></td>
<td><?= htmlspecialchars($customer['email'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
<td><?= htmlspecialchars($customer['company'], ENT_QUOTES, 'UTF-8') ?></td>
<td><?= htmlspecialchars($customer['created_at'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
<td class="actions">
<a class="btn-edit" href="edit.php?id=<?= urlencode($customer['id']) ?>">編集</a>
<a
  class="btn-delete"
  href="delete.php?id=<?= urlencode($customer['id']) ?>"
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
