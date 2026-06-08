<?php
require ($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
  <div class="container">
      <?php
      include $root . '/app/view/fragment/fragmentMenu.php';
      include $root . '/app/view/fragment/fragmentJumbotron.html';
      ?>

      <?php
      if (isset($_SESSION['cloturer_error']) && !empty($_SESSION['cloturer_error'])) {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
          echo htmlspecialchars($_SESSION['cloturer_error']);
          echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
          echo '<span aria-hidden="true">&times;</span></button></div>';
          unset($_SESSION['cloturer_error']);
      }
      if (isset($_SESSION['cloturer_success']) && !empty($_SESSION['cloturer_success'])) {
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
          echo htmlspecialchars($_SESSION['cloturer_success']);
          echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
          echo '<span aria-hidden="true">&times;</span></button></div>';
          unset($_SESSION['cloturer_success']);
      }
      ?>

    <form role="form" method="post" action="router1.php" class="mb-4">
      <input type="hidden" name="action" value="trajetCloturered">
      <div class="form-group">
        <label for="trajet_id" class="mt-3">Sélectionnez un trajet actif à clôturer :</label><br><br>
        <select class="form-control" id="trajet_id" name="trajet_id" style="width: 450px" required>
          <option value="">-- Choisir un trajet --</option>
          <?php
          foreach ($trajets as $trajet) {
            printf(
              "<option value='%d'>%s --> %s le %s à %s</option>",
              $trajet->getId(),
              htmlspecialchars($trajet->getVille_depart()),
              htmlspecialchars($trajet->getVille_arrivee()),
              htmlspecialchars($trajet->getDate_depart()),
              htmlspecialchars($trajet->getHeure_depart())
            );
          }
          ?>
        </select>
      </div>
      <p></p>
      <button class="btn btn-danger" type="submit" onclick="return confirm('Êtes-vous sûr de vouloir clôturer ce trajet ? Les paiements seront effectués immédiatement.');">Clôturer le trajet</button>
    </form>
  </div>
  <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>
