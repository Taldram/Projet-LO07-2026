<?php

require ($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
  <div class="container">
      <?php
      include $root . '/app/view/fragment/fragmentMenu.php';
      include $root . '/app/view/fragment/fragmentJumbotron.html';
      ?>

    <table class="table table-striped table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>Ville de départ</th>
            <th>Ville d'arrivée</th>
            <th>Date de départ</th>
            <th>Heure de départ</th>
            <th>Statut</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($results as $element) {
            printf(
                "<tr>
                    <td>%s</td>
                    <td>%s</td>
                    <td>%s</td>
                    <td>%s</td>
                    <td>%s</td>
                </tr>",
                $element->getVille_depart(),
                $element->getVille_arrivee(),
                $element->getDate_depart(),
                $element->getHeure_depart(),
                $element->getStatut()
            );
        }
        ?>
    </tbody>
</table>
  </div>
  <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>