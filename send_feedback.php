<?php
include 'includes/header.php';
include 'includes/db.php'; // contains: $pdo = new PDO(...);

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name    = htmlspecialchars($_POST['name']);
    $email   = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    try {
        $stmt = $pdo->prepare("INSERT INTO feedback (name, email, message) VALUES (:name, :email, :message)");
        $stmt->execute([
            ':name'    => $name,
            ':email'   => $email,
            ':message' => $message
        ]);

        // Send email
        $to = "info@online-store.com";
        $subject = "New Feedback from $name";
        $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
        $headers = "From: $email\r\nReply-To: $email";

        if (mail($to, $subject, $body, $headers)) {
            $success = "Thank you for your feedback!";
        } else {
            $error = "Feedback saved, but email could not be sent.";
        }
        header("Location: about.php");
        exit();
    } catch (PDOException $e) {
        $error = "Database error: " . $e->getMessage();
    }
}
?>
