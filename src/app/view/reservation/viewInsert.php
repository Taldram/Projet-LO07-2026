<?php
require($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
  <div class="container">
    <?php
      include $root . '/app/view/fragment/fragmentMenu.php';
      include $root . '/app/view/fragment/fragmentJumbotron.html';
    ?> 

    <h3>
      Réservation d'un trajet
    </h3>
    <p class="lead">Veuillez remplir le formulaire ci-dessous.</p>
    <hr>

    <form role="form" method='post' action='router1.php'>
      <div class="form-group">
        <input type="hidden" name='action' value='reservationCreated'>

        <label for="trajet_id" class="mt-3 fw-bold">Sélectionnez un trajet :</label>
        <select class="form-control" id="trajet_id" name="trajet_id" style="width: 400px" required>
          <?php
          foreach ($trajets as $trajet) {
            printf("<option value='%d'>%s --> %s le %s à %s</option>", 
            $trajet->getId(), 
            $trajet->getDepart(), 
            $trajet->getDestination(),
            $trajet->getDate(),
            $trajet->getHeure()
        );
          }
          ?>
        </select>
      </div>
      <p />
      <br />
      <button class="btn btn-primary" type="submit">Confirmer la réservation</button>
    </form>
    <p />
  </div>
  <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>