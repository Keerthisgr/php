<?php include 'includes/header.php'; ?>

<div class="container">
    <h1>Contact Us</h1>
    
    <?php
    // Display success message if form was submitted
    if (isset($_GET['success']) && $_GET['success'] == '1') {
        echo '<div class="success-message">Thank you for your message! We will get back to you soon.</div>';
    }
    ?>
    
    <form action="process-form.php" method="POST" class="contact-form">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        
        <div class="form-group">
            <label for="subject">Subject:</label>
            <input type="text" id="subject" name="subject" required>
        </div>
        
        <div class="form-group">
            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="5" required></textarea>
        </div>
        
        <button type="submit" class="btn">Send Message</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>