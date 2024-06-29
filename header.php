<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tennis Connect Hub</title>
  <link rel="icon" type="image/png" sizes="32x32" href="./assets/logo/favicon-io/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="./assets/logo/favicon-io/favicon-16x16.png">
  <?php
    if (isset($page_css)) {
      echo "<link rel='stylesheet' type='text/css' href='$page_css' />";
    }
  ?>
  <link rel="stylesheet" href="css/profile.css">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://js.braintreegateway.com/web/dropin/1.42.0/js/dropin.min.js"></script>
</head>

<body>
<?php
session_start();
// Get the current page file name
$current_page = basename($_SERVER['PHP_SELF']);
?>

<nav id="navbar">
  <div class="left">
    <ul>
      <li class="items-menu <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">
        <a href="index.php" class="nav-link">Home</a>
      </li>
      <li class="items-menu <?php echo ($current_page == 'court-reservation.php') ? 'active' : ''; ?>">
        <a href="court-reservation.php" class="nav-link">Court Reservation</a>
      </li>
      <li class="items-menu <?php echo ($current_page == 'find-coaches.php') ? 'active' : ''; ?>">
        <a href="find-coaches.php" class="nav-link">Find Coaches</a>
      </li>
      <li class="items-menu <?php echo ($current_page == 'find-game-partners.php') ? 'active' : ''; ?>">
        <a href="find-game-partners.php" class="nav-link">Find Game Partners</a>
      </li>
    </ul>
    <img src="./assets/logo/tennis_connect_club-transparant.png" alt="" class="hidden w-36 h-16 py-1 logo">
  </div>

  <div class="right">
  <?php
  if (isset($_SESSION['email'])) { ?>
      <a href="my-orders.php" rel="noopener noreferrer" id="fav-player"><i class='bx bxs-shopping-bag fav-player'></i></a>
      <a href="my-partners.php" rel="noopener noreferrer" id="fav-player"><i class='bx bxl-product-hunt fav-player'></i></a>
      <i class="bx bx-user user" id="user-account"></i>
  <?php } else { ?>
      <a href="signin.php" class="btn">Login</a>
      <a href="signup.php" class="btn">Sign Up</a>
      <i class='bx bx-menu menu-icon'></i>
  <?php } ?>
  </div>

  <div class="sidebar">
    <div class="logo">
      <i class='bx bx-x menu-icon'></i>
      <img src="./assets/logo/tennis_connect_club-transparant.png" alt="" class="w-full h-20 pb-5">
    </div>
    <hr class="border-t-2 border-gray-500">
    <div class="sidebar-content">
      <ul class="lists">
        <li class="list <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">
          <a href="index.php" class="nav-link">
            <span class="link">Home</span>
          </a>
        </li>
        <li class="list <?php echo ($current_page == 'court-reservation.php') ? 'active' : ''; ?>">
          <a href="court-reservation.php" class="nav-link">
            <span class="link">Court Reservation</span>
          </a>
        </li>
        <li class="list <?php echo ($current_page == 'find-coaches.php') ? 'active' : ''; ?>">
          <a href="find-coaches.php" class="nav-link">
            <span class="link">Find Coaches</span>
          </a>
        </li>
        <li class="list <?php echo ($current_page == 'find-game-partners.php') ? 'active' : ''; ?>">
          <a href="find-game-partners.php" class="nav-link">
            <span class="link">Find Game Partners</span>
          </a>
        </li>
        <li class="list flex flex-col">
        <?php
  if (isset($_SESSION['email'])) { ?>
         <a href="my-orders.php" rel="noopener noreferrer" id="fav-player"><i class='bx bxs-shopping-bag fav-player'></i></a>
         <a href="my-partners.php" rel="noopener noreferrer" id="fav-player"><i class='bx bxl-product-hunt fav-player'></i></a>
         <i class="bx bx-user user" id="user-account"></i>
  <?php } else { ?>
    <a href="signin.php" class="btn" style="background-color:#22D3EE;">Login</a>
    <a href="signup.php" class="btn" style="background-color:#6EDBEC; border:2px solid #22D3EE; color:black;">Sign Up</a>
  <?php } ?>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="fixed top-2 right-6 mt-14 pt-16 m-auto z-50">
    <div id="success-message" class="hidden p-1.5 px-8 bg-green-300 text-black rounded-sm text-sm shadow-lg"></div>
    <div id="error-message" class="hidden p-1.5 px-8 bg-red-600 text-white mt-2 rounded-sm text-sm shadow-lg"></div>
</div>

<!-- user profile -->
<?php
if (isset($_SESSION['full_name'])) {
    $fullName = $_SESSION['full_name'];
}
if (isset($_SESSION['id_number'])) {
    $idNumber = $_SESSION['id_number'];
}
if (isset($_SESSION['phone_number'])) {
    $phoneNumber = $_SESSION['phone_number'];
}
if (isset($_SESSION['city'])) {
    $city = $_SESSION['city'];
}
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
}
if (isset($_SESSION['level_of_play'])) {
    $level = $_SESSION['level_of_play'];
}
?>

<div class="profile-modal" id="profile-modal">
    <div class="profile-action">
        <p>My Account</p>
        <i class="bx bx-x close-side-nav" id="close-side-nav"></i>
    </div>
    <div class="profile-account">
        <div class="profile-initial">
            <span><?php echo substr($fullName, 0, 2); ?></span>
        </div>
        <div class="profile-account-info">
            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white"><?php echo $fullName; ?></h5>
            <span class="text-sm text-gray-500 dark:text-gray-400"><?php echo $idNumber; ?></span>
        </div>
    </div>
    <p class="text-lg text-start ml-1">
        <span class="text-gray-900">
            <i class='bx bx-phone mr-1'></i>
            <span class="phone-display"><?php echo $phoneNumber; ?></span>
        </span>
    </p>
    <p class="text-lg text-start ml-1">
        <span class="text-gray-900">
            <i class='bx bx-envelope mr-1'></i>
            <span class="email-display"><?php echo $email; ?></span>
        </span>
    </p>
    <p class="text-lg text-start ml-1">
        <span class="text-gray-900">
            <i class='bx bx-medal mr-1'></i>
            <?php echo $level; ?>
        </span>
    </p>
    <p class="text-lg text-start ml-1">
        <span class="text-gray-900">
            <i class='bx bx-map mr-1'></i>
            <?php echo $city; ?>
        </span>
    </p>
    <div class="flex mt-4 md:mt-6">
        <button onclick="EditProfileModal()"
            class="mb-2 w-full py-2 px-4 text-center text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 profile-edit">Profile Edit<i
                class='bx bx-pencil ml-1'></i></button>
        <button onclick="logout()"
            class="text-red-500 ml-2 mb-2 w-full py-2 px-4 text-center text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Logout<i
                class='bx bx-log-in-circle text-red-500 ml-1'></i></button>
    </div>
</div>

<!-- Edit Profile Modal -->
<div id="edit-profile-modal" class="edit-profile-modal">
    <div class="edit-profile-modal-content">
        <div class="container flex justify-center items-center">
            <i class="bx bx-x absolute top-2 md:top-0 right-10 ml-16 close-modal" onclick="closeEditModal()"></i>
            <div class="w-full max-w-md p-4 bg-white border border-gray-200 rounded-sm shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
                <form class="space-y-6" action="update_profile.php" method="POST" id="edit-profile-form">
                    <h5 class="text-xl font-medium text-gray-900 dark:text-white">Edit Profile</h5>
                    <div>
                        <label for="fullName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full Name</label>
                        <input type="text" name="fullName" id="fullName"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            placeholder="Enter your full name" value="<?php echo $fullName; ?>" required />
                    </div>
                    <div>
                        <label for="phoneNumber" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone Number</label>
                        <input type="tel" name="phoneNumber" id="phoneNumber"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            placeholder="Enter your phone number" value="<?php echo $phoneNumber; ?>" required />
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email Address</label>
                        <input type="email" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            placeholder="Enter your email address" value="<?php echo $email; ?>" required />
                    </div>
                    <div>
                        <label for="level" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Level</label>
                        <select id="level" name="level"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                            <option value="beginner" <?php echo $level === 'beginner' ? 'selected' : ''; ?>>Beginner</option>
                            <option value="intermediate" <?php echo $level === 'intermediate' ? 'selected' : ''; ?>>Intermediate</option>
                            <option value="advanced" <?php echo $level === 'advanced' ? 'selected' : ''; ?>>Advanced</option>
                        </select>
                    </div>
                    <div>
                        <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City</label>
                        <input type="text" name="city" id="city"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            placeholder="Enter your city" value="<?php echo $city; ?>" required />
                    </div>
                    <button type="submit"
                        class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save Changes</button>
                </form>
            </div>
        </div>  
    </div>
</div>
