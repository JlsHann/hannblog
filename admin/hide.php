<?php
session_start();
require('../conn.php');
$id = mysqli_real_escape_string($conn, $_GET['id']);
if(isset($_GET['action']) && ($_GET['action'] == 'Show' || $_GET['action'] == 'Hide')){
    $query = "UPDATE `posts` SET `visible`= IF(`visible`='True', 'False', 'True') WHERE `post_id` = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    if(mysqli_stmt_execute($stmt)){
        echo "User status updated successfully.";
    }else{
        echo "Error updating user status: " . mysqli_error($conn);
    }
}else{
    echo "ERROR: Invalid action or user ID.";
}
mysqli_stmt_close($stmt);
mysqli_close($conn);
header("Location: adminpage.php");
?>