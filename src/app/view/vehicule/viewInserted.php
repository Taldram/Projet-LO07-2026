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
        if ($results) {
            echo ("<h3>Le nouveau véhicule a été ajouté </h3>");
            echo ("<ul>");
            echo ("<li>marque = " . $_POST['marque'] . "</li>");
            echo ("<li>modele = " . $_POST['modele'] . "</li>");
            echo ("<li>annee = " . $_POST['annee'] . "</li>");
            echo ("<li>immatriculation = " . $_POST['immatriculation'] . "</li>");
            echo ("</ul>");
        }

        echo ("</div>");

        include $root . '/app/view/fragment/fragmentFooter.html';
        ?>
    </div>
</body>