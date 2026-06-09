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

        <div class="alert mt-4">
            <h2>Trajet clôturé avec succès !</h2>
            <hr>
            <p>Le trajet <strong>ID : <?php echo htmlspecialchars($trajetId); ?></strong> a été clôturé.</p>
            <p><strong><?php echo htmlspecialchars($nombreReservations); ?></strong> réservation(s) traitée(s).</p>
            <p>Montant total reçu : <strong><?php echo htmlspecialchars(number_format($montantTotal, 2, ',', ' ')); ?> €</strong></p>
            <p>Nouveau solde : <strong><?php echo htmlspecialchars(number_format($nouveauSolde, 2, ',', ' ')); ?> €</strong></p>
            <a href="router1.php?action=trajetReadMine" class="btn btn-primary mt-3">Voir mes trajets</a>
        </div>
    </div>
    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>
</body>
</html>
