<?php
require($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.html';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        ?>
        <!-- ===================================================== -->
        <?php
        if ($results) {
            echo ("<h3>La nouvelle ville a été ajouté </h3>");
            echo ("<ul>");
            echo ("<li>id = " . $results . "</li>");
            echo ("<li>cru = " . $_GET['nom'] . "</li>");
            echo ("</ul>");
        }

        echo ("</div>");

        include $root . '/app/view/fragment/fragmentFooter.html';
        ?>
    </div>
</body>