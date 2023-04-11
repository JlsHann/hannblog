<?php
session_start();
if($_SESSION['access'] != 1) {
    //header('location: ../index.php');
    } else {
        require("../conn.php");
        $user = $_SESSION['username'];
        $count=1;

        // Data for charts
        $catQuery = "SELECT * FROM `categories`";
        $getCats = mysqli_query($conn, $catQuery) or DIE("Error:" . mysqli_error($conn));

        $postQuery = "SELECT * FROM `posts`";
        $getPosts = mysqli_query($conn,$postQuery) or DIE("Error:" . mysqli_error($conn));
        ?>

        <!doctype html>
        <html lang="en">
            <head>           
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">  
                <title>Admin Splash Page</title>
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
                            <a class="nav-link" href="manage/categories.php">Categories</a>
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

            <!-- Row 1 - User List and Posts per Category -->
                <div class="row h-50">
                <div class="col">
    <h3 class="text-center">User List</h3>
    <form method="GET" action="admin/manage/users.php">
        <div class="table-responsive" style="max-height: 41.8vh;">
            <table class="table align-middle table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Username</th>
                        <th scope="col">Level</th>
                        <th scope="col">Select</th>
                        <th scope="col">Active</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $query = "SELECT * from `user` WHERE `access` != 1";
                        $columns = 7;
                        $list = mysqli_query($conn,$query);
                        $count = 1;
                        while($row = mysqli_fetch_array($list)){
                            $username=$row['username'];
                            if($row['active'] == "True"){
                                $button = "btn btn-secondary";
                                $active = "Deactivate";
                            }else{
                                $button = "btn btn-primary";
                                $active = "Activate";
                            }
                            echo "<tr>";
                            echo "<th scope='row'>$count</th>";
                            echo "<td>$row[fname]</td>";
                            echo "<td>$row[sname]</td>";
                            echo "<td>$row[username]</td>";
                            echo "<td>$row[access]</td>";
                            echo "<td> <a class='btn btn-primary' data-ripple-color='dark' href='manage/users.php?username=$username'>Edit</a>";
                            echo "<td> <a class='$button'  href='disable.php?id=$row[user_id]&action=$active'>$active</a></td>";
                            $count++;
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </form>
    <style>
        .table thead th {
          position: sticky;
          top: 0;
          background-color: #fff;
          z-index: 1;
        }
    </style>
</div>

                    <div class="col">
                        <canvas class="mh-100 mw-100" id="myChart"></canvas>
                    </div>
                </div>
                <!-- Row 2 - Edit Posts and Posts Over Time -->
                <div class="row h-50">
                    <!-- Column 1b - Posts over the last 7 days -->
                    <div class="col">
                        <canvas class="mh-100 mw-100" id="lineChart"></canvas>
                    </div>
                    <!-- Column 2b - Edit and Delete Posts -->
                    <div class="col">
                        
                    <h3 class="text-center">List of Posts</h3>
                    <div class="table-responsive" style="max-height: 42vh;">
                        <table class="table align-midddle table-striped table-hover" >
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Author</th>
                                            <th scope="col">Date Posted</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Select</th>
                                            <th scope="col">Active</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $count=1;
                                            $query = "SELECT * from `posts`";
                                            $columns = 7;
                                            $list = mysqli_query($conn,$query);
                                            while($row = mysqli_fetch_array($list)){
                                                if($row['visible'] == "True"){
                                                    $button = "btn btn-primary";
                                                    $visible = "Hide";
                                                }else{
                                                    $button = "btn btn-secondary";
                                                    $visible = "Show";
                                                }
                                                echo "<tr>";
                                                echo "<th scope='row'>$count</th>";
                                                echo "<td>$row[title]</td>";
                                                echo "<td>$row[author]</td>";
                                                echo "<td>$row[pdate]</td>";
                                                echo "<td>$row[category]</td>";
                                                echo "<td> <a class='btn btn-primary' data-ripple-color='dark' href='manage/posts.php.php?id=$row[post_id]'>Edit</a>";
                                                echo "<td> <a class='$button'  href='hide.php?id=$row[post_id]&action=$visible'>$visible</a></td>";
                                                $count++;
                                                // echo "<td> <a class='btn btn-primary' data-ripple-color='dark' href='manage/users.php'>Edit</a>";
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
// Posts Per Category
                const ctx = document.getElementById('myChart');

                new Chart(ctx, {
                    type: 'polarArea',
                    data: {
                    labels: [
                        <?php
                            $categories = array();
                            while ($row = mysqli_fetch_array($getCats)){
                                array_push($categories,$row['category']);
                            }
                            foreach ($categories as $category){
                                echo "'$category', ";
                            }
                        ?>
                    ],
                    datasets: [{
                        label: '# of Posts',
                        data: [
                            <?php
                                $postsPerCategories = array();
                                foreach($categories as $category){
                                    $postsPerCategories[$category] = 0;
                                }
                                while($row = mysqli_fetch_array($getPosts)){
                                    if(array_key_exists($row['category'],$postsPerCategories)){
                                        $postsPerCategories[$row['category']]++;
                                    }
                                }
                                // Input data into chart
                                foreach($postsPerCategories as $posts){
                                    echo "'$posts', ";
                                }
                            ?>
                        ],
                        borderWidth: 1
                    }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                        r: {
                            pointLabels: {
                            display: true,
                            centerPointLabels: true,
                            font: {
                                size: 18
                            }
                            }
                        }
                        },
                    plugins: {
                        title: {
                        display:true,
                        text: '# of posts per category'
                    }
                    }
                    }
                });
// Posts per Days
                const cty = document.getElementById('lineChart');

                new Chart(cty, {
                    type: 'line',
                    data: {
                    labels: [
                        <?php

                            $days = array();
                            for ($i=0;$i<7;$i++) {
                                $days[$i] = date("Y-m-d", strtotime("-$i days"));
                            }
                            $postsPerDay = array();
                            foreach($days as $day){
                                $postsPerDay[$day] = 0;
                            }
                            while($row = mysqli_fetch_array($getPosts)){
                                $date = date("Y-m-d", strtotime($row['pdate']));
                                if (array_key_exists($date,$postsPerDay)){
                                    $postsPerDay[$date]++;
                                }
                            }
                            $postsPerDay = array_reverse($postsPerDay);
                            foreach ($postsPerDay as $date => $count){
                                echo "'$date', ";
                            }
                        ?>
                    ],
                    datasets: [{
                        label: '# of Posts',
                        data: [
                            <?php 
                                foreach($postsPerDay as $count){
                                    echo "$count, ";
                                }
                            ?>
                        ],
                        borderWidth: 1
                    }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        },
                        plugins: {
                            title: {
                                display:true,
                                text: '# of Posts in The Last 7 Days'
                            }
                        }
                    }
                });
            </script>
        </body>
        
    </html>
<?php 
} ?>