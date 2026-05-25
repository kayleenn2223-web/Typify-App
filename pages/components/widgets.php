<?php
/**
 * CATEGORY 5: GAMIFIED REWARDS & POINTS SYSTEM - HIGH FIDELITY GLASSMORPHISM SHOWCASE
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
        <span class="badge-accent"><i class="fas fa-sparkles"></i> gamified system</span>
        <h2>Gamified Rewards & Points</h2>
        <p>Interactive dashboard components designed to drive user retention through daily streaks, points ledger, and premium rewards.</p>
    </section>

    <!-- MAIN REWARDS CONTENT -->
    <section class="rewards-section">
        <!-- 1. STREAK MILESTONE TRACKER -->
        <div class="card streak-tracker glass-premium">
            <!-- Decorative shining stars background -->
            <div class="star-decor star-1"><i class="fas fa-star"></i></div>
            <div class="star-decor star-2"><i class="fas fa-star"></i></div>
            <div class="star-decor star-3"><i class="fas fa-star"></i></div>

            <div class="card-header-rewards">
                <div class="header-title-wrapper">
                    <span class="header-icon"><i class="fas fa-fire-alt animate-fire"></i></span>
                    <div>
                        <h4>Daily Streak Milestone</h4>
                        <p>Log in daily to earn massive rewards! Keep the fire burning.</p>
                    </div>
                </div>
                <div class="streak-badge">
                    <span id="streak-count-val">5</span> Day Streak
                </div>
            </div>
            
            <div class="streak-timeline-wrapper">
                <div class="streak-timeline">
                    <!-- Progress Line Background -->
                    <div class="timeline-progress-bar">
                        <div class="timeline-progress-fill" style="width: 44.4%;"></div>
                    </div>

                    <!-- Node 1 (Completed) -->
                    <div class="streak-node completed" data-day="1">
                        <div class="node-circle">
                            <i class="fas fa-check"></i>
                        </div>
                        <span class="node-label">Day 1</span>
                        <span class="node-points">+10 pts</span>
                    </div>
                    
                    <!-- Node 2 (Completed) -->
                    <div class="streak-node completed" data-day="2">
                        <div class="node-circle">
                            <i class="fas fa-check"></i>
                        </div>
                        <span class="node-label">Day 2</span>
                        <span class="node-points">+10 pts</span>
                    </div>
                    
                    <!-- Node 3 (Completed) -->
                    <div class="streak-node completed" data-day="3">
                        <div class="node-circle">
                            <i class="fas fa-check"></i>
                        </div>
                        <span class="node-label">Day 3</span>
                        <span class="node-points">+20 pts</span>
                    </div>

                    <!-- Node 4 (Completed) -->
                    <div class="streak-node completed" data-day="4">
                        <div class="node-circle">
                            <i class="fas fa-check"></i>
                        </div>
                        <span class="node-label">Day 4</span>
                        <span class="node-points">+10 pts</span>
                    </div>
                    
                    <!-- Node 5 (Current / Active & Claimable) -->
                    <div class="streak-node current pulse-glow" data-day="5" id="streak-day-5-node">
                        <div class="node-circle">
                            <i class="fas fa-gift"></i>
                        </div>
                        <span class="node-label font-bold text-navy">Day 5</span>
                        <span class="node-points badge-peach">+50 pts</span>
                    </div>
                    
                    <!-- Node 6 (Locked) -->
                    <div class="streak-node locked" data-day="6">
                        <div class="node-circle">
                            <i class="fas fa-lock"></i>
                        </div>
                        <span class="node-label">Day 6</span>
                        <span class="node-points">+10 pts</span>
                    </div>
                    
                    <!-- Node 7 (Milestone Locked) -->
                    <div class="streak-node locked milestone" data-day="7">
                        <div class="node-circle">
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <span class="node-label">Day 7</span>
                        <span class="node-points badge-gold">+100 pts</span>
                    </div>
                    
                    <!-- Node 8 (Locked) -->
                    <div class="streak-node locked" data-day="8">
                        <div class="node-circle">
                            <i class="fas fa-lock"></i>
                        </div>
                        <span class="node-label">Day 8</span>
                        <span class="node-points">+15 pts</span>
                    </div>

                    <!-- Node 12 (Crown Epic Milestone Locked) -->
                    <div class="streak-node locked milestone-epic" data-day="12">
                        <div class="node-circle">
                            <i class="fas fa-crown"></i>
                        </div>
                        <span class="node-label">Day 12</span>
                        <span class="node-points badge-epic">+300 pts</span>
                    </div>
                </div>
            </div>

            <!-- Action panel -->
            <div class="streak-action-panel">
                <p class="streak-status-text">Your Day 5 Login reward is ready! Claim now to get <strong>+50 Points & 10 Gems</strong>.</p>
                <button class="primary-btn btn-peach-glow pulse-hover" id="btn-claim-streak">
                    <i class="fas fa-gem animate-bounce"></i> Klaim Poin Hari Ini
                </button>
            </div>
        </div>

        <!-- 2. POINT COUNTER & HISTORY -->
        <div class="rewards-grid">
            <!-- Point Block -->
            <div class="card points-card glass-premium">
                <div class="points-glow"></div>
                <div class="points-display">
                    <span class="points-label"><i class="fas fa-coins text-gold"></i> Total Points Balance</span>
                    <h2 class="points-value" id="total-points-display">2,450 <small>Pts</small></h2>
                    <div class="gems-balance">
                        <span><i class="fas fa-gem text-pink"></i> <strong>45</strong> Gems</span>
                        <span class="xp-level"><i class="fas fa-shield-alt text-blue"></i> Level <strong>4</strong></span>
                    </div>
                </div>
                <div class="points-actions">
                    <button class="btn-outline tebus-btn hover-glow-peach" id="btn-tebus-hadiah">
                        <i class="fas fa-gift"></i> Tebus Hadiah
                    </button>
                    <button class="primary-btn btn-peach-glow" id="btn-show-toast-trigger">
                        <i class="fas fa-sparkles"></i> Simulasikan Toast
                    </button>
                </div>
            </div>

            <!-- History Log -->
            <div class="card history-card glass-premium">
                <div class="card-header-simple">
                    <h4><i class="fas fa-history text-navy"></i> Riwayat Poin</h4>
                    <span class="badge-soft">Filter: Semua</span>
                </div>
                <ul class="history-list" id="rewards-history-list">
                    <li class="history-item">
                        <div class="history-icon-wrapper positive">
                            <i class="fas fa-sign-in-alt"></i>
                        </div>
                        <div class="history-info">
                            <strong>Daily Login Bonus</strong>
                            <span>24 Mei 2026</span>
                        </div>
                        <span class="history-amount positive">+10 Pts</span>
                    </li>
                    <li class="history-item">
                        <div class="history-icon-wrapper positive">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="history-info">
                            <strong>Review Challenge</strong>
                            <span>23 Mei 2026</span>
                        </div>
                        <span class="history-amount positive">+50 Pts</span>
                    </li>
                    <li class="history-item">
                        <div class="history-icon-wrapper negative">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                        <div class="history-info">
                            <strong>Redeemed: Pro Badge</strong>
                            <span>20 Mei 2026</span>
                        </div>
                        <span class="history-amount negative">-500 Pts</span>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</main>

<!-- SUCCESS TOAST POPUP (Will be controlled by JS) -->
<div class="toast-container top-right" id="success-toast-points" style="display: none;">
    <div class="toast toast--success glass-premium">
        <div class="toast__icon-wrapper">
            <div class="checkmark-pulse">
                <i class="fas fa-check"></i>
            </div>
        </div>
        <div class="toast__content">
            <h4 id="toast-success-title">Klaim Berhasil!</h4>
            <p id="toast-success-body">+50 XP & 10 Gems telah ditambahkan.</p>
        </div>
        <button class="toast__close" id="btn-close-toast-points"><i class="fas fa-times"></i></button>
    </div>
</div>

<?php
include_once $path_to_root . 'includes/footer.php';
?>
