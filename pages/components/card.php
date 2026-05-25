<?php
/**
 * pages/components/card.php
 */
function renderTypifyCard($title, $subtitle, $type = 'project', $id = '') {
    $current_path = $_SERVER['PHP_SELF'];
    $path_to_root = (strpos($current_path, '/pages/') !== false) ? "../../" : "";
    $icon = ($type === 'project') ? 'fa-folder' : 'fa-file-alt';
    $target_link = $path_to_root . "pages/dashboard/editor.php";
    ?>
    <a href="<?php echo $target_link; ?>" class="card-item fade-in">
        <div class="card-icon-box">
            <i class="fas <?php echo $icon; ?>"></i>
        </div>
        <div class="card-content">
            <h4 class="card-title"><?php echo $title; ?></h4>
            <p class="card-meta"><?php echo $subtitle; ?></p>
        </div>
    </a>
    <?php
}
?>
