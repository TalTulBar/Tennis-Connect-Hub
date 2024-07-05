<?php
$page_css = "css/signup.css";
include 'header.php';

include 'db_connection.php';

$sql = "SELECT DISTINCT city_name FROM cities";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $cityDropdown = '<select id="city" name="city" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-cyan-50 focus:border-cyan-50 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">';
    
    while($row = $result->fetch_assoc()) {
        // Add an option for each city
        $cityDropdown .= '<option value="' . $row["city_name"] . '">' . $row["city_name"] . '</option>';
    }
    
    $cityDropdown .= '</select>';
} else {
    $cityDropdown = '<select id="city" name="city" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-cyan-50 focus:border-cyan-50 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"><option value="">No cities found</option></select>';
}

$conn->close();
?>

<div class="fixed top-2 right-6 mt-14 pt-16 m-auto z-50">
    <div id="success-message" class="hidden p-1.5 px-8 bg-green-300 text-black rounded-sm text-sm shadow-lg"></div>
    <div id="error-message" class="hidden p-1.5 px-8 bg-red-600 text-white mt-2 rounded-sm text-sm shadow-lg"></div>
  </div>
    <div class="container flex justify-center items-center">
        <div class="w-full max-w-md p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <form id="signup-form" class="space-y-6" action="signup_process.php" method="POST">
                <h5 class="text-xl font-medium text-gray-900 dark:text-white">Sign up to our platform</h5>
                <div>
                    <label for="id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID number*</label>
                    <input type="text" name="id" id="id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Enter your ID number (9 digits)" required />
                </div>
                <div>
                    <label for="fullName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full Name*</label>
                    <input type="text" name="fullName" id="fullName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Enter your full name" required />
                </div>
                <div>
                    <label for="phoneNumber" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone Number*</label>
                    <input type="tel" name="phoneNumber" id="phoneNumber" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Enter your phone number" required />
                </div>
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email Address*</label>
                    <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" required />
                </div>
                <div>
                <label for="gameType" class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white">Game
                Type*:</label>
            <select id="gameType" name="gameType" 
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-cyan-50 focus:border-cyan-50 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                <option value="competitiveDoubles">Competitive Doubles</option>
                <option value="trainingDoubles">Training Doubles</option>
                <option value="competitiveSingles">Competitive Singles</option>
                <option value="trainingSingles">Training Singles</option>
            </select>
                </div>
                <div>
                    <label for="level" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Level of Play*</label>
                    <select id="level" name="level" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                        <option value="">Select Level</option>
                        <option value="beginner">Beginner</option>
                        <option value="intermediate">Intermediate</option>
                        <option value="advanced">Advanced</option>
                    </select>
                </div>
                <div>
                    <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City*</label>
                    <?php echo $cityDropdown; ?> 
                </div>

                <div class="relative">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password*</label>
    <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Enter your password" required />
    <div class="absolute inset-y-0 right-2 mr-1 mt-8 text-lg flex items-center pr-3 cursor-pointer" onclick="togglePassword()">
        <i class="bx bx-show text-gray-500 hover:text-blue-500" id="show-password-icon" style="display: none;"></i>
        <i class="bx bxs-hide text-gray-500 hover:text-blue-500" id="hide-password-icon"></i>
    </div>
</div>
<div class="relative">
    <label for="confirmPassword" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm Password*</label>
    <input type="password" name="confirmPassword" id="confirmPassword" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Re-enter your password" required />
    <div class="absolute inset-y-0 mt-6 right-2 mr-1 text-lg flex items-center pr-3 cursor-pointer" onclick="toggleConfirmPassword()">
        <i class="bx bx-show text-gray-500 hover:text-blue-500 hidden" id="show-confirm-password-icon"></i>
        <i class="bx bxs-hide text-gray-500 hover:text-blue-500 " id="hide-confirm-password-icon"></i>
    </div>
</div>

                <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create Account</button>
                <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                    Already have an account? <a href="signin.php" class="text-blue-700 hover:underline dark:text-blue-500">Sign In</a>
                </div>
            </form>
        </div>
    </div>
    <script src="./js/signup.js"></script>
    <?php include 'footer.php'; ?>