<?php 
$base_dir = dirname(dirname(__DIR__));
include_once $base_dir . '/includes/header.php'; 
include_once $base_dir . '/includes/navbar.php'; 
?>

<div class="container fade-in">
    <!-- 1. WORKSPACE HEADER -->
    <section class="workspace-section">
        <div class="section-header">
            <h3>Editor Workspace</h3>
            <span id="autosave-status" class="autosave-label"><i class="fas fa-check-circle"></i> Draft Saved</span>
        </div>
    </section>

    <!-- 2. MASTER EDITOR INTERFACE -->
    <section class="editor-section">
        <div class="card-item" style="padding: 40px; min-height: 500px;">
            <div class="editor-header">
                <input type="text" id="editor-title-input" class="editor-title" placeholder="Masukkan Judul Cerita..." style="width: 100%; border: none; background: transparent; font-size: 32px; font-weight: 800; color: white; margin-bottom: 30px; outline: none;">
            </div>
            <div class="editor-body">
                <textarea id="editor-content-input" class="editor-content" placeholder="Mulai menulis kisah inspiratif anda di sini..." style="width: 100%; min-height: 400px; border: none; background: transparent; font-size: 18px; line-height: 1.8; color: rgba(255,255,255,0.8); resize: none; outline: none;"></textarea>
            </div>
            <div class="editor-footer-stats" style="display: flex; justify-content: space-between; border-top: 1px solid var(--border-glass); padding-top: 20px; font-size: 13px; opacity: 0.5;">
                <span id="char-count">0 Characters</span>
                <span id="reading-time">1 min read</span>
            </div>
        </div>
    </section>
</div>

<!-- FLOATING ACTION BAR -->
<div class="editor-actions-bar" style="position: fixed; bottom: 0; left: 0; width: 100%; background: rgba(10, 17, 40, 0.8); backdrop-filter: blur(15px); padding: 15px 0; border-top: 1px solid var(--border-glass); z-index: 1000;">
    <div class="container" style="display: flex; justify-content: space-between; align-items: center;">
        <button id="btn-editor-cancel" class="btn-go-pro" style="background: rgba(255,255,255,0.1);">Back to Dashboard</button>
        <div class="right-actions" style="display: flex; gap: 15px;">
            <button id="btn-editor-save" class="btn-go-pro" style="background: transparent; border: 1px solid #fd79a8; color: #fd79a8;">Save Draft</button>
            <button id="btn-editor-publish" class="btn-go-pro">Publish Story</button>
        </div>
    </div>
</div>

<!-- EXIT CONFIRM MODAL -->
<div class="modal-overlay" id="modal-exit-confirm" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; display: none; align-items: center; justify-content: center; z-index: 9999;">
    <div class="modal-content" style="max-width: 400px; text-align: center;">
        <div class="modal-icon" style="font-size: 40px; color: #fab1a0; margin-bottom: 20px;"><i class="fas fa-sign-out-alt"></i></div>
        <h3>Keluar dari Editor?</h3>
        <p style="opacity: 0.6; margin: 15px 0 30px;">Draft Anda sudah disimpan secara otomatis.</p>
        <div class="split-btns" style="display: flex; gap: 10px; justify-content: center;">
            <button class="btn-go-pro closeModal" data-modal="modal-exit-confirm" style="background: rgba(255,255,255,0.1);">Tetap di Sini</button>
            <button id="btn-modal-exit" class="btn-go-pro" style="background: #ff5e5e;">Keluar Saja</button>
        </div>
    </div>
</div>

<?php include_once $base_dir . '/includes/footer.php'; ?>
<script src="../../js/app.js"></script>
