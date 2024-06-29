document.addEventListener('DOMContentLoaded', function() {
    document.getElementById("searchGameForm").addEventListener("submit", function(event) {
        event.preventDefault();

        const formData = new FormData(document.getElementById("searchGameForm"));

        fetch('search_game_partners.php', {
            method: 'POST',
            body: formData 
        })
        .then(response => {
            if (!response.ok) {
                
                throw new Error('Network response was not ok');
            }
            return response.json(); 
        })
        .then(data => {
            const searchResultsDiv = document.getElementById("searchResults");
            searchResultsDiv.innerHTML = '';

            if (data.length === 0) {
                searchResultsDiv.innerHTML = `
                <p>No results found for your search, try searching again.</p>
                <button id="returnToSearch" class="text-center text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-1 text-center">Return to Search</button>
            `;
            document.getElementById("returnToSearch").addEventListener('click', function() {
                document.getElementById("searchResults").innerHTML = '';
                document.getElementById("searchForm").reset();
            });
            }
                data.forEach(gamePartner => {
                    const courtElement = document.createElement('div');
                    courtElement.classList.add('court', 'w-full', 'max-w-sm', 'bg-white', 'border', 'border-gray-200', 'pb-0', 'rounded-t-sm', 'shadow', 'dark:bg-gray-800', 'dark:border-gray-700');
                    courtElement.innerHTML =`
                        <div class="p-2.5">
                        <p class="text-lg font-semibold text-gray-900 dark:text-white"> ${gamePartner.full_name}</p>
                        <div class="flex items-center pb-1 justify-between text-center mt-1">
                            <p class="text-sm text-center">
                                <span class="text-sm  text-gray-900 flex items-center justify-center">
                                    <i class='bx bx-phone mr-1'></i>
                                    ${gamePartner.phone_number}
                                </span>
                            </p>
                
                            <p class="text-sm text-center">
                                <span class="text-sm  text-gray-900 flex items-center justify-center">
                                    <i class='bx bx-envelope mr-1'></i>${gamePartner.email}
                                </span>
                            </p>
                        </div>
                
                        <div class="flex items-center pb-1 justify-between text-center">
                            <p class="text-sm text-center">
                                <span class="text-sm  text-gray-900 flex items-center justify-center">
                                    <i class='bx bx-tennis-ball mr-1'></i>${gamePartner.level_of_play}
                                </span>
                            </p>
                        </div>
                        <div class="flex items-center pb-1 justify-between text-center pt-2">
                        <button class="add-to-partner text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-1 text-center" id="addToMyPartners" onclick="addToMyPartners('${gamePartner.full_name}', '${gamePartner.phone_number}', '${gamePartner.email}', '${gamePartner.level_of_play}')"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-5 py-1 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add to My Partners</button>
                    <button onclick="sendMessage('${gamePartner.full_name}', '${gamePartner.phone_number}')"
                        class="py-2 px-4 ms-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Message</button>
                           
                        </div>
                    </div>
                </div>
                    `;
                    searchResultsDiv.appendChild(courtElement);
                });
                document.querySelector('.search-results').style.display = 'flex';
            
          
        })
        .catch(error => {
            console.error('Error:', error);
            const searchResultsDiv = document.getElementById("searchResults");
            searchResultsDiv.innerHTML = '<p class="text-red-500">An error occurred while fetching search results. Please try again later.</p>';
            searchResultsDiv.style.display = 'block'; 
        });
    });
});
function addToMyPartners(fullName, phoneNumber, email, levelOfPlay) {
    const formData = new FormData();
    formData.append('full_name', fullName);
    formData.append('phone_number', phoneNumber);
    formData.append('email', email);
    formData.append('level_of_play', levelOfPlay);

    fetch('add_my_partner.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        var successMessageElement = document.getElementById('success-message');
        var errorMessageElement = document.getElementById('error-message');
        if (data.success) {
            successMessageElement.innerHTML = data.message;
            successMessageElement.classList.remove('hidden');
            errorMessageElement.classList.add('hidden');
        } else {
            errorMessageElement.innerHTML = data.message;
            errorMessageElement.classList.remove('hidden');
            successMessageElement.classList.add('hidden');
        }
        setTimeout(function() {
            successMessageElement.classList.add('hidden');
            errorMessageElement.classList.add('hidden');
        }, 5000); 
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while adding the partner. Please try again later.');
    });
}

    
    function sendMessage(fullName, phoneNumber) {
        const message = `Hello ${fullName}, I would like to connect for a game.`;
        const whatsappUrl = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;
        window.open(whatsappUrl, '_blank');
    }