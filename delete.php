<?php

$pdo  = new PDO('mysql:host=localhost;port=3306;dbname=php_blog', 'root', '');
// in case of an error
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = $_POST['id'] ?? null;
if (!$id) {
  header('Location: index.php');
  exit;
}

$statement = $pdo->prepare('DELETE FROM posts WHERE id = :id');
$statement->bindValue(':id', $id);
$statement->execute();

header('Location: index.php');
