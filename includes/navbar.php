<?php
// Gunakan path absolut untuk include file PHP agar tidak error
$base_dir = dirname(__DIR__);
include_once $base_dir . '/pages/components/widget.php';

// Path untuk browser (Links & Images)
$current_path = $_SERVER['PHP_SELF'];
$path_to_root = (strpos($current_path, '/pages/') !== false) ? "../../" : "";
?>
<header class="header-wrapper">
    <div class="container">
        <nav class="navbar">
            <!-- LOGO BULAT & TEKS TYPIFY -->
            <a href="<?php echo $path_to_root; ?>index.php" class="logo-section">
                <img src="<?php echo $path_to_root; ?>logo.jpeg" alt="Typify Logo" class="logo-img">
                <span class="logo-text">Typify</span>
            </a>

            <div class="nav-right-widget">
                <!-- NAVIGASI AKTIF (HOME, PROFILE, SETTINGS) -->
                <ul class="nav-links-header">
                    <li><a href="<?php echo $path_to_root; ?>index.php">Home</a></li>
                    <li><a href="<?php echo $path_to_root; ?>pages/profile/profile.php">Profile</a></li>
                    <li><a href="<?php echo $path_to_root; ?>pages/settings/settings.php">Settings</a></li>
                </ul>

                <?php renderProfileWidget(); ?>
            </div>
        </nav>
    </div>
</header>
