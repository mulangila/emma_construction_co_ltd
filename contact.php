<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Trim inputs to remove extra whitespace
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Initialize an error message array
    $errors = [];

    // Validate Name
    if (empty($name) || strlen($name) < 3) {
        $errors[] = "Name must be at least 3 characters long.";
    }

    // Validate Email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    // Validate Message
    if (empty($message) || strlen($message) < 10) {
        $errors[] = "Message must be at least 10 characters long.";
    }

    // Check for Errors
    if (!empty($errors)) {
        echo "<h1>There were errors in your form submission:</h1>";
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
        echo "<a href='javascript:history.back()'>Go Back</a>";
        exit; // Stop further processing
    }

    // Send Email if Validation Passes
    $to = "info@emmaconstruction.com"; // Replace with your email address
    $subject = "New Contact Form Submission";
    $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
    $headers = "From: $email";

    if (mail($to, $subject, $body, $headers)) {
        echo "<h1>Thank you, $name!</h1><p>Your message has been sent successfully.</p>";
    } else {
        echo "<h1>Oops!</h1><p>Something went wrong. Please try again later.</p>";
    }
} else {
    echo "Invalid request method.";
}
?>