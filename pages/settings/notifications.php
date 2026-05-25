<?php include '../../includes/header.php'; ?>

<div class="container fade-in">
    <div class="card" style="max-width: 400px; margin: 50px auto; padding: 25px;">
        <h1 style="text-align: center; margin-bottom: 25px;">Notifications</h1>
        
        <div class="notification-options">
            <form action="save_notifications.php" method="POST">
                <div style="padding: 15px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center;">
                    <label for="push_notif">Push Notifications</label>
                    <input type="checkbox" name="push_notif" id="push_notif" checked>
                </div>
                <div style="padding: 15px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center;">
                    <label for="email_notif">Email Notifications</label>
                    <input type="checkbox" name="email_notif" id="email_notif">
                </div>
                <div style="padding: 15px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center;">
                    <label for="app_update">App Updates</label>
                    <input type="checkbox" name="app_update" id="app_update" checked>
                </div>
                
                <button type="submit" class="primary-btn" style="width: 100%; margin-top: 20px; padding: 10px;">Save Changes</button>
            </form>
        </div>

        <div style="margin-top: 20px; text-align: center;">
            <a href="settings.php" style="color: #6a5acd; text-decoration: none;">Back to Setting</a>
        </div>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>