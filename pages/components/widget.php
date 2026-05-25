<?php
/**
 * pages/components/widget.php
 */
function renderProfileWidget() {
    $current_path = $_SERVER['PHP_SELF'];
    $path_to_root = (strpos($current_path, '/pages/') !== false) ? "../../" : "";
    ?>
    <div class="profile-widget" id="top-profile-trigger">
        <div class="profile-info-mini">
            <!-- Foto Profil Bulat -->
            <img src="<?php echo $path_to_root; ?>logo.jpeg" alt="Avatar" class="avatar-circle">
            <span class="user-name-text">User_Typify</span>
        </div>
        
        <button class="btn-go-pro" id="btn-go-pro-trigger">Go Pro</button>
    </div>
    <?php
}
?>
