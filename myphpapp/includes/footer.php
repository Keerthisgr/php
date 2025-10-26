    </main>
    
    <footer>
        <div class="footer-content">
            <p>&copy; <?php echo date('Y'); ?> My PHP App. All rights reserved.</p>
            <p>Page rendered in <?php echo round(microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"], 4); ?> seconds</p>
        </div>
    </footer>
    
    <script>
        // Simple JavaScript for form enhancement
        document.addEventListener('DOMContentLoaded', function() {
            // Add loading state to forms
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function() {
                    const submitBtn = this.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        submitBtn.textContent = 'Processing...';
                        submitBtn.disabled = true;
                    }
                });
            });
        });
    </script>
</body>
</html>
