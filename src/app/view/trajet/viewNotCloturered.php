<?php require($root . '/app/view/fragment/fragmentHeader.html'); ?>

<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.php';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        ?>

        <div class="alert alert-danger mt-4">
            <h2>Erreur de clôture du trajet</h2>
            <hr>
            <p><?php echo htmlspecialchars($errorMessage); ?></p>
        </div>
    </div>
    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>
</body>
</html>
