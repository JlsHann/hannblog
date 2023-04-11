<?php
require('../conn.php');
session_start();
$date = date('Y-m-d');
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $name = $_POST['fname'];
    $surname = $_POST['surname'];
    if ($username != null and $password != null) {
        $query = "INSERT INTO `user` (`user_id`, `username`, `password`, `dor`, `access`,`fname`,`sname`,`active`,`avatar`) VALUES (NULL, '$username', '$password', '$date', '2','$name','$surname','True','default.jpg'); ";
        $search = "SELECT * from user";
        $verification = mysqli_query($conn, $search) or DIE("Bad Verification");
        while ($row = mysqli_fetch_array($verification)) {
            if ($username == $row['username']) {
                $code = False;
                break;
            } else {
                $code = True;
            }
        }
        if ($code){
            mysqli_query($conn, $query) or DIE("Bad query");
            header("Location: login.php");
        }else{
            $msg = "This username is already taken";
        }
    } else {
        $msg = "Please fill both required fields";
    }

}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Blog Sign Up</title>
    
</head>
<body>
    <section class="text-center">
        <div class="card mx-4 mx-md-5 shadow-5-strong" style="
                margin-top: 100px;
                background: hsla(0, 0%, 100%, 0.8);
                backdrop-filter: blur(30px);
                ">
                <div class="card-body py-5 px-md-5">

                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-8">
                            <h2 class="fw-bold mb-5">Sign Up</h2>

                            <form method='POST' action ='signup.php' >
                            
                                <div class="row">
                                    <div class='form-outline'>
                                        <input type="text" name="username" placeholder="Username" class="form-control form-control-m">
                                        <label for="username" class="form-label">Username</label>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">                                           
                                            <input type='text' name='fname' placeholder='First Name' class="form-control form-control-sm" >
                                            <label for='fname' class="form-label">First Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <input type='text' name='surname' placeholder='Surname' class='form-control form-control-sm'>
                                            <label for='surname' class="form-label">Surname</label>
                                        </div>  
                                    </div>
                                </div>
                                    <div class="form-outline">
                                        <input type='password' name='password' class="form-control form-control-m" placeholder="Password" >
                                        <label class="form-label" for='password'>Password</label>
                                    </div>


                                    <button type='submit'  name='submit' value ='submit' class="btn btn-primary">Submit</button>
                                    <div class="text-center">
                                        <?php
                                            if (isset($msg)){
                                                echo "<p style='color:red;'>" . $msg . "</p>";
                                            }
                                        ?>
                                        <p>Already have an account? <a href="login.php">Log in!</a></p>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>