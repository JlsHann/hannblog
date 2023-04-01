<?php
session_start();
if($_SESSION['access'] != 1) {
    //header('location: ../index.php');
    } else {
        require("../conn.php");
        $user = $_SESSION['username'];
        $count=1;
        // Setup for rows


        // Verify user
        // $select = "SELECT * from `user`";
        // $search = mysqli_query($conn, $select) or die('bad select query');
        // while ($row = mysqli_fetch_array($search)){
        //     if ($row['username'] == $user){
        //         extract($row);
        //         if($access == "1"){
        //             header("Location: index.php");
        //         }
        //     }
        // }
        $catGrab = "SELECT * FROM `categories`";
        $cats = mysqli_query($conn, $catGrab);
        $postSort = "SELECT * FROM `posts` WHERE `category`=";
        ?>

        <!doctype html>
        <html lang="en">
            <head>           
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">  
                <title>Edit profile</title>
            </head>
            <body>


            <!-- Tab 2 content - User List -->
                <div class="row">
                    <div class="col">
                        <form method="GET" action="admin/useredit.php">
                            <table class="table align-midddle" >
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
                                        while($row = mysqli_fetch_array($list)){
                                            $username=$row['username'];
                                            if($row['active'] == "True"){
                                                $button = "btn btn-primary";
                                                $active = "Deactivate";
                                            }else{
                                                $button = "btn btn-secondary";
                                                $active = "Activate";
                                            }
                                            echo "<tr>";
                                            echo "<th scope='row'>$count</th>";
                                            echo "<td>$row[fname]</td>";
                                            echo "<td>$row[sname]</td>";
                                            echo "<td>$row[username]</td>";
                                            echo "<td>$row[access]</td>";
                                            echo "<td> <a class='btn btn-primary' data-ripple-color='dark' href='useredit.php?username=$username'>Edit</a>";
                                            echo "<td> <a class='$button'  href='disable.php?id=$row[user_id]&action=$active'>$active</a></td>";
                                            $count++;
                                            // echo "<td> <a class='btn btn-primary' data-ripple-color='dark' href='useredit.php'>Edit</a>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div class="col">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                


                const ctx = document.getElementById('myChart');

                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                    labels: [
                        <?php
                            // Get list of categories from database
                            $labels = [];
                            while($row = mysqli_fetch_array($cats)){
                                array_push($labels,$row['category']);
                            }
                            $postsPerCategory = [];
                            foreach($labels as $cat){
                                $grabPosts = mysqli_query($conn,$postSort."$cat;");
                                $count = 0;
                                while($row = mysqli_fetch_array($conn,$grabPosts)){
                                    $count++;
                                }
                                $postPerCategory[$cat] = $count;
                            }
                            foreach($labels as $label){
                                echo "'$label', ";
                            }
                            
                        ?>
                    ],
                    datasets: [{
                        label: '# of Posts',
                        data: [
                        <?php
                            foreach($postPerCategory as $count){
                                echo "'$count', ";
                            }
                        ?>
                        ],
                        borderWidth: 1
                    }]
                    },
                    options: {
                    scales: {
                        y: {
                        beginAtZero: true
                        }
                    }
                    }
                });
            </script>
        </body>
        
    </html>
<?php } ?>
