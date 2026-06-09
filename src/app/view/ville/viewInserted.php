<?php
require($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.php';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        ?>
        <!-- ===================================================== -->
        <?php
        if ($results !== false) {
            echo ("<h3>La nouvelle ville a été ajoutée </h3>");
            echo ("<ul>");
            echo ("<li>id = " . $results . "</li>");
            echo ("<li>nom = " . htmlspecialchars($nom) . "</li>");
            echo ("</ul>");
        }
        ?>
        <a href="router1.php?action=villeReadAll" class="btn btn-primary mt-3">Voir les villes</a>
    </div>
      <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>
</body>