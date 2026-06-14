<?php

require 'auth.php';
require 'auth_config.php';

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if ($username === LOGIN_USERNAME && hash_equals(LOGIN_PASSWORD, $password)) {
    session_regenerate_id(true);
    $_SESSION['user'] = $username;

    header('Location: index.php');
    exit;
}

$_SESSION['login_error'] = 'ユーザー名またはパスワードが正しくありません。';
header('Location: login.php');
exit;

