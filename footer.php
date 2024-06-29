<footer class="bg-white mt-16 dark:bg-gray-800">
    <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">

      <a href="/" class="flex justify-center items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
        <img src="./assets/logo/tennis_connect_club-transparant.png" class="h-8" alt="Tennis Connect Club" />
      </a> 
      <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2024 <a href="/"
          class="hover:underline">Tennis Connect Club</a>. All Rights Reserved.
      </span>
    </div>
  </footer>
  

  <script>
    document
      .getElementById("user-account")
      .addEventListener("click", function (event) {
        event.preventDefault();
        var profileModels = document.getElementById("profile-modal");
        profileModels.style.display = "block";
      });
   
    document
      .getElementById("close-side-nav")
      .addEventListener("click", function (event) {
        event.preventDefault();
        var profileModels = document.getElementById("profile-modal");
        profileModels.style.display = "none";
      });

    function EditProfileModal() {
      var editProfileModal = document.getElementById("edit-profile-modal");
      editProfileModal.style.display = "block";
      var profileModels = document.getElementById("profile-modal");
      profileModels.style.display = "none";
    }

    function closeEditModal() {
      var editProfileModal = document.getElementById("edit-profile-modal");
      editProfileModal.style.display = "none";
    }

    window.onclick = function (event) {
      var editProfileModal = document.getElementById("edit-profile-modal");
      if (event.target == editProfileModal) {
        editProfileModal.style.display = "none";
      }
    }
  </script>
  
<script>
function logout() {
  // Send an AJAX request to logout.php or whichever endpoint you use to handle logout
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'logout.php', true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        // Redirect to the login page or any other page after logout
        window.location.href = 'signin.php';
      } else {
        console.error('Logout failed');
      }
    }
  };
  xhr.send();
}
</script>
  <script src="./js/index.js"></script>
  <script src="./js/profile.js"></script>
  <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

</body>
</html>