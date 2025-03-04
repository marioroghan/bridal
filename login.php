<?php
// Start a session if you want to use session variables
session_start();

// Database connection variables
$servername = "localhost";
$usernameDB = "root";        // Change as per your database username
$passwordDB = "ecc123";            // Change as per your database password
$dbname = "bridal_gallery";        // Use your database name (e.g., "bridal_gallery")

// Create a connection
$conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form inputs
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    
    // Validate inputs (you can add more validations as needed)
    if (empty($name) || empty($email)) {
        echo "Please fill in both your name and email.";
        exit();
    }
    
    // Prepare and bind an SQL statement to avoid SQL injection
    $stmt = $conn->prepare("INSERT INTO users (username, email) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $email);
    
    // Execute the statement
    if ($stmt->execute()) {
        // Optionally, store the username in session for further usage
        $_SESSION['username'] = $name;
        
        // Redirect to the home page
        header("Location: home.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    
    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bridal Gallery - Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background: url('20250105_155217.jpg') center/cover no-repeat;
        }
        .header {
            width: 100%;
            color: #ffffff;
            padding: 15px 0;
            font-size: 34px;
            font-weight: bold;
            text-align: center;
            position: absolute;
            top: 0;
            left: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: transparent;
        }
        .header img {
            height: 50px;
            margin-right: 10px;
        }
        .login-container {
            background: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin-top: 50px;
            position: relative;
            z-index: 1;
            left: 200px;
        }
        .login-container h2 {
            margin-bottom: 15px;
            color: #ffffff;
        }
        input {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #505050;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #A88542;
            margin: 10px 0;
            color: rgb(26, 25, 25);
            border: 1px solid #505050;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background: #C9A96D ;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="Screenshot_20241218-200347_Logo Designer.jpg" alt="Bridal Gallery Logo">
        Bridal Gallery Trichy Rental Jewellery Shop
    </div>
    <div class="login-container">
        <h2>Welcome to Bridal Gallery</h2>
        <form id="login-form" method="post" action="login.php">
            <input type="text" id="name" name="name" placeholder="Enter Your Name" required>
            <input type="email" id="email" name="email" placeholder="Enter Your Email" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
