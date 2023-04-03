<?php
require("conn.php");
require("nav.php");
session_start();
if(isset($_SESSION['username'])){
    $loggedIn = True;
}else{
    $loggedIn = False;
}
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">  
        <title>Blog Name</title>
    </head>
    <body>
        <div class="text-center">
            <form action="index.php" method="get">
                <label for="Category">Filter: </label>
                <select name="Category" id="category">
                    <option value="none">All</option>
                    <?php
                        $catselect = "SELECT * from `categories`";
                        $catsearch = mysqli_query($conn,$catselect);
                        while($row = mysqli_fetch_array($catsearch)){
                            echo "<option value='$row[category]'>$row[category]</option>";
                        }
                    ?>
                </select>
                <button type='submit'  name='filter' value ='submit' class="btn btn-secondary btn-sm">Filter</button>
            </form>
        </div>
        <section class="text-center">
            <table>
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
                        echo "<h4 name='T$title'>$title</h4>";
                        echo "<label for='T$title'>Published by: $author</label>";
                        // echo "<small>Published by: $author</small><br>";
                    }

                ?>
            </table>
        </section>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </body>
</html>