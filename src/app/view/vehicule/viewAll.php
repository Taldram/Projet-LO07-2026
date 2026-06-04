<?php

require ($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
  <div class="container">
      <?php
      include $root . '/app/view/fragment/fragmentMenu.html';
      include $root . '/app/view/fragment/fragmentJumbotron.html';
      ?>

    <table class = "table table-striped table-bordered">
      <thead>
        <tr>
          <th scope = "col">marque</th>
          <th scope = "col">modele</th>
          <th scope = "col">année</th>
          <th scope = "col">immatriculation</th>
          <th scope = "col">propriétaire</th>
        </tr>
      </thead>
      <tbody>
          <?php           
          foreach ($results as $element) {
           printf("<tr><td>%s</td><td>%s</td><td>%d</td><td>%s</td><td>%s</td></tr>", $element->getMarque(), 
             $element->getModele(),$element->getAnnee(),$element->getImmat(),$element->getProprio());
          }
          ?>
      </tbody>
    </table>
  </div>
  <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>