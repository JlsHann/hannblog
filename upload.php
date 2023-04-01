<?php
require("conn.php");
require("nav.php");
session_start();
if(isset($_SESSION['username'])){
    $loggedIn = True;
}else{
    $loggedIn = False;
}
if(!$loggedIn){
    header("Location: index.php");
}
if(isset($_POST['submit'])){
    extract($_POST);
    if($title != null && $content != null){
        $uploadQuery = "INSERT INTO `posts` (`post_id`, `title`, `content`, `author`, `pdate`, `category`) VALUES (NULL, '$title', '$content', '$author', '$dop', '$category')";
        mysqli_query($conn,$uploadQuery);
    }else{
        echo "Somethings unset bro";
        if($content == null){
            echo "<br> it was the post ig";
        }
    }
}
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
        <title>Upload Post</title>
    </head>
    <body>
        <form method="post" action="upload.php">
            <div class="form control">
                <input type="text" name="title" placeholder="Enter your post title" autofocus>
                <label for="post" class="form-label">Share your thoughts!</label>
                <textarea id="editor" name="content" placeholder="Share your thoughts!" rows="6" cols="50"></textarea>
                <script>
                    let editor;

                    ClassicEditor
                        .create( document.querySelector( '#editor' ) )
                        .catch( error => {
                            console.error( error );
                        } );
                    
                    document.querySelector( '#submit' ).addEventListener( 'click', () => {
                        const editorData = editor.getData();

    // ...
                    } );
                </script>
                <input type="hidden" name="dop" value="<?php echo date('Y-m-d'); ?>">
                <input type="hidden" name="author" value="<?php echo $_SESSION['username']; ?>">
                <select name="category" id="category">
                <?php
                    $catselect = "SELECT * from `categories`";
                    $catsearch = mysqli_query($conn,$catselect);
                    while($row = mysqli_fetch_array($catsearch)){
                        echo "<option value='$row[category]'>$row[category]</option>";
                    }
                ?>
                </select>
                <br><br>
                <button type='submit'  name='submit' value ='submit' class="btn btn-primary">Post</button>
            </div>
        </form>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </body>
</html>