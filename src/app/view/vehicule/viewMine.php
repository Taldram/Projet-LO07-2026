<?php

require($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
  <div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentMenu.php';
    include $root . '/app/view/fragment/fragmentJumbotron.html';
    ?>

    <h3>Listes de mes véhicules</h3> 
    <br>

    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th scope="col">Marque</th>
          <th scope="col">Modèle</th>
          <th scope="col">Année</th>
          <th scope="col">Immatriculation</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($results as $element) {
          printf(
            "<tr><td>%s</td><td>%s</td><td>%d</td><td>%s</td></tr>",
            $element->getMarque(),
            $element->getModele(),
            $element->getAnnee(),
            $element->getImmat()
          );
        }
        ?>
      </tbody>
    </table>
  </div>
  <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>