document.addEventListener("DOMContentLoaded", function () {
    fetch('get_partners.php')
    .then(response => response.json())
    .then(partners => {
        const partnersListDiv = document.getElementById("partnersList");

        if (partners.length === 0) {
            partnersListDiv.innerHTML = "<p class='text-gray-600'>No partners added yet.</p>";
        } else {
            partners.forEach(partner => {
                partnersListDiv.innerHTML += `
                <div class="partner border p-4 mb-4 rounded-lg shadow-sm">
                    <h2 class="text-xl font-bold">${partner.full_name}</h2>
                    <p class="text-gray-600"><strong>Phone:</strong> ${partner.phone_number}</p>
                    <p class="text-gray-600"><strong>Email:</strong> ${partner.email}</p>
                    <p class="text-gray-600"><strong>Level:</strong> ${partner.level_of_play}</p>
                </div>
                `;
            });
        }
    })
    .catch(error => {
        console.error('Error fetching partners:', error);
        document.getElementById("partnersList").innerHTML = "<p class='text-red-500'>An error occurred while fetching partners. Please try again later.</p>";
    });
});