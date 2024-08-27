<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize an array to store any errors
    $errors = [];

    // Sanitize and validate input
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $details = htmlspecialchars(trim($_POST['details']));

    if (empty($name)) {
        $errors[] = "Name is required.";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "A valid email is required.";
    }

    if (empty($details)) {
        $errors[] = "Details are required.";
    }

    // If no errors, proceed to process the data
    if (empty($errors)) {
        // Send an email to your address
        $to = 'abhiera82@gmail.com';
        $subject = 'New Consultation Request';
        $message = "Name: $name\nEmail: $email\nDetails: $details";
        $headers = "From: $email" . "\r\n" .
                   "Reply-To: $email" . "\r\n" .
                   "X-Mailer: PHP/" . phpversion();

        if (mail($to, $subject, $message, $headers)) {
            echo "Thank you, $name. Your request has been submitted successfully. We will contact you at $email soon.";
        } else {
            echo "There was an error submitting your request. Please try again later.";
        }
    } else {
        // Display errors
        foreach ($errors as $error) {
            echo "<p>Error: $error</p>";
        }
    }
}
?>
