<?php 
$base_dir = dirname(dirname(__DIR__));
include_once $base_dir . '/includes/header.php'; 
include_once $base_dir . '/includes/navbar.php'; 
?>

<div class="container fade-in">
    <div class="card" style="max-width: 400px; margin: 50px auto; padding: 25px;">
        <h1 style="text-align: center; margin-bottom: 25px;">Setting</h1>
        
        <div class="setting-menu">
            <a href="../profile/account.php" class="menu-item">Account</a>
            <a href="privacy.php" class="menu-item">Private ></a>
            <a href="language.php" class="menu-item">Language ></a>
            <a href="theme.php" class="menu-item">Theme Mode ></a>
            <a href="notifications.php" class="menu-item">Notifications ></a>
        </div>
    </div>
</div>

<style>
.menu-item {
    display: block; 
    padding: 15px; 
    border-bottom: 1px solid #eee; 
    text-decoration: none; 
    color: #333;
}
.menu-item:hover { background-color: #f0f0f0; }
</style>
<?php include '../../includes/footer.php'; ?>
    <div class="settings-layout">
        <aside class="settings-sidebar">
            <div class="profile-summary-card card-item">
                <div class="profile-summary-card__avatar">
                    <div class="profile-pic-container logo-xl">
                        <!-- Gunakan logo.jpeg di root -->
                        <img src="../../logo.jpeg" alt="Profile" class="avatar-circle" style="width: 80px; height: 80px;">
                        <div class="status-indicator active"></div>
                    </div>
                </div>
                <div class="profile-summary-card__info">
                    <h3 style="margin-top: 15px;">User_Typify</h3>
                    <p style="opacity: 0.6; font-size: 13px;">user@typify.app</p>
                </div>
            </div>

            <nav class="settings-nav" style="margin-top: 20px;">
                <ul class="settings-list" style="list-style: none;">
                    <li class="settings-item card-item" style="margin-bottom: 10px; cursor: pointer;">
                        <div class="settings-item__link">
                            <i class="fas fa-palette" style="margin-right: 10px;"></i>
                            <span class="settings-item__label">Theme Mode</span>
                        </div>
                    </li>
                    <li class="settings-item card-item">
                        <div class="settings-item__link">
                            <i class="fas fa-bell" style="margin-right: 10px;"></i>
                            <span class="settings-item__label">Notifications</span>
                        </div>
                    </li>
                </ul>
            </nav>
        </aside>

        <main class="settings-main">
            <div class="card-item">
                <h3 style="margin-bottom: 20px;">Account Settings</h3>
                <div class="input-group" style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">Display Name</label>
                    <input type="text" value="User_Typify" style="width: 100%; padding: 12px; border-radius: 10px; border: 1px solid var(--border-glass); background: rgba(255,255,255,0.05); color: white;">
                </div>
                <div class="input-group" style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 5px;">Email Address</label>
                    <input type="email" value="user@typify.app" style="width: 100%; padding: 12px; border-radius: 10px; border: 1px solid var(--border-glass); background: rgba(255,255,255,0.05); color: white;">
                </div>
                <button class="btn-go-pro" id="btn-save-settings">Save Changes</button>
            </div>
        </main>
    </div>
</div>

<?php include_once $base_dir . '/includes/footer.php'; ?>
<script src="../../js/app.js"></script>
