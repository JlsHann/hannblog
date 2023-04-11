<?php
session_start();
if($_SESSION['access'] != 1){
    header("Location: ../index.php");
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
                <a class="navbar-brand" href="index.php">Placeholder Name</a>
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
                            <a class="nav-link" href="auth/signup.php">Users</a>
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
    </body>
</html>
