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
    <h1 class="display-3">Eldrige Blog Post</h1>
    <div class="jumbotron">
      <p>Simple Blog Post created with PHP</p>
    </div>
    <a href="create.php" class="btn btn-success m-5">Create new post</a>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Date Created</th>
          <th scope="col">Actions</th>
        </tr>

      </thead>
      <tbody>
        <?php foreach ($posts as $i => $post) { ?>
          <tr>
            <td><?php echo $i + 1 ?></td>
            <td><?php echo $post['title'] ?></td>
            <td><?php echo $post['details'] ?></td>
            <td><?php echo $post['create_at'] ?></td>
            <td>
              <a href="update.php?id=<?php echo $post['id'] ?>" class="btn btn-outline-primary">Edit</a>
              <form method="post" action="delete.php" class="d-flex">
                <input type="hidden" name="id" value="<?php echo $post['id'] ?>" />
                <button type="submit" class="btn  btn-outline-danger">Delete</button>
              </form>

            </td>
          </tr>


        <?php } ?>

      </tbody>
    </table>
  </div>
</body>

</html>