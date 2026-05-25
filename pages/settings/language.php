<?php include '../../includes/header.php'; ?>

<div class="container fade-in">
    <div class="card" style="max-width: 400px; margin: 50px auto; padding: 25px;">
        <h1 style="text-align: center; margin-bottom: 25px;">Language</h1>
        
        <div class="language-options">
            <form action="save_language.php" method="POST">
                <div style="padding: 15px; border-bottom: 1px solid #eee;">
                    <input type="radio" name="lang" value="en" id="en" checked>
                    <label for="en" style="margin-left: 10px;">English (USA)</label>
                </div>
                <div style="padding: 15px; border-bottom: 1px solid #eee;">
                    <input type="radio" name="lang" value="id" id="id">
                    <label for="id" style="margin-left: 10px;">Bahasa Indonesia</label>
                </div>
                <div style="padding: 15px; border-bottom: 1px solid #eee;">
                    <input type="radio" name="lang" value="es" id="es">
                    <label for="es" style="margin-left: 10px;">Español</label>
                </div>
                
                <button type="submit" class="primary-btn" style="width: 100%; margin-top: 20px; padding: 10px;">Save Language</button>
            </form>
        </div>

        <div style="margin-top: 20px; text-align: center;">
            <a href="settings.php" style="color: #6a5acd; text-decoration: none;">Back to Setting</a>
        </div>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>