<?php

require 'auth.php';

if (isLoggedIn()) {
    header('Location: index.php');
    exit;
}

$error = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>ログイン</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container login-container">
<h1>ログイン</h1>

<?php if ($error !== ''): ?>
  <div class="error-box">
    <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
  </div>
<?php endif; ?>

<form action="login_process.php" method="post">
  <p>
    ユーザー名
    <input type="text" name="username" autocomplete="username">
  </p>

  <p>
    パスワード
    <input type="password" name="password" autocomplete="current-password">
  </p>

  <button type="submit">ログイン</button>
</form>
</div>
</body>
</html>
