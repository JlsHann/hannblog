<?php
session_start();
require('../../conn.php');
if($_SESSION['access'] != 1){
    header("Location: ../index.php");
}
$form =[];
$categorySelect = "SELECT * FROM `categories`";
$getCategories = mysqli_query($conn,$categorySelect);

if(isset($_POST['add'])){
    $form = array(
        "<input type='text' name='category' placeholder='Enter category name' require>",
        "<label for='category' class='form-label'>Category Name</label>",
        "<textarea name='summary' placeholder='Enter a short description of the category!' cols='70' rows='3' maxlength='150' required></textarea>",
        "<button type='submit'  name='aSubmit' value ='aSubmit' class='btn btn-primary'>Submit</button>"

    );
}elseif(isset($_POST['edit'])){
    print_r($_POST);
    $form = array(
        "<input type='text' name='category' placeholder='Enter category name' require>",
        "<label for='category' class='form-label'>Category Name</label>",
        "<textarea name='summary' placeholder='Enter a short description of the category!' cols='70' rows='3' maxlength='150' required></textarea>",
        "<button type='submit'  name='eSubmit' value ='Submit' class='btn btn-primary'>Submit</button>"
    );
}else{
    $count=1;
    $form[0] = "<thead>
                    <tr>
                        <th scope='col'>Name</th>
                        <th scope='col'>Summary</th>
                        <th scope='col'>Select</th>
                    </tr>
                </thead>";
    while($row = mysqli_fetch_array($getCategories)){
        if($row['visible'] == 'True'){
            $action = "Hide";
            $button = "btn btn-primary";
        }
        else{
            $action = "Show";
            $button = "btn btn-secondary";
        }
        $form[$count] = "<tr><br><b><td>$row[category]</td></b><td><p>$row[summary]</p></td> <input type='hidden' name='id' value='$row[category_id]'> <td><button type='submit'  name='edit' value ='edit' class='btn btn-primary'>Edit</button></td><td> <a class='$button'  href='disablecat.php?id=$row[category_id]&action=$action'>$action</a></td></tr>";
        $count++;
    }

}
if(isset($_POST['aSubmit'])){
    // $catQuery = "UPDATE `categories` SET `category`='$_POST[category]', `summary`='$_POST[summary]' WHERE `category_id`='$_POST[category_id]'";
    $catQuery = "INSERT INTO `categories` (`category_id`, `category`, `summary`) VALUES (NULL, '$_POST[category]', '$_POST[summary]');";
    mysqli_query($conn,$catQuery) or DIE('error: ' . mysqli_error($conn));
}

?>
<!doctype html>
        <html lang="en">
            <head>           
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">  
                <title>Edit Categories</title>
            </head>
            <body>
                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #04783c">
            <div class="container-fluid">
                <a class="navbar-brand" href="../index.php">Placeholder Name</a>
                <button
                class="navbar-toggler"
                type="button"
                data-mdb-toggle="collapse"
                data-mdb-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation"
                >
                <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="categories.php">Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../auth/signup.php">Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../auth/logout.php">Logout</a>
                        </li>
                        <!-- <form class="d-flex input-group w-auto">
                            <input
                                type="search"
                                class="form-control rounded"
                                placeholder="Search"
                                aria-label="Search"
                                aria-describedby="search-addon"
                            />
                            <span class="input-group-text border-0" id="search-addon">
                                <i class="fas fa-search"></i>
                            </span> -->
                        </form>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="form-group">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <h2 class="text-center">Categories</h2>
                <button class="btn btn-primary" name="add" type="submit">add</button>
                <table class="table table-striped">
                <?php
                    foreach($form as $lines){
                        echo "<tr>";
                        echo $lines;
                        echo "</tr>";
                    }
                ?>
                </table>
            </form>
        </div>




    </body>
</html>
