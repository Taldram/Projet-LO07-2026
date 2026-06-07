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
            echo ("<h3>Le trajet a bien été réservé. </h3>");
            echo ("<ul>");
            //echo ("<li>marque = " . $_GET['marque'] . "</li>");
            //echo ("<li>modele = " . $_GET['modele'] . "</li>");
            //echo ("<li>annee = " . $_GET['annee'] . "</li>");
            //echo ("<li>immatriculation = " . $_GET['immatriculation'] . "</li>");
            echo ("</ul>");
        }

        echo ("</div>");

        include $root . '/app/view/fragment/fragmentFooter.html';
        ?>
    </div>
</body>