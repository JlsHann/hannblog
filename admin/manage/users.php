<?php
session_start();
require('../../conn.php');
$user = $_SESSION['username'];

if(isset($_POST['Submit'])){
    if($_POST['username'] != null && $_POST['fname'] != null && $_POST['sname'] != null){
        $update = "UPDATE `user` SET `username`='$_POST[username]', `fname`='$_POST[fname]', `sname`='$_POST[sname]', `access`='$_POST[access]' WHERE `username`='$_GET[username]'";
        mysqli_query($conn, $update) or DIE('couldnt connect');
        header("Location: ../index.php");
        exit();
    }else{
        $msg = "Please fill all fields";
    }
}
$select = "SELECT * from user";
$search = mysqli_query($conn, $select);
while ($row = mysqli_fetch_array($search)){
    if ($row['username'] == $_GET['username']){
        extract($row);
    }
}

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">  
        <title>Edit <?php echo $_GET['username'] ?></title>
    </head>
    <body>
        <section class="text-center">
        <div class="card mx-5 mx-md-5 shadow-5-strong" style="
                margin-top: 100px;
                background: hsla(0,0%,100%,0.8);
                backdrop-filter: blur(30px);
                ">
                <div class="card-body py-5 px-md-5">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-8">
                            <h2 class="fw-bold mb-5">Edit User</h2>
                            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; echo "?username=$username"; ?>">

                                <div class="row">

                                    <div class='form-outline'>
                                        <input type="text" name="username" value="<?php echo $username; ?>" placeholder="Username" class="form-control form-control-m">
                                        <label for="username" class="form-label">Username</label>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">                                           
                                            <input type='text' value="<?php echo $fname; ?>" name='fname' placeholder='First Name' class="form-control form-control-m" >
                                            <label for='fname' class="form-label">First Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <input type='text' name='sname' value="<?php echo $sname; ?>" placeholder='Surname' class='form-control form-control-m'>
                                            <label for='surname' class="form-label">Surname</label>
                                        </div>  
                                    </div>
                                </div>
                                <div class="btn-group">
                                    <input type="radio" class="btn-check" name="access" id="1" value="1" checked />
                                    <label class="btn btn-secondary" for="2">Member</label>

                                    <input type="radio" class="btn-check" name="access" id="2" value="2" />
                                    <label class="btn btn-secondary" for="1">Admin</label>
                                </div>
                                    <br><br>
                                    <button type='submit'  name='Submit' value ='Submit' class="btn btn-primary">Submit</button>
                                    <div class="text-center">
                                        <?php
                                        if(isset($msg)){
                                            echo "<p style='color:red;'>" . $msg . "</p>";
                                        }
                                        ?>
                                </div>
                            </form>
                        </div>
        </section>
    </body>
</html>