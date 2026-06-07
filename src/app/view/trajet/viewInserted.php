<?php 
if (!isset($root)) {
    include '../../config.php';
}
require($root . '/app/view/fragment/fragmentHeader.html'); 
?>

<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.php';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        ?>

        <div class="alert alert-success mt-4">
            <h2>Trajet créé avec succès !</h2>
            <hr>
            <p>Le trajet <strong>ID : <?php echo htmlspecialchars($trajetId); ?></strong> a été ajouté à la base de données.</p>
            <a href="router1.php?action=trajetReadMine" class="btn btn-primary mt-3">Voir mes trajets</a>
        </div>
    </div>
    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>
</body>
</html>
