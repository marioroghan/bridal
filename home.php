<?php
session_start();
include "db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bridal Gallery</title>
    <style>
        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f7f7f7;
            margin-top: 0px; /* Added space for sticky header */
        }

        /* Header Section */
        .header {
            display: flex;
            justify-content: space-between;
            background-color: #3a3a3a;
            padding: 15px;
            position: sticky; /* Change position to sticky */
            top: 0; /* Ensure it stays at the top of the page */
            left: 0;
            right: 0;
            z-index: 100; /* Keeps the header above other content */
        }


        .logo-container {
            display: flex;
        }

        .logo {
            width: 50px;
            height: auto;
            margin-right: 10px;
            
        }

        h1 {
            color: #fff;
            font-size: 2.3rem;
            align-items: center;
        }

        /* Navigation */
        .navbar {
            position: absolute;
            top: 60px;
            left: 0;
            right: 0;
            background-color: transparent;
            display: none; /* Hide by default */
            flex-direction: column;
            padding: 15px;
            
        }

        .navbar.show {
            display: flex; /* Show when toggled */
        }

        .navbar ul {
            list-style-type: none;
            width: 100%;
            text-align: right;
        }

        .navbar ul li {
            margin: 10px 0;
        }

        .navbar a {
            color: #020202;
            text-decoration: none;
            font-size: 1.5rem;
            padding: 10px;
            display: block;
        }

        /* Hamburger Icon - Always Visible */
        .menu-icon {
            display: block;
            font-size: 2rem;
            color: #fff;
            cursor: pointer;
        }
        /*greeting message*/
        .content {
            padding: 30px;
            text-align: left;
            margin-left: 10px;
        }

        #greeting-message {
            font-size: 2.5rem;
            color: #333;
            margin-top: 10px;
        }

        /* Offer Section */
        .offer {
            background-color: #f4e1d2;
            padding: 20px;
            text-align: center;
            margin-top: 20px;
        }

        .offer-container h2 {
            font-size: 2rem;
            color: #333;
        }
        /* New Section */
.new-section {
    text-align: center;
    padding: 30px 20px;
    background-color: #fff;
    margin: 20px 0;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}

.new-section h2 {
    font-size: 2rem;
    color: #333;
    margin-bottom: 10px;
}

.new-section p {
    font-size: 1.2rem;
    color: #555;
    margin-bottom: 20px;
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
}

.new-section .image-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 15px;
    margin-top: 20px;
}

.new-section .image-grid img {
    width: 100%;
    height: 350px; /* Fixed height for all images */
    object-fit: cover; /* Ensures aspect ratio is maintained without stretching */
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.new-section .image-grid img:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

        /* Celebrity Gallery Section */
        .celebrity-gallery {
            text-align: center;
            margin: 30px 0;
            overflow: hidden;
            position: relative;
            background-color: #fff;
            padding: 10px;
        }

        .celebrity-gallery h2 {
            padding: 20px;
            color: #000000;
        }

        .slider-container {
            width: 100%;
            overflow: hidden;
            position: relative;
        }

        .slider {
            display: flex;
            transition: transform 1s ease-in-out;
            width: calc(100% * 3);
        }

        .slider img {
            width: calc(20% / 3);
            height: 80vh;
            flex-shrink: 0;
            border-radius: 10px;
            margin: 0;
        }

        /* Navigation Buttons */
        .prev, .next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            border: none;
            padding: 10px;
            cursor: pointer;
            font-size: 1.5rem;
            border-radius: 50%;
        }

        .prev {
            left: 10px;
        }

        .next {
            right: 10px;
        }

        .prev:hover, .next:hover {
            background-color: #000;
        }

        /* New Arrivals Section */
.new-arrivals {
    text-align: center;
    padding: 20px;
}

.image-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 15px;
}

.image-grid img {
    width: 100%;
    height: 200px; /* Set a fixed height for uniformity */
    object-fit: cover; /* Ensures aspect ratio is maintained without stretching */
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.image-grid img:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}
.wide-range {
            text-align: center;
            padding: 20px;
            background-color: #fff;
        }

        .collection-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .collection-item {
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .collection-item a {
            text-decoration: none;
            color: #333;
        }

        .collection-item img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .collection-item p {
            margin-top: 10px;
            font-size: 1.1rem;
            font-weight: bold;
        }

        .collection-item:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Budget Collection Section */
        .budget-collection {
            text-align: center;
            padding: 20px;
            background-color: #e4b7b2;
        }

        .budget-gallery {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .budget-gallery img {
            width: 23%;
            border-radius: 10px;
        }

        /* Achievements Section */
        .achievement-section {
            display: flex;
            justify-content: space-between;
            width: 100vw;
            height: 50vh;
            padding: 20px;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .achievement-section h2{
            text-align: center;
        }

        .achievement-section img {
            width: 20vw; /* 20% of viewport width */
            height: auto;
            max-height: 40vh; /* Prevents overly large images */
            object-fit: cover;
            border-radius: 10px;
        }

        .achievement-details {
            flex: 1;
            padding: 0 40px;
        }
        .achievements h2{
            text-align: center;
            font-size: 2rem;
        }

        .achievement-title1 {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 10px;
            left: 20px;
        }

        .achievement-description1 {
            font-size: 1.2rem;
            color: #555;
            left: 20px;
        }
        .achievement-title2 {
            position: absolute;
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 10px;
            right: 300px;
        }

        .achievement-description2 {
            position: absolute;
            font-size: 1.2rem;
            color: #555;
            left: 32%;
            margin-top: 5%;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .achievement-section {
                flex-direction: column;
                text-align: center;
                padding: 20px;
            }

            .achievement-section img {
                width: 60vw; /* Adjust image width for mobile */
                max-height: 40vh;
                margin-bottom: 10px;
            }

            .achievement-details {
                padding: 20px;
            }
        }
        /* About Us Section */
        .aboutus-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100vw;
            height: 50vh;
            padding: 20px;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            flex-wrap: wrap;

        }
        .aboutus h2{
            text-align: center;
            font-size: 2rem;
            padding: 20PX;
        }

        .aboutus-section img {
            width: 20vw; /* 20% of viewport width */
            height: auto;
            max-height: 40vh; /* Prevents overly large images */
            object-fit: cover;
            border-radius: 10px;
        }

        .aboutus-details {
            flex: 1;
            text-align: center;
            padding: 0 40px;
        }

        .aboutus-title {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .aboutus-description {
            font-size: 1.2rem;
            color: #555;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .aboutus-section {
                flex-direction: column;
                text-align: center;
                padding: 20px;
            }

            .aboutus-section img {
                width: 60vw; /* Adjust image width for mobile */
                max-height: 40vh;
                margin-bottom: 10px;
            }

            .aboutus-details {
                padding: 20px;
            }
        }
        #search-container {
            display: none;
            position: absolute;
            top: 100px;
            right: 500px;
            background: white;
            padding: 10px;
            border: 1px solid #ccc;
            z-index: 1000;
        }
        #search-results {
            display: none;
            border: 1px solid #ccc;
            max-width: 200px;
            background: white;
            position: absolute;
            z-index: 1000;
        }
        #search-results div {
            padding: 10px;
            cursor: pointer;
        }
        #search-results div:hover {
            background: #f0f0f0;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <header class="header">
        <div class="logo-container">
            <img src="WhatsApp Image 2025-01-05 at 10.33.17 PM.jpeg" alt="Bridal Gallery Logo" class="logo">
            <h1>   Bridal Gallery Trichy Rental Jewellery</h1>
        </div>
        <nav class="navbar">
            <ul>
                <li><a href="home.html">Home</a></li>
                <li><a href="categories.html">Category</a></li>
                <li><a href="#" onclick="toggleSearch()">Search</a></li>
                <li><a href="review.html">Review</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Bride's Gallery</a></li>
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
    <div id="search-container">
        <input type="text" id="search-bar" placeholder="Search jewelry..." onkeyup="searchJewelry()">
        <div id="search-results"></div>
    </div>
    
    <script>
        function toggleSearch() {
            let searchContainer = document.getElementById("search-container");
            searchContainer.style.display = searchContainer.style.display === "block" ? "none" : "block";
        }

        const jewelryCategories = {
            "bangles": "bangles.html",
            "chocker": "chokers.html",
            "mat": "mat.html",
            "white-stones": "white-stones.html",
            "ad": "ad.html",
            "nagas": "nagas.html",
            "victorian": "victorian.html"
        };
        
        function searchJewelry() {
            let input = document.getElementById("search-bar").value.toLowerCase();
            let resultsDiv = document.getElementById("search-results");
            resultsDiv.innerHTML = "";
            resultsDiv.style.display = "none";
            
            if (input.length > 0) {
                let results = Object.keys(jewelryCategories).filter(category => category.includes(input));
                
                if (results.length > 0) {
                    resultsDiv.style.display = "block";
                    results.forEach(result => {
                        let div = document.createElement("div");
                        div.textContent = result;
                        div.onclick = function() {
                            window.location.href = jewelryCategories[result];
                        };
                        resultsDiv.appendChild(div);
                    });
                }
            }
        }
    </script>
    <div class="content">
        <div id="greeting-message"></div>
    </div>

    <script>
        // When the page loads, display the personalized greeting if a username is available
        document.addEventListener("DOMContentLoaded", () => {
            // Retrieve the username from localStorage
            const username = localStorage.getItem("username");

            // Check if the username exists
            if (username) {
                // Display the personalized greeting
                document.getElementById("greeting-message").innerHTML = `Hi ${username}, welcome to our shop!`;
            } else {
                // If no username is found, prompt the user to log in
                document.getElementById("greeting-message").innerHTML = "Please log in to access the shop.";
            }
        });
    </script>
    
   

    <!-- Offer Section -->
    <section class="offer">
        <div class="offer-container">
            <h2>New Year Offer - 20% off on All Bridal Jewelry!</h2>
            <p>Celebrate the New Year with stunning bridal jewelry. Limited time offer. Shop now!</p>
        </div>
    </section>

     <!-- New Section -->
     <section class="new-section">
        <h2>Exclusive Bridal Jewelry Showcase</h2>
        <p>Discover our handpicked collection of exquisite bridal jewelry, designed to make your special day unforgettable with us.</p>
        <div class="image-grid">
            <img src="Screenshot_20241210-234704_Instagram.jpg" alt="Jewelry 1">
            <img src="IMG_20240415_130819.jpg" alt="Jewelry 2">
            <img src="V1a.jpg" alt="Jewelry 6">
            <img src="699.jpg" alt="Jewelry 6">
        </div>
    </section>

    <!-- New Arrivals Section -->
    <section class="new-arrivals">
        <h2>New Arrivals</h2>
        <div class="image-grid">
            <img src="231.jpg" alt="New Arrival 1">
            <img src="406.jpeg" alt="New Arrival 2">
            <img src="1.jpg" alt="New Arrival 3">
            <img src="WhatsApp Image 2025-01-19 at 11.27.29 PM.jpeg" alt="New Arrival 4">
            <img src="20250114_201408.jpg" alt="New Arrival 5">
            <img src="559.jpg" alt="New Arrival 6">
            <img src="20250115_163931.jpg" alt="New Arrival 7">
            <img src="20250115_140553.jpg" alt="New Arrival 8">
            <img src="20250115_163257.jpg" alt="New Arrival 9">
            <img src="20250115_163812.jpg" alt="New Arrival 10">
            <img src="20250115_163516.jpg" alt="New Arrival 10">
            <img src="20250115_163931.jpg" alt="New Arrival 10">
        </div>
    </section>

    <!-- Wide Range of Collection Section -->
    <section class="wide-range">
        <h2>Wide Range of Collections</h2>
        <div class="collection-gallery">
            <div class="collection-item">
                <a href="chokers.html">
                    <img src="WhatsApp Image 2025-01-19 at 11.27.29 PM.jpeg" alt="Collection 1">
                    <p>Diamond Necklace</p>
                </a>
            </div>
            <div class="collection-item">
                <a href="Mat.html">
                    <img src="726.jpeg" alt="Collection 2">
                    <p>Elegent Gold Set</p>
                </a>
            </div>
            <div class="collection-item">
                <a href="nagas.html">
                    <img src="nag1.jpg" alt="Collection 3">
                    <p>Antique Bridal Set</p>
                </a>
            </div>
            <div class="collection-item">
                <a href="victorian.html">
                    <img src="V1a.jpg" alt="Collection 4">
                    <p>Pearl Jewelry</p>
                </a>
            </div>
            <div class="collection-item">
                <a href="collection5.html">
                    <img src="667.jpg" alt="Collection 5">
                    <p>Christian & Muslim weddings</p>
                </a>
            </div>
        </div>
    </section>

    <!-- Budget Collection Section -->
    <section class="budget-collection">
        <h2>Budget Collections</h2>
        <div class="budget-gallery">
            <img src="WhatsApp Image 2025-02-16 at 9.36.31 PM.jpeg" alt="Budget Collection 1">
            <img src="WhatsApp Image 2025-02-14 at 6.17.40 PM.jpeg" alt="Budget Collection 2">
            <img src="WhatsApp Image 2025-02-14 at 6.31.16 PM.jpeg" alt="Budget Collection 3">
            <img src="WhatsApp Image 2025-02-14 at 6.36.11 PM.jpeg" alt="Budget Collection 4">
        </div>
    </section>
    <!-- Celebrity Gallery Section -->
    <section class="celebrity-gallery">
        <h2>Influencer Gallery</h2>
        <div class="slider-container">
            <div class="slider">
                <img src="WhatsApp Image 2025-01-10 at 8.21.16 PM.jpeg" alt="Celebrity 7">
                <img src="WhatsApp Image 2025-01-05 at 11.00.51 PM (1).jpeg" alt="Celebrity 2">
                <img src="InShot_20241218_002616706.jpg" alt="Celebrity">
                <img src="InShot_20241218_002643251.jpg" alt="Celebrity 1">
                <img src="0U5A96235.jpg" alt="Celebrity 6">
                <img src="WhatsApp Image 2025-01-05 at 11.00.52 PM.jpeg" alt="Celebrity 4">
                <img src="IMG_4789.JPG" alt="Celebrate">
                <img src="BP014904.jpg" alt="Celebrate">
                <img src="0U5A0323.jpg" alt="Celebrate">
                <img src="WhatsApp Image 2025-01-05 at 11.00.53 PM.jpeg" alt="Celebrity 5">
                <img src="IMG_0894 copy 2.jpg" alt="Celebrate">
                <img src="InShot_20241218_002333239.jpg" alt="Celebrity ">
                <img src="WhatsApp Image 2025-01-05 at 11.00.54 PM.jpeg" alt="Celebrate">
            </div>
            <button class="prev">❮</button>
            <button class="next">❯</button>
        </div>
    </section>

    <!-- Achievements Section -->
    <section class="achievements">
        <h2>Our Achievements</h2>
        <div class="achievement-section">
            <!-- Left Image -->
            <img src="20250105_160354 (2).jpg" alt="Left Achievement Image">
    
            <!-- Center Details -->
            <div class="achievement-details">
                <div class="achievement-title1"> Favourite Artificial Jewelry</div>
                <div class="achievement-description1">Winner of Favourite Artificial Jewelry in Trichy Business & Startup Awards.</div>
                <br>
                <div class="achievement-title2">Diamond Achiever </div>
                <div class="achievement-description2">Got a Diamond Achiever Award from Rhythm's Beauty Academy, Chennai</div>
            </div>
    
            <!-- Right Image -->
            <img src="WhatsApp Image 2025-02-16 at 11.39.54 PM.jpeg" alt="Right Achievement Image">
        </div>
    </section>

    <!-- About Us Section -->
    <section class="aboutus">
        <h2>About us </h2>
        <div class="aboutus-section">
            <!-- Left Image -->
            <img src="WhatsApp Image 2025-02-17 at 6.35.51 AM.jpeg" alt="Left Achievement Image">
    
            <!-- Center Details -->
            <div class="aboutus-details">
                <div class="aboutus-title"> Trichy Rental Jewellery </div>
                <div class="aboutus-description">Sivam Towers, WB Road,Above HDFC Bank, Singarathope, Tiruchirappali, Tamil Nadu 620008</div>
                <br>
                <div class="aboutus-title">Contact Us On </div>
                <div class="aboutus-description">7373736403</div>
            </div>
            <!-- Right Image -->
            <img src="DCM_8065.JPG" alt="Right Achievement Image">
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const slider = document.querySelector(".slider");
            const slides = document.querySelectorAll(".slider img");
            const prevButton = document.querySelector(".prev");
            const nextButton = document.querySelector(".next");

            let currentIndex = 0;
            const itemsPerGroup = 3;
            const totalGroups = Math.ceil(slides.length / itemsPerGroup);

            slider.style.width = `${totalGroups * 100}%`;

            const updateSliderPosition = () => {
                slider.style.transform = `translateX(-${(currentIndex * 100) / totalGroups}%)`;
            };

            let autoSlide = setInterval(() => {
                currentIndex = (currentIndex + 1) % totalGroups;
                updateSliderPosition();
            }, 5000);

            const goToNextSlide = () => {
                clearInterval(autoSlide);
                currentIndex = (currentIndex + 1) % totalGroups;
                updateSliderPosition();
            };

            const goToPrevSlide = () => {
                clearInterval(autoSlide);
                currentIndex = (currentIndex - 1 + totalGroups) % totalGroups;
                updateSliderPosition();
            };

            nextButton.addEventListener("click", goToNextSlide);
            prevButton.addEventListener("click", goToPrevSlide);
        });

        // Handle sticky header visibility on scroll
        let lastScrollTop = 0;
        window.addEventListener("scroll", function() {
            let header = document.querySelector(".header");
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            if (scrollTop > lastScrollTop) {
                header.style.top = "-70px"; // hide header on scroll down
            } else {
                header.style.top = "0"; // show header on scroll up
            }
            lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
        });
    </script>

</body>
</html>
