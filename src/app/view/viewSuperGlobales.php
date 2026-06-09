<?php

require($root . '/app/view/fragment/fragmentHeader.html'); ?>

<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.php';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        ?>

        <div class="mt-4">
            <h3>Variables Superglobales</h3>
            <hr>

            <h4>Contenu de $_SESSION</h4>
            <div class="alert alert-secondary">
                <pre><?php print_r($_SESSION); ?></pre>
            </div>

            <h4 class="mt-4">Contenu de $_COOKIE</h4>
            <div class="alert alert-secondary">
                <pre><?php print_r($_COOKIE); ?></pre>
            </div>

        </div>

    </div>
    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>
</body>