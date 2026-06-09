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
      Ajout d'un véhicule
    </h3>
    <p class="lead">Veuillez remplir le formulaire ci-dessous.</p>
    <hr>

    <form role="form" method='post' action='router1.php'>
      <div class="form-group">
        <input type="hidden" name='action' value='vehiculeCreated'><br />

        <label class='w-25 fw-bold' for="marque">Marque : </label><input type="text" name='marque' size='75' value='' class="form-control"> <br />

        <label class='w-25 fw-bold' for="modele">Modèle : </label><input type="text" name='modele' size='75' value='' class="form-control"> <br />

        <label class='w-25 fw-bold' for="annee">Année : </label><input type="number" name='annee' min='1900' max='2026' step="1" value='' class="form-control"> <br />

        <label class='w-25 fw-bold' for="immatriculation">Immatriculation : </label><input type="text" name='immatriculation' size='75' value='' class="form-control"> <br />

        <label for="proprietaire" class="mt-3 fw-bold">Sélectionnez un proprietaire :</label> <br> <br>
        <select class="form-control" id="proprietaire" name="proprietaire" style="width: 400px" required>
          <?php
          foreach ($conducteurs as $cond) {
            printf(
              "<option value='%d'>%s %s</option>",
              $cond->getId(),
              $cond->getPrenom(),
              $cond->getNom()
            );
          }
          ?>
        </select>
      </div>
      <p />
      <br />
      <button class="btn btn-primary" type="submit">Ajouter un véhicule</button>
    </form>
    <p />
  </div>
  <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>