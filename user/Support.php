<?php
// Start session and handle cookies
session_start();

// Initialize variables for form validation
$name = $email = $subject = $message = "";
$nameErr = $emailErr = $subjectErr = $messageErr = "";
$thankYouMessage = "";

// Form validation and processing
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate Name
    if (empty($_POST["name"])) {
        $nameErr = "Full Name is required";
    } else {
        $name = test_input($_POST["name"]);
    }

    // Validate Email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    } else {
        $email = test_input($_POST["email"]);
    }

    // Validate Subject
    if (empty($_POST["subject"])) {
        $subjectErr = "Subject is required";
    } else {
        $subject = test_input($_POST["subject"]);
    }

    // Validate Message
    if (empty($_POST["message"])) {
        $messageErr = "Message is required";
    } else {
        $message = test_input($_POST["message"]);
    }

    // If there are no errors, set a cookie and display a thank you message
    if (!$nameErr && !$emailErr && !$subjectErr && !$messageErr) {
        // Set a cookie to remember the user
        setcookie("formSubmitted", "true", time() + 5);

        // Display the thank you message
        $thankYouMessage = "Thank you for contacting us! We will get back to you shortly.";
    }
}

// Sanitize input data to prevent XSS
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support - Contact Us</title>
    <link rel="stylesheet" href="../assets/style.css"> <!-- Link to your CSS -->
</head>
<body>
    <!-- Include your header file here -->
    <?php include 'header.php'; ?>

    <main>
        <section class="support-section">
            <h1>Need Help? Contact Us</h1>

            <?php if ($thankYouMessage): ?>
                <div class="thank-you-message">
                    <p><?php echo $thankYouMessage; ?></p>
                </div>
            <?php endif; ?>

            <!-- Support form -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $name; ?>">
                <span class="error"><?php echo $nameErr; ?></span>

                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" value="<?php echo $email; ?>">
                <span class="error"><?php echo $emailErr; ?></span>

                <label for="subject">Subject:</label>
                <input type="text" id="subject" name="subject" value="<?php echo $subject; ?>">
                <span class="error"><?php echo $subjectErr; ?></span>

                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="5"><?php echo $message; ?></textarea>
                <span class="error"><?php echo $messageErr; ?></span>

                <button class="supportButton" type="submit">Submit</button>
            </form>

            <div class="support-info">
                <h2>Support Information</h2>
                <p>If you need immediate assistance, you can reach us through:</p>
                <ul>
                    <li>Email: <a href="mailto:support@example.com">SoundHaven@gmail.com</a></li>
                    <li>Phone: +1 (123) 456-7890</li>
                    <li>Office Hours: Monday - Friday, 9:00 AM to 6:00 PM (GMT)</li>
                </ul>
            </div>
        </section>
    </main>
    <?php
 include('footer.php'); 
 ?>
</body>
</html>
