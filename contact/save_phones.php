<?php
include('../db/config.php');

var_dump()
$data = [
    ['John','Doe', 22],
    ['Jane','Roe', 19],
];
$stmt = $pdo->prepare("INSERT INTO users (name, surname, age) VALUES (?,?,?)");
try {
    $pdo->beginTransaction();
    foreach ($data as $row)
    {
        $stmt->execute($row);
    }
    $pdo->commit();
}catch (Exception $e){
    $pdo->rollback();
    throw $e;
}