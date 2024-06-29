document.addEventListener('DOMContentLoaded', function () {
    document.getElementById("coachSearchForm").addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent the default form submission behavior

        // Retrieve form data
        const formData = new FormData(document.getElementById("coachSearchForm"));

        // Make a POST request to the PHP script
        fetch('search_coaches.php', {
            method: 'POST',
            body: formData // Pass form data as the request body
        })
            .then(response => {
                if (!response.ok) {

                    throw new Error('Network response was not ok');
                }
                return response.json(); // Parse the JSON response
            })
            .then(data => {
                // Clear previous search results
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

                    // Iterate over each court in the received data
                    data.forEach(court => {
                        // Create HTML elements to display court information
                        const courtElement = document.createElement('div');
                        courtElement.classList.add('court', 'w-full', 'max-w-sm', 'bg-white', 'border', 'border-gray-200', 'pb-0', 'rounded-t-sm', 'shadow', 'dark:bg-gray-800', 'dark:border-gray-700');
                        courtElement.innerHTML = `
                    <a href="#">
                        <img class="rounded-t-lg" src="https://images.pexels.com/photos/1432039/pexels-photo-1432039.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="product image" />
                    </a>
                    <div class="p-2.5">
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">${court.coach_name}</p>
                        <div class="flex items-center pb-1 justify-between text-center">
                            <p class="text-sm text-center">
                                <span class="text-sm text-gray-900 flex items-center justify-center">
                                    <i class='bx bx-buildings mr-1'></i>
                                    ${court.city}
                                </span>
                            </p>
                            <p class="text-sm text-center">
                            <span class="text-sm text-gray-900 flex items-center justify-center">
                            <i class='bx bx-phone mr-1'></i>
                                ${court.coach_phone_number}
                            </span>
                        </p>
                        </div>
                        <div class="flex items-center pb-1 justify-between text-center">
                            <p class="text-sm text-center">
                                <span class="text-xs text-gray-900 flex items-center justify-center">
                                    <i class='bx bx-time mr-1 text-sm'></i>
                                    ${court.open_dates_times}
                                </span>
                            </p>
                            
                        </div>
                        
                        <div class="flex items-center pb-1 justify-between text-center pt-2">
                            <span class="text-3xl font-bold text-gray-900 dark:text-white">$${court.price}</span>
                            <button id="continueToAdd" class="book-now-btn text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-1 text-center" data-court-name="${court.coach_name}" data-court-price="${court.price}">Book Now</button>
                            </div>
                    </div>
                `;
                        searchResultsDiv.appendChild(courtElement); // Append the created court element to the search results div
                    });
                    // Add event listeners to all "Book Now" buttons
                    document.querySelectorAll('.book-now-btn').forEach(button => {
                        button.addEventListener('click', function (event) {
                            const courtName = event.target.getAttribute('data-court-name');
                            const courtPrice = event.target.getAttribute('data-court-price');
                            event.target.innerHTML = `  <svg aria-hidden="true" role="status" class="w-4 h-4 me-3 m-0 text-gray-200 animate-spin dark:text-gray-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#22D3EE"/>
                                    </svg>
                                 `;

                            continueToPayment(courtName, courtPrice);
                        });
                    });
                    document.querySelector('.search-results').style.display = 'flex';
                
            })
            .catch(error => {
                console.error('Error:', error);
                // Display an error message to the user if the fetch request fails
                const searchResultsDiv = document.getElementById("searchResults");
                searchResultsDiv.innerHTML = '<p class="text-red-500">An error occurred while fetching search results. Please try again later.</p>';
                searchResultsDiv.style.display = 'block'; // Ensure the search results container is visible even if there's an error
            });
    });
});



function continueToPayment(courtName, courtPrice) {
    fetch('create_order.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            court_name: courtName,
            price: courtPrice
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.approvalUrl) {
            const approvalUrl = new URL(data.approvalUrl);
            approvalUrl.searchParams.append('court_name', courtName);
            approvalUrl.searchParams.append('price', courtPrice);
            window.location.href = approvalUrl.href;
        } else {
            console.error('Error creating PayPal order:', data.error);
        }
    })
    .catch(error => {
        console.error('Fetch error:', error);
    });
}
