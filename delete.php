<?php

require 'auth.php';
requireLogin();
require 'db.php';

$id = $_GET['id'] ?? '';

if ($id === '') {
    exit('IDが指定されていません。');
}

$sql = "DELETE FROM customers WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':id' => $id
]);

header('Location: index.php');
exit;
