<?php

require 'db.php';

$sql = "
UPDATE customers
SET
name = :name,
phone = :phone,
company = :company
WHERE id = :id
";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':name' => $_POST['name'],
    ':phone' => $_POST['phone'],
    ':company' => $_POST['company'],
    ':id' => $_POST['id']
]);

header('Location: index.php');

exit;