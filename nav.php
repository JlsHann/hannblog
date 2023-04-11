<?php
session_start();
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">  
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #04783c">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Nomadic Nook</a>
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
                            <a class="nav-link" href="upload.php">Upload</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="auth/signup.php">Sign up</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="auth/login.php">Log in</a>
                        </li>
                        <?php
                            if($_SESSION['access'] == 1){
                                echo "<li class='nav-item'>";
                                echo "<a class='nav-link' href='admin/index.php'>Admin Page</a>";
                                echo "</li>";
                            }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="auth/logout.php">Log out</a>
                        </li>
                        <li class="nav-item ml-auto">
                            <form class="d-flex" action="search.php" method="GET">
                                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                                    name="query">
                                <button class="btn btn-outline-light" type="submit">Search</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </body>
</html>