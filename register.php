<?php
$host = "localhost"; // Database host
$username = "root";  // Database username
$password = "";      // Database password (leave empty if none)
$dbname = "bookstore_db"; // Database name you created in phpMyAdmin

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = ''; // Variable to store the message

// Handle registration form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];
    $phone_number = $_POST['phone_number'];
	$address = $_POST['address'];
    // Check if passwords match
    if ($password === $confirm_password) {
        // Use md5 to hash the password (for testing purposes)
        $hashed_password = md5($password);

        // Insert user into the database
        // Insert user into the database (including firstname and lastname)
$sql = "INSERT INTO users (firstname, lastname, username, password, gender, birthdate, phone_number, address) 
        VALUES ('$firstname', '$lastname', '$username', '$hashed_password', '$gender', '$birthdate', '$phone_number', '$address')";


        if ($conn->query($sql) === TRUE) {
            // Redirect to login page
            header("Location: login.php");
            exit; // Important to stop script execution after redirect
        } else {
            $message = "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $message = "Passwords do not match!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Uplift Bookstore</title>
    <style>
        /* Your existing styles here */
          body {
            font-family: 'Georgia', serif;
            background-color: #f4f0e6; 
            background-image: url('https://64.media.tumblr.com/c25d3b2f64c96184584b831fba6bb0e2/tumblr_oyfsbzUOey1r9co7bo1_1280.gifv'); /* Background image */
            background-size: cover; 
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
			background-color: rgba(74, 60, 49, 0.7); 
			backdrop-filter: blur(10px); 
			color: white;
			padding: 10px 20px;
			display: flex;
			align-items: center;
			height: 80px; 
			position: relative;
			z-index: 1;
			overflow: hidden; 
		}

		header h1 { 
			font-size: 24px;
			flex-grow: 2;
			text-align: center;
			line-height: 1; 
		}
		
        .container {
			background-color: rgb(225, 193, 110); 
			padding: 30px;
			border-radius: 10px;
			border: 2px solid rgba(139, 69, 19, 0.2); 
			box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1); 
			width: 400px; 
			margin: 35px auto; 
			text-align: center;
			z-index: 2;
			position: relative;
			backdrop-filter: blur(5px); 
        }

        h2 {
			margin-bottom: 25px;
			color: #4a3c31;
			font-size: 28px; 
			font-family: 'Georgia', serif; 
        }

       input[type="text"],
	   input[type="password"] {
			width: 90%; 
			padding: 15px;
			margin: 15px auto; 
			display: block; 
			border-radius: 8px;
			border: 1px solid #ccc;
			font-size: 16px;
			box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.1); 
        }

        input[type="submit"] {
			width: 100%;
			padding: 15px;
			background-color: #8b4513;
			color: white;
			border: none;
			border-radius: 8px;
			cursor: pointer;
			font-size: 18px; 
			transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #6a2e0f;
        }

        .message {
            margin: 20px 0;
            color: red;
            font-weight: bold;
        }

		.login-link {
			margin-top: 20px;
			font-size: 16px;
			color: #8b4513;
		}

		.login-link a {
			color: #8b4513;
			text-decoration: none;
		}

		.login-link a:hover {
			text-decoration: underline;
		}
		
            footer {
			background-color: #4a3c31;
            color: white;
            padding: 0.5px 15px;
            text-align: center;
            margin-top: 0.5;
        }
		
		.social-media {
			margin-top: 1px;
		}

		.social-media a {
			margin: 0 3px;
			display: inline-block;
		}

		footer p {
			margin-top: 5px;
		}

		.social-media img {
			width: 35px;
			height: 35px;
			transition: transform 0.3s ease;
		}

		.social-media img:hover {
			transform: scale(1.2); 

		}
		.headerlogo{
            display: flex;
            align-items: center;
        }
		
		.headerlogo img{
            cursor: pointer;
			margin-right: 20px;
        }
		header h1 {
            font-family: 'Georgia', serif;
            color: white;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
			margin-right:105px;
            letter-spacing: 1px;
        }
    </style>
</head>
<body>
    <header>
        <div class="headerlogo">
            <img src="460509624_1463840257655227_6223856608048021337_n.png" alt="Search" height="98px">
        </div>  
        <h1>Welcome to the Uplift Page Bookstore</h1>
    </header>

    <div class="container">
        <h2>Register</h2>
  <form method="post" action="" onsubmit="return validateForm()">
    <input type="text" name="firstname" placeholder="First Name" required>
    <input type="text" name="lastname" placeholder="Last Name" required>

    <input type="text" id="username" name="username" placeholder="Email Address" required>
	<input type="text" id="address" name="address" placeholder="Complete Address" required>
    <input type="password" id="password" name="password" placeholder="Password" required pattern="^[a-zA-Z0-9_]{4,20}$" title="Password should be 4-20 characters long and can only contain letters, numbers, and underscores.">

    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required pattern="^[a-zA-Z0-9_]{4,20}$" title="Password should be 4-20 characters long and can only contain letters, numbers, and underscores.">
    <select name="gender" required>
        <option value="">Select Gender</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other">Other</option>
    </select>
    <input type="date" name="birthdate" required placeholder="Birthdate">
	<input type="text" id="phone_number" name="phone_number" placeholder="Phone Number" required>

    <input type="submit" value="Register">
</form>

<script>
function validateForm() {
    // Email validation
    const email = document.getElementById("email").value;
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;  // Full email regex pattern for better validation
    if (!emailPattern.test(email)) {
        alert("Please enter a valid email address (e.g., name@example.com).");
        return false;
    }

    // Password matching validation
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirm_password").value;
    if (password !== confirmPassword) {
        alert("Passwords do not match.");
        return false;
    }

    // Phone number validation (11 digits)
    const phoneNumber = document.getElementById("phone_number").value;
    const phonePattern = /^\d{11}$/;
    if (!phonePattern.test(phoneNumber)) {
        alert("Phone number must be exactly 11 digits.");
        return false;
    }

    // If all checks pass, return true to allow form submission
    return true;
}
</script>


</script>
        <div class="login-link">
            <p><a href="login.php">Already have an account? Log in instead!</a></p>
        </div>
    </div>

    <?php if ($message): ?>
        <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>

    <footer>
         <div class="social-media">
        <a href="https://facebook.com" target="_blank">
            <img src="https://raw.githubusercontent.com/SkyPrapai/oopr/main/fb-removebg-preview.png" alt="Facebook">
        </a>
        <a href="https://twitter.com" target="_blank">
            <img src="https://raw.githubusercontent.com/SkyPrapai/oopr/main/5ec14aa8686c6761c75b20a164a8afc2-removebg-preview.png" alt="Twitter">
        </a>
        <a href="https://instagram.com" target="_blank">
            <img src="https://raw.githubusercontent.com/SkyPrapai/oopr/main/images-removebg-preview.png" alt="Instagram">
        </a>
    </div>
        <p>&copy; 2024 UPLIFT BOOKSTORE. All Rights Reserved.</p>
    </footer>
</body>
</html>
