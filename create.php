<!DOCTYPE html>
<html lang="en">



<?php
// establishing a connection to the db
$pdo  = new PDO('mysql:host=localhost;port=3306;dbname=php_blog', 'root', '');
// in case of an error
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$statement =  $pdo->prepare('SELECT * FROM posts ORDER BY create_at DESC');

$statement->execute();
// fetch data as an associative array
$posts = $statement->fetchAll(PDO::FETCH_ASSOC);


$title = '';
$description = '';
$date = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = $_POST['title'];
  $details = $_POST['details'];

  $statement = $pdo->prepare("INSERT INTO posts (title, details, create_at)
                VALUES (:title, :details,  :date)");
  $statement->bindValue(':title', $title);
  $statement->bindValue(':details', $details);
  $statement->bindValue(':date', date('Y-m-d H:i:s'));

  $statement->execute();
}


// var_dump($products)
?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./assets/css/bootstrap.css">
  <link rel="stylesheet" href="./assets/css/styles.css">
</head>

<body>
  <div class="container">
    <h1 class="display-3">Create new post</h1>
    <form method="POST">
      <div class="form-group">
        <label>Post title</label>
        <input type="text" class="form-control" name="title" placeholder="Enter title......">
      </div>
      <div class="form-group">
        <label>Blog Description</label>
        <textarea class="form-control" placeholder="Enter a short description" name="details"></textarea>
      </div>


      <a href="index.php" class="btn btn-success">All Posts</a>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>

</html>