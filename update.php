<?php


$id = $_GET['id'] ?? null;
if (!$id) {
  header('Location: index.php');
  exit;
}

$pdo  = new PDO('mysql:host=localhost;port=3306;dbname=php_blog', 'root', '');
// in case of an error
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$statement = $pdo->prepare('SELECT * FROM posts WHERE id = :id');
$statement->bindValue(':id', $id);
$statement->execute();
$post = $statement->fetch(PDO::FETCH_ASSOC);


$title = $post['title'];
$details = $post['details'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $title = $_POST['title'];
  $details = $_POST['details'];
  $statement = $pdo->prepare("UPDATE posts SET title = :title,  details = :details  WHERE id = :id");
  $statement->bindValue(':title', $title);
  $statement->bindValue(':details', $details);
  $statement->bindValue(':id', $id);

  $statement->execute();
  header('Location: index.php');
}

?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="./assets/css/bootstrap.css">
  <link rel="stylesheet" href="./assets/css/styles.css">
  <title>Edit page</title>
</head>

<body>
  <div class="container">
    <p>
      <a href="index.php" class="btn btn-default">Back to posts</a>
    </p>
    <h1>Update Post: <b><?php echo $post['title'] ?></b></h1>



    <form method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label>Post title</label>
        <input type="text" name="title" class="form-control" value="<?php echo $title ?>">
      </div>
      <div class="form-group">
        <label>Post details</label>
        <textarea class="form-control" name="details"><?php echo $details ?></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>

</body>

</html>