<?php
require("conn.php");
require("nav.php");
if(!isset($_SESSION['username'])){
    $_SESSION['username'] = 'Guest';
}
if($_SESSION['username'] == 'Guest'){
    $_SESSION['access'] = 3;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">  
    <title>Nomadic Nook</title>
</head>
<body>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="index.php" method="get">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="category">Filter:</label>
                        <select class="form-select" name="Category" id="category">
                            <option value="none">All</option>
                            <?php
                            $catselect = "SELECT * from `categories`";
                            $catsearch = mysqli_query($conn,$catselect);
                            while($row = mysqli_fetch_array($catsearch)){
                                echo "<option value='$row[category]'>$row[category]</option>";
                            }
                            ?>
                        </select>
                        <button type="submit" name="filter" value="submit" class="btn btn-secondary">Filter</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row justify-content-center mt-3">
            <div class="col-md-6">
            <?php
                if(isset($_GET['filter']) && $_GET['Category'] != 'none'){
                    $filter = " AND `category`= '$_GET[Category]'";
                }else{
                    $filter = '';
                }
                $grabPosts = "SELECT * FROM `posts` WHERE `visible` = 'True'" . $filter . ";";
                $grab = mysqli_query($conn,$grabPosts) or DIE('Query failed: ' . mysqli_error($conn));
                while($row = mysqli_fetch_array($grab)){
                    extract($row);
                    echo "<div class='card mb-3'>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'><a href='post.php?id=$post_id' style='text-decoration:none; color:inherit;'>$title</a></h5>";
                    echo "<p class='card-text'><small class='text-muted'>$pdate<br>By: $author</small></p>";
                    echo "<p class='card-text'>$content</p>";
                    echo "</div>";
                    echo "</div>";
                }
            ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
