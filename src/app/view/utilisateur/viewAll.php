<?php

require($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
  <div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentMenu.php';
    include $root . '/app/view/fragment/fragmentJumbotron.html';
    ?>

    <h3>Liste des utilisateurs</h3>
    <br>

    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Nom</th>
          <th scope="col">Prenom</th>
          <th scope="col">Role</th>
          <th scope="col">Login</th>
          <th scope="col">Password</th>
          <th scope="col">Solde</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($results as $element) {
          printf(
            "<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>",
            $element->getId(),
            $element->getNom(),
            $element->getPrenom(),
            $element->getRole(),
            $element->getLogin(),
            $element->getPassword(),
            $element->getSolde()
          );
        }
        ?>
      </tbody>
    </table>
  </div>
  <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>