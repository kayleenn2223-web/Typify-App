<?php 
// Include header yang berisi tag <html>, <head>, dan CSS
include_once __DIR__ . '/includes/header.php'; 

// Include navbar/header visual aplikasi
include_once __DIR__ . '/includes/navbar.php'; 

// Include komponen kartu agar bisa dipanggil
include_once __DIR__ . '/pages/components/card.php'; 
?>

<main class="container fade-in">
    <div class="dashboard-grid">
        <!-- Area Utama (Kiri) -->
        <div class="main-content">
            <section class="section-header">
                <h3>My Writing Projects</h3>
            </section>
            
            <div class="cards-grid">
                <?php 
                    renderTypifyCard('The Neon Kingdom', '12 Files • Updated 2h ago', 'project');
                    renderTypifyCard('Starlight Echoes', '5 Files • Updated yesterday', 'project');
                    renderTypifyCard('Mystery of X', '8 Files • Updated 3 days ago', 'project');
                ?>
            </div>

            <section class="section-header" style="margin-top: 40px;">
                <h3>Recent Notes</h3>
            </section>
            
            <div class="cards-grid">
                <?php 
                    renderTypifyCard('Character Archetypes', 'Ideas for protagonist arcs', 'note');
                    renderTypifyCard('World Building: Sectors', 'Descriptions of 7 sectors', 'note');
                ?>
            </div>
        </div>

        <!-- Area Statistik (Kanan) -->
        <aside class="side-stats">
            <div class="card-item">
                <h4 class="card-title">Quick Stats</h4>
                <div class="stat-row" style="display: flex; justify-content: space-between; margin-top: 10px;">
                    <span>Reads</span>
                    <strong>12.5k</strong>
                </div>
                <div class="stat-row" style="display: flex; justify-content: space-between;">
                    <span>Followers</span>
                    <strong>1.2k</strong>
                </div>
            </div>

            <div class="card-item" style="background: var(--primary-gradient); color: white;">
                <h4 class="card-title">Upgrade to PRO</h4>
                <p style="font-size: 13px; margin: 10px 0;">Dapatkan fitur AI Writing Assistant sekarang!</p>
                <button class="btn-go-pro" style="background: white; color: #fd79a8; width: 100%;">Ambil Promo</button>
            </div>
        </aside>
    </div>
</main>

<?php 
// Include footer
include_once __DIR__ . '/includes/footer.php'; 
?>
<script src="js/app.js"></script>
