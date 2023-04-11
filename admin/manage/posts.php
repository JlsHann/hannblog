<?php
session_start();
require('../../conn.php');
if($_SESSION['access'] != 1){
    header("Location: ../../index.php");
}else{


    $postSearch = "SELECT * FROM `posts`";
    $postSelect = mysqli_query($conn, $postSearch);
    while($row = mysqli_fetch_array($postSelect)){
        if($row['post_id'] == $_GET['id']){
        extract($row);
        }
    }
    if(isset($_POST['submit'])){
        if($_POST['title'] != null && $_POST['content'] != null){
            $updateQuery = "UPDATE `posts` SET `title`='$_POST[title]', `content`='$_POST[content]' WHERE `post_id`=$_GET[id]";
            mysqli_query($conn, $updateQuery) or DIE('error: ' . mysqli_error($conn));
            header("Location: ../index.php");
            exit();
        }else{
            echo "Fill all fields";
        }
    }

}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">  
    <!-- Initiate ckeditor5 -->
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <title>Edit <?php echo $title; ?></title>
  </head>
  <body>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; echo "?id=$post_id"; ?>">
        <input type="text" name="title" value="<?php echo $title; ?>" placeholder="Post Title" Required>
        <label for="title">Title</label>
        
        <textarea name="content" id="editor" rows="6" cols="50"></textarea>
        <script>
            let editor;

            ClassicEditor.create(document.querySelector('#editor'), {
                // Your configuration options go here
            })
            .then(editor => {
                // Set the pre-existing text in the editor
                editor.setData('<?php echo $content; ?>');

                // Add a click event listener to the submit button
                document.querySelector('#submit').addEventListener('click', () => {
                    // Get the editor content
                    const editorData = editor.getData();
                    console.log(editorData); // Output the editor content to the console
                });
            })
            .catch(error => {
                console.error(error);
            });

        </script>
        <button type='submit'  name='submit' value ='submit' class="btn btn-primary">Submit</button>
    </form>








    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>