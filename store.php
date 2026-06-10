<?php

require 'db.php';

$sql = "
INSERT INTO customers
(name, phone, company)
VALUES
(:name, :phone, :company)
";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':name' => $_POST['name'],
    ':phone' => $_POST['phone'],
    ':company' => $_POST['company']
]);

header('Location: index.php');
exit;