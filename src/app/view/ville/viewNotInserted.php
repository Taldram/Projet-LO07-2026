<?php require($root . '/app/view/fragment/fragmentHeader.html'); ?>

<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.html';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        ?>

        <div class="alert alert-danger mt-4">
            <h2>Erreur d'insertion</h2>
            <hr>
            <p>Problème d'insertion de la ville.</p>
            
        </div>
    </div>
    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>