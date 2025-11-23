<?php
// --- Configuration ---
$to = "ashpreetsingh9212@gmail.com"; // Your email
$subjectPrefix = "New Contact Form Submission - Arab Cool";

// --- Collect Form Data ---
$name = trim($_POST['name'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$email = trim($_POST['email'] ?? '');
$subject = trim($_POST['subject'] ?? 'No Subject');
$message = trim($_POST['message'] ?? '');

// --- Basic Validation ---
if (empty($name) || empty($phone) || empty($email) || empty($message)) {
    echo "<script>alert('Please fill all required fields.'); window.history.back();</script>";
    exit;
}

// --- Build the Email ---
$email_subject = "$subjectPrefix: $subject";

$email_body = "You have received a new contact form submission from Arab Cool website.\r\n\r\n";
$email_body .= "--------------------------------------------\r\n";
$email_body .= "Name: $name\r\n";
$email_body .= "Phone: $phone\r\n";
$email_body .= "Email: $email\r\n";
$email_body .= "Subject: $subject\r\n\r\n";
$email_body .= "Message:\r\n$message\r\n\r\n";
$email_body .= "--------------------------------------------\r\n";
$email_body .= "Date: " . date("d M Y, H:i A") . "\r\n";
$email_body .= "IP: " . $_SERVER['REMOTE_ADDR'] . "\r\n";

// --- Headers ---
$headers  = "From: Arab Cool Website <no-reply@yourdomain.com>\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

// --- Send Email ---
if (mail($to, $email_subject, $email_body, $headers)) {
    echo "<script>alert('✅ Thank you, $name! Your message has been sent successfully.'); window.location.href='contact.html';</script>";
} else {
    echo "<script>alert('❌ Sorry, there was a problem sending your message. Please try again later.'); window.history.back();</script>";
}

// --- Optional: Debug Logging (for testing only) ---
file_put_contents('mail_log.txt', print_r($_POST, true), FILE_APPEND);
?>
