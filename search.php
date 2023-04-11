<?php
require('conn.php');
require('nav.php');
// Retrieve search term entered by user
$search_term = $_GET['query'];


// Query database to retrieve relevant posts
$search = "SELECT * FROM posts WHERE author LIKE '%$search_term%' OR content LIKE '%$search_term%' OR title LIKE '%$search_term%' ORDER BY title, author, content";
$result = $conn->query($search);
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
    <div class="row justify-content-center mt-3">
        <div class="col-md-6">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $post_id = $row['post_id'];
                    echo "<div class='card mb-3'>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'><a href='post.php?id=$post_id' style='text-decoration:none; color:inherit;'>".$row["title"]."</a></h5>";
                    echo "<p class='card-text'><small class='text-muted'>".$row["pdate"]."<br>By: ".$row["author"]."</small></p>";
                    echo "<p class='card-text'>".$row["content"]."</p>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No results found</p>";
            }
            ?>
        </div>
    </div>
</body>

</html>
