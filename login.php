<?php
require('conn.php');
session_start();
if(isset($_POST['submit'])){
    $query = "SELECT * from `user`";
    $search = mysqli_query($conn,$query) or DIE('query sux');
    $username = $_POST['username'];
    while ($row = mysqli_fetch_array($search)){
        if ($username == $row['username']){
            if(password_verify($_POST['password'],$row['password'])){
                $_SESSION['username'] = $username;
                $_SESSION['access'] = $row['access'];
                if($row['access'] == "1"){
                    header("Location: admin/adminpage.php");
                }else{
                    header("location: index.php");
                }
            }
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
        <title>Log In</title>
    </head>
    <body>
        <section class="text-center">
            <div class="card mx-4 mx-md-5 shadow-5-strong" style="
                margin-top: 100px;
                background: hsla(0,0%,100%,0.8);
                backdrop-filter: blur(30px);
                ">
                <div class="card-body py-5 px-md-5">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-8">
                            <h2 class="fw-bold mb-5">Log In</h2>
                            <form method="POST" action="login.php">
                                
                                <div class="form-outline">
                                    <input type="text" name="username" placeholder="Username" class="form-control form-control-m">
                                    <label for="username" class="form-label">Username</label>
                                </div>
                                <div class="form-outline">
                                    <input type="password" name="password"  placeholder="Password" class="form-control form-control-m">
                                    <label for="password" class="form-label">Password</label>
                                </div>
                                <button type='submit' name='submit' value="submit" class="btn btn-primary">Submit</button>
                                <div class="text-center">
                                    <p>Don't have an account? <a href="signup.php"> Sign Up!</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>