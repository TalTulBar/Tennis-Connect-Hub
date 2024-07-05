<?php
session_start();
$page_css = "css/find-game-partners.css";
include 'header.php';

include 'db_connection.php';

$sql = "SELECT DISTINCT city FROM players";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $cityDropdown = '<select id="city" name="city" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-cyan-50 focus:border-cyan-50 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">';
    
    while($row = $result->fetch_assoc()) {
        $cityDropdown .= '<option value="' . $row["city"] . '">' . $row["city"] . '</option>';
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
    <div
        class="container w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 dark:bg-gray-800 dark:border-gray-700">
        <img src=".\assets\images\find-partner.png" alt="" class="w-full h-52 pb-4">    
        <h1 class="text-xl font-medium text-gray-900 dark:text-white">
            Find Game Partnerss
        </h1>
        <form id="searchGameForm" action="search_game_partners.php" method="POST">
            <label for="city" class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white">City*:</label>
            <?php echo $cityDropdown; ?>
       
            <label for="level" class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white">Level of
                Play*:</label>
            <select id="level" name="level"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-cyan-50 focus:border-cyan-50 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                <option value="beginner">Beginner</option>
                <option value="advanced">Advanced</option>
                <option value="professional">Professional</option>
            </select>
            <label for="gameType" class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white">Game
                Type*:</label>
            <select id="gameType" name="gameType" 
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-cyan-50 focus:border-cyan-50 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                <option value="competitiveDoubles">Competitive Doubles</option>
                <option value="trainingDoubles">Training Doubles</option>
                <option value="competitiveSingles">Competitive Singles</option>
                <option value="trainingSingles">Training Singles</option>
            </select>

            <button type="submit"
                class="mt-6 bg-cyan-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-cyan-50 focus:border-cyan-50 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                Search
            </button>
        </form>
    </div>
    <div
        class="search-results hidden flex justify-center items-center flex-col my-0 w-full max-w-screen-md mx-auto p-4 bg-white sm:p-6 dark:bg-gray-800">
        <h2 class="mb-4 text-xl font-semibold text-center">Game Partner</h2>
        <div id="searchResults" class="flex justify-center items-center flex-col grid grid-cols-1  xl:grid-cols-3 gap-4">
    </div>
    </div>
<script src="./js/find_game_partners.js"></script>
<?php include 'footer.php'; ?>