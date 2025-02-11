document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.getElementById("search-input");
    const searchButton = document.getElementById("search-button");
    const reviewsGrid = document.querySelector(".reviews-grid");

    // Function to fetch filtered reviews based on search input
    const fetchFilteredReviews = async (searchTerm) => {
        const response = await fetch(`/reviews?search=${encodeURIComponent(searchTerm)}`);
        if (response.ok) {
            const data = await response.json(); // Assuming your server returns JSON data
            updateReviewsGrid(data.reviews);
        } else {
            console.error("Failed to fetch reviews");
        }
    };

    const updateReviewsGrid = (reviews) => {
        reviewsGrid.innerHTML = ''; // Clear existing reviews
        if (reviews.length > 0) {
            reviews.forEach(review => {
                const reviewElement = document.createElement("div");
                reviewElement.classList.add("review-container");

                reviewElement.innerHTML = `
                    <h3>${review.userNickname}</h3>
                    <a href="review?id=${encodeURIComponent(review.reviewID)}">
                        ${review.image ? `<img class="poster" src="public/uploads/${review.image}" alt="Review Image">` : ''}
                        <h1>${review.title}</h1>
                        <div class="stars">${review.stars}</div>
                        <h3>${review.reviewTitle}</h3>
                        <p class="review-description">${review.description}</p>
                    </a>
                `;
                reviewsGrid.appendChild(reviewElement);
            });
        } else {
            reviewsGrid.innerHTML = `<p style="text-align: center; width: 100%;">No reviews found for this search.</p>`;
        }
    };

    // Event listener for the search button
    searchButton.addEventListener("click", () => {
        const searchTerm = searchInput.value.trim();
        fetchFilteredReviews(searchTerm);
    });

    // Trigger the fetch when the user starts typing (optional)
    searchInput.addEventListener("input", () => {
        const searchTerm = searchInput.value.trim();
        fetchFilteredReviews(searchTerm);
    });
});
