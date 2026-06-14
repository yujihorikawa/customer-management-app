<?php

require 'auth.php';
requireLogin();
require 'db.php';

$id = $_GET['id'] ?? '';

if ($id === '') {
    exit('IDが指定されていません。');
}

$sql = "SELECT * FROM customers WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':id' => $id
]);

$customer = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$customer) {
    exit('顧客データが見つかりません。');
}

$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? $customer;

unset($_SESSION['errors'], $_SESSION['old']);

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

<?php if (!empty($errors)): ?>
  <div class="error-box">
    <ul>
      <?php foreach ($errors as $error): ?>
        <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<form action="update.php" method="post">
<input
  type="hidden"
  name="id"
  value="<?= htmlspecialchars($customer['id'], ENT_QUOTES, 'UTF-8') ?>"
>

<p>
名前
<input
  type="text"
  name="name"
  value="<?= htmlspecialchars($old['name'], ENT_QUOTES, 'UTF-8') ?>"
>
</p>

<p>
電話番号
<input
  type="text"
  name="phone"
  value="<?= htmlspecialchars($old['phone'], ENT_QUOTES, 'UTF-8') ?>"
>
</p>

<p>
メールアドレス
<input
  type="email"
  name="email"
  value="<?= htmlspecialchars($old['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
>
</p>

<p>
会社名
<input
  type="text"
  name="company"
  value="<?= htmlspecialchars($old['company'], ENT_QUOTES, 'UTF-8') ?>"
>
</p>

<button type="submit">更新</button>
</form>

<p>
<a href="index.php">一覧へ戻る</a>
</p>
</div>

</body>
</html>
