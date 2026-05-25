<?php
/**
 * CATEGORY 4: MODALS, DIALOG OVERLAYS & SUCCESS POPUPS - HIGH FIDELITY SHOWCASE
 */
$current_path = $_SERVER['PHP_SELF'];
$path_to_root = (strpos($current_path, '/pages/') !== false) ? "../../" : "";
include_once $path_to_root . 'includes/header.php';
include_once $path_to_root . 'includes/navbar.php';
?>

<main class="container fade-in">
    <!-- HERO SECTION DESIGN SYSTEM SHOWCASE -->
    <section class="showcase-hero">
        <div class="hero-glow"></div>
        <span class="badge-accent"><i class="fas fa-sparkles"></i> overlay ecosystem</span>
        <h2>Modals & Dialog Overlays</h2>
        <p>Premium overlays with dynamic backdrops, spring-based entry animations, and contextual state validation.</p>
    </section>

    <!-- LIVE TRIGGER CONTROL PANEL (Makes the page beautiful and usable) -->
    <section class="modals-showcase-panel">
        <div class="card glass-premium control-card">
            <h4>Interactive Modal Controller</h4>
            <p>Click any button below to trigger and test the custom animated overlays. Experience smooth glassmorphism, responsive forms, and state-driven notifications.</p>
            
            <div class="trigger-buttons-grid">
                <button class="primary-btn btn-blue-navy hover-glow-navy" id="btn-trigger-add-account">
                    <i class="fas fa-user-plus"></i> Open Form: Add Account
                </button>
                <button class="btn-outline border-danger text-danger hover-glow-danger" id="btn-trigger-exit-confirm">
                    <i class="fas fa-sign-out-alt"></i> Open Dialog: Exit Confirm
                </button>
                <button class="primary-btn btn-peach-glow" id="btn-trigger-success-toast">
                    <i class="fas fa-bell"></i> Trigger Success Toast
                </button>
            </div>
        </div>
    </section>
</main>

<!-- 1. MODAL OVERLAY WRAPPER (Add Account Form) -->
<div class="modal-overlay" id="add-account-modal" style="display: none;">
    <div class="modal-card modal-card--form glass-premium">
        <!-- Close button -->
        <button class="modal-close" id="btn-close-add-account" aria-label="Close modal">
            <i class="fas fa-times"></i>
        </button>
        
        <div class="modal-header">
            <span class="modal-icon-badge"><i class="fas fa-user-shield"></i></span>
            <h3>Add New Account</h3>
            <p>Switch between your writing personas easily.</p>
        </div>
        
        <form id="form-link-account" onsubmit="event.preventDefault();">
            <div class="modal-body">
                <div class="input-group-custom">
                    <label for="modal-input-email">Email Address</label>
                    <div class="input-wrapper">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" id="modal-input-email" placeholder="Enter account email" required>
                    </div>
                </div>
                
                <div class="input-group-custom">
                    <label for="modal-input-pass">Password</label>
                    <div class="input-wrapper">
                        <i class="fas fa-key input-icon"></i>
                        <input type="password" id="modal-input-pass" placeholder="••••••••" required>
                    </div>
                </div>

                <!-- NOTIFICATION SWITCH TOGGLE (Interactive switch toggle requested!) -->
                <div class="toggle-setting-row">
                    <div class="setting-text">
                        <strong>Sync Notifications</strong>
                        <p>Receive updates from this persona instantly</p>
                    </div>
                    <label class="switch-toggle">
                        <input type="checkbox" id="sync-notifications-toggle" checked>
                        <span class="switch-slider"></span>
                    </label>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn-soft-gray" id="btn-cancel-add-account">Cancel</button>
                <button type="submit" class="primary-btn btn-peach-glow" id="btn-submit-link-account">Link Account</button>
            </div>
        </form>
    </div>
</div>

<!-- 2. DIALOG CARD (Exit Confirmation) -->
<div class="modal-overlay" id="exit-confirm-modal" style="display: none;">
    <div class="modal-card modal-card--dialog glass-premium">
        <div class="modal-icon modal-icon--warning pulse-warning">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <div class="modal-header">
            <h3>Are you sure?</h3>
            <p>Unsaved changes in your draft might be lost if you leave now.</p>
        </div>
        <div class="modal-footer split-btns">
            <button class="btn-soft-gray" id="btn-stay-save">Stay & Save</button>
            <button class="btn-danger hover-shake" id="btn-exit-anyway">Exit anyway</button>
        </div>
    </div>
</div>

<!-- 3. SUCCESS TOAST POPUP -->
<div class="toast-container top-right" id="success-toast-demo" style="display: none;">
    <div class="toast toast--success glass-premium">
        <div class="toast__icon-wrapper">
            <div class="checkmark-pulse">
                <i class="fas fa-check"></i>
            </div>
        </div>
        <div class="toast__content">
            <h4>Klaim Berhasil!</h4>
            <p>+50 XP & 10 Gems telah ditambahkan.</p>
        </div>
        <button class="toast__close" id="btn-close-success-toast"><i class="fas fa-times"></i></button>
    </div>
</div>

<?php
include_once $path_to_root . 'includes/footer.php';
?>
