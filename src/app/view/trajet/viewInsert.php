<?php
if (!isset($root)) {
  include '../../config.php';
}
require($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
  <div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentMenu.php';
    include $root . '/app/view/fragment/fragmentJumbotron.html';
    ?>

    <h3>
      Ajout d'un trajet
    </h3>
    <p class="lead">Veuillez remplir le formulaire ci-dessous.</p>
    <hr>

    <form role="form" method='post' action='router1.php'>
      <div class="form-group">
        <input type="hidden" name='action' value='trajetCreated'>
        <input type="hidden" name='conducteur_id' value="<?php echo isset($_SESSION['login_id']) ? htmlspecialchars($_SESSION['login_id']) : ''; ?>">
        <input type="hidden" name='statut' value='actif'>

        <label for="ville_depart" class="mt-3 fw-bold">Ville de départ :</label>
        <select class="form-control" id="ville_depart" name="ville_depart" style="width: 400px" required>
          <option value="">-- Sélectionner une ville --</option>
          <?php
          foreach ($ville as $v) {
            printf("<option value='%s'>%s</option>", htmlspecialchars($v->getId()), htmlspecialchars($v->getNom()));
          }
          ?>
        </select>
        <label for="ville_arrivee" class="mt-3 fw-bold">Ville d'arrivée :</label>
        <select class="form-control" id="ville_arrivee" name="ville_arrivee" style="width: 400px" required>
          <option value="">-- Sélectionner une ville --</option>
          <?php
          foreach ($ville as $v) {
            printf("<option value='%s'>%s</option>", htmlspecialchars($v->getId()), htmlspecialchars($v->getNom()));
          }
          ?>
        </select>
        <label for="vehicule_id" class="mt-3 fw-bold">Véhicule :</label>
        <select class="form-control" id="vehicule_id" name="vehicule_id" style="width: 400px" required>
          <option value="">-- Sélectionner un véhicule --</option>
          <?php
          foreach ($vehicule as $vehi) {
            printf("<option value='%s'>%s %s ( %s )</option>", htmlspecialchars($vehi->getId()), htmlspecialchars($vehi->getMarque()), htmlspecialchars($vehi->getModele()), htmlspecialchars($vehi->getImmat()));
          }
          ?>
        </select>
        <label class='w-25 mt-3 fw-bold' for="prix">Prix du trajet : </label><input type="number" min="0" step="0.01" name='prix' size='75' value='' class="form-control" required> <br />
        <label class='w-25 mt-3 fw-bold' for="date_depart">Date du trajet : </label><input type="date" name='date_depart' size='75' value='' class="form-control" min="<?= date('2026-01-01') ?>" max="<?= date('2030-12-31') ?>" required> <br />
        <label class='w-25 mt-3 fw-bold' for="heure_depart">Heure du trajet : </label><input type="time" name='heure_depart' size='75' value='' class="form-control" required> <br />
      </div>
      <p />
      <br />
      <button class="btn btn-primary" type="submit">Ajouter un trajet</button>
    </form>
    <p />
  </div>
  <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?></output>