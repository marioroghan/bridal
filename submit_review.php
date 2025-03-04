<?php
// Database connection
$servername = "localhost";
$username = "root"; // Change if needed
$password = "ecc123"; // Change if needed
$database = "bridal_gallery"; // Change this to your actual database name

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



// Insert data into database
$sql = "INSERT INTO reviews (website_useful, star_rating, suggestion) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sis", $website_useful, $star_rating, $suggestion);

if ($stmt->execute()) {
    echo "<script>alert('Review submitted successfully!'); window.location.href='review.html';</script>";
} else {
    echo "Error: " . $conn->error;
}

// Close connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review & Comment</title>
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    background-color: #f7f7f7;
    margin: 0;
    padding: 0;
}

/* Header */
.header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: #3a3a3a;
    padding: 15px 20px;
    position: sticky;
    top: 0;
    left: 0;
    right: 0;
    z-index: 100;
}

.logo-container {
    display: flex;
    align-items: center;
}

.logo {
    width: 50px;
    height: auto;
    margin-right: 10px;
}

h1 {
    color: #fff;
    font-size: 1.8rem;
}

/* Navigation */
.navbar {
    display: none; /* Hide by default on small screens */
    flex-direction: column;
    position: absolute;
    top: 60px;
    left: 0;
    right: 0;
    background-color: #3a3a3a;
    padding: 10px;
}

.navbar.show {
    display: flex; /* Show when toggled */
}

.navbar ul {
    list-style: none;
    text-align: center;
}

.navbar ul li {
    margin: 10px 0;
}

.navbar a {
    color: #fff;
    text-decoration: none;
    font-size: 1.2rem;
    padding: 10px;
    display: block;
}

.menu-icon {
    display: block;
    font-size: 2rem;
    color: #fff;
    cursor: pointer;
}

/* Review Container */
.review-container {
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    width: 90%;
    max-width: 500px;
    text-align: center;
    margin: 40px auto;
}

.greeting {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 15px;
    color: #292728;
}

.question {
    font-size: 18px;
    margin: 15px 0;
    font-weight: bold;
}

/* Radio Buttons */
.radio-group {
    margin: 10px 0;
}

.radio-group label {
    margin: 0 10px;
    font-size: 16px;
}

/* Star Rating */
.star-rating {
    display: flex;
    justify-content: center;
    gap: 5px;
    margin: 15px 0;
}

.star-rating input {
    display: none;
}

.star-rating label {
    font-size: 35px;
    color: #ccc;
    cursor: pointer;
    transition: color 0.2s;
}

.star-rating input:checked ~ label,
.star-rating label:hover,
.star-rating label:hover ~ label {
    color: gold;
}

/* Textarea */
textarea {
    width: 100%;
    height: 100px;
    margin-top: 10px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    resize: none;
    font-size: 16px;
}

/* Submit Button */
button {
    background-color: #242323;
    color: white;
    font-size: 18px;
    border: none;
    padding: 12px;
    margin-top: 15px;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
    transition: background 0.3s ease-in-out;
}

button:hover {
    background-color: #575757;
}

/* Responsive Design */
@media (max-width: 768px) {
    h1 {
        font-size: 1.5rem;
    }

    .review-container {
        width: 95%;
        padding: 20px;
    }

    .star-rating label {
        font-size: 30px;
    }

    .menu-icon {
        font-size: 1.8rem;
    }

    .navbar ul {
        text-align: left;
        padding-left: 20px;
    }
}

    </style>
</head>
<body>
    <!-- Header Section -->
    <header class="header">
        <div class="logo-container">
            <img src="WhatsApp Image 2025-01-05 at 10.33.17 PM.jpeg" alt="Bridal Gallery Logo" class="logo">
            <h1>Bridal Gallery Trichy Rental Jewellery</h1>
        </div>
        <nav class="navbar">
            <ul>
                <li><a href="home.html">Home</a></li>
                <li><a href="categories.html">Category</a></li>
                <li><a href="#" onclick="toggleSearch()">Search</a></li>
                <li><a href="review.html">Review</a></li>
                <li><a href="bridal_sgallery.html">Bride's Gallery</a></li>
            </ul>
        </nav>
        <div class="menu-icon" onclick="toggleMenu()">☰</div>
    </header>
    <script>
        // Toggle menu visibility on small screens
        function toggleMenu() {
            const navbar = document.querySelector(".navbar");
            navbar.classList.toggle("show");
        }
        function toggleSearch() {
            const searchContainer = document.querySelector(".search-container");
            searchContainer.style.display = searchContainer.style.display === "block" ? "none" : "block";
        }
    </script>
   
   
    <form action="submit_review.php" method="POST">
    <div class="greeting">Hello, Mario</div>

    <div class="question">Is this website useful to you?</div>
    <div class="radio-group">
        <input type="radio" id="yes" name="useful" value="Yes" required>
        <label for="yes">Yes</label>
        <input type="radio" id="no" name="useful" value="No">
        <label for="no">No</label>
    </div>

    <div class="question">Kindly rate our website</div>
    <div class="star-rating">
        <input type="radio" id="star5" name="rating" value="5" required>
        <label for="star5">★</label>
        <input type="radio" id="star4" name="rating" value="4">
        <label for="star4">★</label>
        <input type="radio" id="star3" name="rating" value="3">
        <label for="star3">★</label>
        <input type="radio" id="star2" name="rating" value="2">
        <label for="star2">★</label>
        <input type="radio" id="star1" name="rating" value="1">
        <label for="star1">★</label>
    </div>

    <div class="question">Kindly share your suggestions and comments</div>
    <textarea name="suggestion" placeholder="Write your feedback here..." required></textarea>

    <button type="submit">Submit</button>
</form>

</body>
</html>
