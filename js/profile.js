    $(document).ready(function() {
        $('#edit-profile-form').submit(function(event) {
            event.preventDefault(); // Prevent form submission
            
            var formData = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: 'update_profile.php', 
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        showSuccessMessage(response.message);
                    } else {
                        showErrorMessage(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    showErrorMessage('An error occurred while processing your request.');
                    console.error(xhr.responseText);
                }
            });
        });
    });

    function showSuccessMessage(message) {
        var successMessage = $('#success-message');
        successMessage.text(message).removeClass('hidden');
        setTimeout(function() {
            successMessage.addClass('hidden');
        }, 5000); 
    }

    function showErrorMessage(message) {
        var errorMessage = $('#error-message');
        errorMessage.text(message).removeClass('hidden');
        setTimeout(function() {
            errorMessage.addClass('hidden');
        }, 5000); 
    }
