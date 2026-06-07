<?php
require ($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
  <div class="container">
      <?php
      include $root . '/app/view/fragment/fragmentMenu.php';
      include $root . '/app/view/fragment/fragmentJumbotron.html';
      ?>

    <form role="form" method="get" action="router1.php" class="mb-4">
      <input type="hidden" name="action" value="trajetReadPassagers">
      <div class="form-group">
        <label for="trajet_id" class="mt-3">Sélectionnez un trajet actif :</label><br><br>
        <select class="form-control" id="trajet_id" name="trajet_id" style="width: 450px" required>
          <option value="">-- Choisir un trajet --</option>
          <?php
          $trajetSelectionne = $trajetId ?? null;
          foreach ($trajets as $trajet) {
            $selected = ($trajetSelectionne !== null && intval($trajetSelectionne) === intval($trajet->getId())) ? "selected" : "";
            printf(
              "<option value='%d' %s>%s --> %s le %s à %s</option>",
              $trajet->getId(),
              $selected,
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
      <button class="btn btn-primary" type="submit">Afficher les passagers</button>
    </form>

    <?php if (isset($trajetId) && $trajetId !== null && $trajetId > 0): ?>
      <h4 class="mb-3">Passagers du trajet sélectionné</h4>
      <table class="table table-striped table-bordered">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($results && count($results) > 0) {
            foreach ($results as $element) {
              printf(
                "<tr><td>%s</td><td>%s</td></tr>",
                htmlspecialchars($element->getNom()),
                htmlspecialchars($element->getPrenom())
              );
            }
          } else {
            echo "<tr><td colspan='2'>Aucun passager n'a réservé ce trajet.</td></tr>";
          }
          ?>
        </tbody>
      </table>
    <?php endif; ?>
  </div>
  <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>