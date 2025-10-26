<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);
    
    // Basic validation
    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
        // In a real application, you would:
        // 1. Send an email
        // 2. Save to database
        // 3. Process the data
        
        // For now, we'll just redirect with success message
        header('Location: contact.php?success=1');
        exit();
    } else {
        // Redirect back with error
        header('Location: contact.php?error=1');
        exit();
    }
} else {
    // If someone tries to access directly, redirect to contact page
    header('Location: contact.php');
    exit();
}
?>