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
            <th>Date</th>
            <th>Heure</th>
            <th>Départ</th>
            <th>Destination</th>
            <th>Conducteur</th>
            <th>Véhicule</th>
            <th>Immatriculation</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // On boucle sur notre tableau d'objets ModelReservation
        foreach ($results as $element) {
            printf(
                "<tr>
                    <td>%s</td>
                    <td>%s</td>
                    <td>%s</td>
                    <td>%s</td>
                    <td>%s</td>
                    <td>%s</td>
                    <td>%s</td>
                </tr>",
                $element->getDate_depart(),
                $element->getHeure_depart(),
                $element->getDepart(),
                $element->getDestination(),
                $element->getConducteur(),
                $element->getVehicule(),
                $element->getImmat()
            );
        }
        ?>
    </tbody>
</table>
  </div>
  <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>