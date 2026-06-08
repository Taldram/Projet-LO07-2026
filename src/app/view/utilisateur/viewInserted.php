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
            echo ("<h3>Le nouvel utilisateur a été ajouté </h3>");
            echo ("<ul>");
            echo ("<li>id = " . $results . "</li>");
            echo ("<li>nom = " . ($nom ?? '') . "</li>");
            echo ("<li>prenom = " . ($prenom ?? '') . "</li>");
            echo ("<li>role = " . ($role ?? '') . "</li>");
            echo ("<li>solde = " . ($solde ?? '') . "</li>");
            echo ("</ul>");
        }

        echo ("</div>");

        include $root . '/app/view/fragment/fragmentFooter.html';
        ?>
    </div>
</body>