<?php
session_start();
require('conn.php');
require('nav.php');

$id = $_GET['id'];
$selectPost = "SELECT * FROM `posts` WHERE `post_id` = '$id'";
$selectComment = "SELECT * FROM `comments` WHERE `post` = $id";

if(isset($_POST['submit'])){
    $query = "INSERT INTO `comments` (`comment_id`, `author`, `post`, `cdate`, `content`) VALUES (NULL, '$_POST[author]', '$id', '$_POST[date]', '$_POST[content]');";
    mysqli_query($conn,$query);
}


?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">  
        <title>Nomadic Nook</title>
    </head>
    <body>
        <div class="container">
            <?php
                $resultPost = mysqli_query($conn, $selectPost);
                $post = mysqli_fetch_assoc($resultPost);
            ?>
            <h1><?php echo $post['title']; ?></h1>
            <p class="text-muted"><?php echo date('F j, Y', strtotime($post['pdate'])); ?></p>
            <hr>
            <div class="card">
                <div class="card-body">
                    <?php echo $post['content']; ?>
                </div>
            </div>
            <div class="card">
                <?php
                    $resultComment = mysqli_query($conn, $selectComment);
                    while($row = mysqli_fetch_assoc($resultComment)){
                        echo "<div class='card-body>'";
                        echo "<br><em>$row[author]</em>";
                        echo "<p class='text-muted'>" . date('F j, Y g:i a', strtotime("$row[cdate]")) . "</p>";
                        echo "<p>$row[content]</p>";
                        echo "<hr></div>";
                    }
                ?>
                <form class="form-control" method="post" action="<?php echo $_SERVER['PHP_SELF']; echo "?id=$id"; ?>">
                    <input class="form-control form-control-m d-inline p-2" type="text" name="content" placeholder="Add your own comment here!" maxlength="200">
                    <input type="hidden" name="author" value="<?php echo $_SESSION['username']; ?>">
                    <input type="hidden" name="date" value="<?php echo date('Y-m-d H:i'); ?>"> 
                    <button type='submit'  name='submit' value ='submit' class="btn btn-primary d-inline p-2">Submit</button>
                </form>
            </div>
        </div>
    </body>
</html>