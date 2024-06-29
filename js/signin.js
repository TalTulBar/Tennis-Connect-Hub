document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('signin-form').addEventListener('submit', function(event) {
        event.preventDefault(); 

        var formData = new FormData(this);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', this.getAttribute('action'), true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); 

        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);

                    var successMessageElement = document.getElementById('success-message');
                    var errorMessageElement = document.getElementById('error-message');
                    if (response.success) {
                        console.log(response.success);
                        successMessageElement.innerHTML = response.message;
                        successMessageElement.classList.remove('hidden');

                        window.location  = "/"

                        document.getElementById("email").value = "";
                        document.getElementById("password").value = "";
                       
                    } else {
                        errorMessageElement.innerHTML = response.message;
                        errorMessageElement.classList.remove('hidden');
                    }
                    setTimeout(function() {
                        successMessageElement.classList.add('hidden');
                        errorMessageElement.classList.add('hidden');
                    }, 5000); 
                } else {
                    console.error('AJAX request failed');
                }
            }
        };

        xhr.send(formData);
    });
});


function togglePassword() {
    var passwordShowIcon = document.getElementById("show-password-icon");
    var passwordHideIcon = document.getElementById("hide-password-icon");

    var passwordInput = document.getElementById("password");
    
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        passwordShowIcon.style.display = "block";
        passwordHideIcon.style.display = "none";
    } else {
        passwordInput.type = "password";
        passwordShowIcon.style.display = "none";
        passwordHideIcon.style.display = "block";
    }
}

function toggleConfirmPassword() {
    var passwordShowIcon = document.getElementById("show-confirm-password-icon");
    var passwordHideIcon = document.getElementById("hide-confirm-password-icon");

    var confirmPasswordInput = document.getElementById("confirmPassword");
    
    if (confirmPasswordInput.type === "password") {
        confirmPasswordInput.type = "text";
        passwordShowIcon.style.display = "block";
        passwordHideIcon.style.display = "none";
    } else {
        confirmPasswordInput.type = "password";
        passwordShowIcon.style.display = "none";
        passwordHideIcon.style.display = "block";
    }
}

  
