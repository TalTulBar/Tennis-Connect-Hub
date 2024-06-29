<?php
$page_css = "css/find-coaches.css";
include 'header.php';

include 'db_connection.php';

$sql = "SELECT DISTINCT city FROM coaches";
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
    <div class="container w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 dark:bg-gray-800 dark:border-gray-700">
    <img src=".\assets\images\find-coach.png" alt="" class="w-full h-52 pb-1" >    
    <h1 class="text-xl font-medium text-gray-900 dark:text-white">Finding a Coach</h1>
    <form id="coachSearchForm" action="search_coaches.php" method="POST">
        <label for="city" class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white">City*:</label>
        <?php echo $cityDropdown; ?>

        <label for="date" class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white">Date*:</label>
        <input type="date" name="date" id="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-cyan-50 focus:border-cyan-50 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />

        <label for="level" class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white">Difficulty Level*:</label>
        <select id="level" name="level" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-cyan-50 focus:border-cyan-50 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
            <option value="beginner">Beginner</option>
            <option value="advanced">Advanced</option>
            <option value="professional">Professional</option>
        </select>

       <button type="submit" class="mt-6 bg-[#22D3EE] border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-cyan-50 focus:border-cyan-50 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">Search</button>
    </form>
</div>

    <div
        class="search-results hidden flex justify-center items-center flex-col my-0 w-full max-w-screen-md mx-auto p-4 bg-white sm:p-6 dark:bg-gray-800">
        <h2 class="mb-4 text-xl font-semibold text-center">Coach Trainner</h2>
        <div id="searchResults" class="flex justify-center items-center flex-col grid grid-cols-1  xl:grid-cols-3 gap-4">
    </div>
    </div>

<script src="./js/find_coaches.js"></script>

    <?php include 'footer.php'; ?>