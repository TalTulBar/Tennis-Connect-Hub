<?php
session_start();
$page_css = "css/style.css";
include 'header.php'; 
?>

<style>
    body {
        height: 100vh;
        margin: 0;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .content {
        text-align: center;
        padding: 50px;
    }
</style>

<div class="content">
    <p class="text-green-500">Your booked was successful! Thank you for shopping with us.</p>
</div>

<?php
include 'footer.php'; 
?>
