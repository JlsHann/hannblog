<?php
session_start();
require('../../conn.php');
if(isset($_GET['id']) && isset($_GET['action']) && ($_GET['action'] == 'Show' || $_GET['action'] == 'Hide')){
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "UPDATE `category` SET `visible`= IF(`visible`='True', 'False', 'True') WHERE `category_id` = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    if(mysqli_stmt_execute($stmt)){
        echo "User status updated successfully.";
    }else{
        echo "Error updating user status: " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
}else{
    echo "ERROR: Invalid action or user ID.";
}
mysqli_close($conn);
header("Location: category.php");
?>