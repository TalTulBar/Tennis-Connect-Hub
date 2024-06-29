<?php
  session_start();
  $page_css = "css/style.css";
  include 'header.php';
?>
  <div class="container">
    <h1 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Welcome to Tennis Connect Hub</h1>
    <p class="text-center px-24">Tennis Connect Hub is your go-to platform for all things tennis-related. </p>
    <div class="features flex justify-center flex-wrap relative">
      <div
        class="feature relative block max-w-sm p-6 bg-white  rounded shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 mr-3">
        <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Court Reservation</h2>
        <p class="font-normal text-gray-700 dark:text-gray-400">Search and book tennis courts in your area based on
          court type, location, and availability. </p>
      </div>
      <div
        class="feature relative block max-w-sm p-6 bg-white  rounded shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 mr-3">
        <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Find Coaches</h2>
        <p class="font-normal text-gray-700 dark:text-gray-400">Discover experienced tennis coaches tailored to your
          level of play and training needs. </p>
      </div>
      <div
        class="feature block max-w-sm p-6 bg-white  rounded shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 mr-3">
        <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Find Game Partners</h2>
        <p class="font-normal text-gray-700 dark:text-gray-400">Connect with fellow tennis enthusiasts and find game
          partners for competitive matches or friendly rallies. </p>
      </div>
    </div>
  </div>
  
<script>
  // This script will execute when the page loads
  window.onload = function() {
    // Hide the "Login" button
    var loginBtn = document.querySelector('.right .btn[href="signin.php"]');
    if (loginBtn) {
      loginBtn.style.display = 'none';
    }

    // Hide the "Sign Up" button
    var signUpBtn = document.querySelector('.right .btn[href="signup.php"]');
    if (signUpBtn) {
      signUpBtn.style.display = 'none';
    }


    // Show the "User" and "Favorite Player" elements
    var userAccount = document.getElementById('user-account');
    var favPlayer = document.getElementById('fav-player');
    if (userAccount && favPlayer) {
      userAccount.classList.remove('hidden');
      favPlayer.classList.remove('hidden');
    }
  };
</script>
  <?php include 'footer.php'; ?>