<?php
session_start();
$page_css = "css/style.css";
include 'header.php';
?>
<div class="container"  style="height:auto;">
    <h1 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Welcome to Tennis Connect Hub</h1>
    <p class="text-center px-24">Tennis Connect Hub is your go-to platform for all things tennis-related. </p>
    <div class="features flex justify-center flex-wrap relative">
      <div
        class="feature relative block max-w-sm p-6 bg-white  rounded shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 mr-3">
        <img src=".\assets\images\court-img.png" alt="" class="pb-1 court-img">
        <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Court Reservation</h2>
        <p class="font-normal text-gray-700 dark:text-gray-400">Search and book tennis courts in your area based on
          court type, location,date and availability. </p>
          <a href="court-reservation.php" class="mt-6 button-service text-center  border border-gray-300 text-gray-900 text-sm rounded focus:ring-cyan-50 focus:border-cyan-50 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">Court Reservation</a>
      </div>
      <div
        class="feature relative block max-w-sm p-6 bg-white  rounded shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 mr-3">
        <img src=".\assets\images\find-coach.png" alt="" class="pb-1" >    
        <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Find Coaches</h2>
        <p class="font-normal text-gray-700 dark:text-gray-400">Discover experienced tennis coaches tailored to your
          level of play and training needs. </p>
          <a href="find-coaches.php" class="mt-6 button-service text-center border border-gray-300 text-gray-900 text-sm rounded focus:ring-cyan-50 focus:border-cyan-50 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">Find Coaches</a>
      </div>
      <div
        class="feature block max-w-sm p-6 bg-white  rounded shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 mr-3">
        <img src=".\assets\images\find-partner.png" alt="" class="w-full h-52 pb-4">  
        <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Find Game Partners</h2>
        <p class="font-normal text-gray-700 dark:text-gray-400">Connect with fellow tennis enthusiasts and find game
          partners for competitive matches or friendly rallies. </p>
          <a href="find-game-partners.php" class="mt-6  button-service text-center border border-gray-300 text-gray-900 text-sm rounded  focus:ring-cyan-50 focus:border-cyan-50 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">Find Game Partners</a>
      </div>
    </div>
  </div>
  <?php include 'footer.php'; ?>