<?php
$page_css = "css/signin.css";
include 'header.php';
?>
<div class="fixed top-2 right-6 mt-14 pt-16 m-auto z-50">
        <div id="success-message" class="hidden p-1.5 px-8 bg-green-300 text-black rounded-sm text-sm shadow-lg"></div>
        <div id="error-message" class="hidden p-1.5 px-8 bg-red-600 text-white mt-2 rounded-sm text-sm shadow-lg"></div>
    </div>
    <div class="container flex justify-center items-center">

        <div
            class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <form id="signin-form" class="space-y-6" action="signin_process.php" method="POST">
                <h5 class="text-xl font-medium text-gray-900 dark:text-white">Sign in to our platform</h5>
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                        email*</label>
                    <input type="email" name="email" id="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        placeholder="Enter your Email Id" required />
                </div>

                <div class="relative">
                    <label for="password"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password*</label>

                    <input type="password" name="password" id="password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        placeholder="Enter your password" required />
                    <div class="absolute inset-y-0 right-2 mt-8 mr-1 text-lg flex items-center pr-3 cursor-pointer"
                        onclick="togglePassword()">
                        <i class="bx bx-show text-gray-500 hover:text-blue-500" id="show-password-icon"
                            style="display: none;"></i>
                        <i class="bx bxs-hide text-gray-500 hover:text-blue-500" id="hide-password-icon"></i>
                    </div>
                </div>

                <button type="submit"
                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login
                    to your account</button>
                <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                    Not registered? <a href="signup.php" class="text-blue-700 hover:underline dark:text-blue-500">Create
                        account</a>
                </div>
            </form>
        </div>
    </div>
<script src="./js/signin.js"></script>
<?php include 'footer.php'; ?>