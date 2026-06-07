<?php
require($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
  <div class="container">
    <?php
      include $root . '/app/view/fragment/fragmentMenu.php';
      include $root . '/app/view/fragment/fragmentJumbotron.html';
    ?> 

    <form role="form" method='get' action='router1.php'>
      <div class="form-group">
        <input type="hidden" name='action' value='reservationCreated'><br />

        <label for="trajet_id" class="mt-3">Sélectionnez un trajet :</label> <br> <br>
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