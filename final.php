<?php

session_start();

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $status = $_SESSION['status']; 
    
    if ($status === 'success') 
    {
        echo "<div class='success-message'>{$message}</div>";    
    }
    else 
    {
        echo "<div class='failure-message'>{$message}</div>";
    }
    
    unset($_SESSION['message']);
    unset($_SESSION['status']);
} else {
    echo "No message to display.";
}
?>
