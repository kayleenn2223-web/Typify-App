<?php include '../../includes/header.php'; ?>
<?php include '../../includes/navbar.php'; ?>
<?php include '../components/card.php'; ?>

<main class="container fade-in">
    <div class="main-content">
        <section class="section-header">
            <h3>All Components & Cards</h3>
        </section>
        
        <div class="cards-grid">
            <?php 
                renderTypifyCard('Premium Story', 'VIP Access Required', 'project');
                renderTypifyCard('Drafting Phase', '3 Chapters Written', 'note');
                renderTypifyCard('The Lost Galaxy', 'Sci-Fi • Completed', 'project');
            ?>
        </div>
    </div>
</main>

<?php include '../../includes/footer.php'; ?>
<script src="../../js/app.js"></script>
