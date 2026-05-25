<?php include '../../includes/header.php'; ?>

<div class="container fade-in">
    <div class="card" style="max-width: 400px; margin: 50px auto; padding: 25px;">
        <h1 style="text-align: center; margin-bottom: 25px;">Theme Mode</h1>
        
        <div class="theme-options">
            <form action="save_theme.php" method="POST">
                <div style="padding: 15px; border-bottom: 1px solid #eee;">
                    <input type="radio" name="theme" value="light" id="light" checked>
                    <label for="light" style="margin-left: 10px;">Light Mode</label>
                </div>
                <div style="padding: 15px; border-bottom: 1px solid #eee;">
                    <input type="radio" name="theme" value="dark" id="dark">
                    <label for="dark" style="margin-left: 10px;">Dark Mode</label>
                </div>
                <div style="padding: 15px; border-bottom: 1px solid #eee;">
                    <input type="radio" name="theme" value="auto" id="auto">
                    <label for="auto" style="margin-left: 10px;">Auto (System Default)</label>
                </div>
                
                <button type="submit" class="primary-btn" style="width: 100%; margin-top: 20px; padding: 10px;">Save Theme</button>
            </form>
        </div>

        <div style="margin-top: 20px; text-align: center;">
            <a href="settings.php" style="color: #6a5acd; text-decoration: none;">Back to Setting</a>
        </div>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>