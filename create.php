<?php

session_start();

$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [
    'name' => '',
    'phone' => '',
    'company' => ''
];

unset($_SESSION['errors'], $_SESSION['old']);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>顧客登録</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h1>顧客登録</h1>

<?php if (!empty($errors)): ?>
  <div class="error-box">
    <ul>
      <?php foreach ($errors as $error): ?>
        <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<form action="store.php" method="post">

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
会社名
<input
  type="text"
  name="company"
  value="<?= htmlspecialchars($old['company'], ENT_QUOTES, 'UTF-8') ?>"
>
</p>

<button type="submit">登録</button>

</form>

<p>
<a href="index.php">一覧へ戻る</a>
</p>

</div>

</body>
</html>