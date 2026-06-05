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
          <th scope = "col">id</th>
          <th scope = "col">nom</th>
          <th scope = "col">prenom</th>
          <th scope = "col">role</th>
          <th scope = "col">login</th>
          <th scope = "col">password</th>
          <th scope = "col">solde</th>
        </tr>
      </thead>
      <tbody>
          <?php           
          foreach ($results as $element) {
           printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", $element->getId(), 
             $element->getNom(),$element->getPrenom(),$element->getRole(),$element->getLogin(),$element->getPassword(),$element->getSolde());
          }
          ?>
      </tbody>
    </table>
  </div>
  <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>