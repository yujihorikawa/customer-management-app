<?php

require 'auth.php';
requireLogin();
require 'db.php';

$name = trim($_POST['name'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$email = trim($_POST['email'] ?? '');
$company = trim($_POST['company'] ?? '');

$errors = [];

if ($name === '') {
    $errors[] = '名前を入力してください。';
} elseif (mb_strlen($name) > 100) {
    $errors[] = '名前は100文字以内で入力してください。';
}

$phoneDigits = str_replace('-', '', $phone);

if ($phone === '') {
    $errors[] = '電話番号を入力してください。';
} elseif (!preg_match('/^[0-9-]+$/', $phone)) {
    $errors[] = '電話番号は数字とハイフンのみで入力してください。';
} elseif (!in_array(strlen($phoneDigits), [10, 11], true)) {
    $errors[] = '電話番号は10桁または11桁で入力してください。';
}

if ($email === '') {
    $errors[] = 'メールアドレスを入力してください。';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'メールアドレスの形式が正しくありません。';
} elseif (mb_strlen($email) > 255) {
    $errors[] = 'メールアドレスは255文字以内で入力してください。';
}

if ($company === '') {
    $errors[] = '会社名を入力してください。';
} elseif (mb_strlen($company) > 100) {
    $errors[] = '会社名は100文字以内で入力してください。';
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = [
        'name' => $name,
        'phone' => $phone,
        'email' => $email,
        'company' => $company
    ];

    header('Location: create.php');
    exit;
}

$sql = "
INSERT INTO customers
(name, phone, email, company)
VALUES
(:name, :phone, :email, :company)
";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':name' => $name,
    ':phone' => $phone,
    ':email' => $email,
    ':company' => $company
]);

header('Location: index.php');
exit;
