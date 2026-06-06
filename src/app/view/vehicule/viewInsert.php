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
        <input type="hidden" name='action' value='vehiculeCreated'><br />

        <label class='w-25' for="marque" class="form-label">Marque : </label><input type="text" name='marque' size='75' value=''> <br />

        <label class='w-25' for="modele" class="form-label">Modèle : </label><input type="text" name='modele' size='75' value=''> <br />

        <label class='w-25' for="annee" class="form-label">Année : </label><input type="number" name='annee' min='1900' max='2026' step="1" value=''> <br />

        <label class='w-25' for="immatriculation" class="form-label">Immatriculation : </label><input type="text" name='immatriculation' size='75' value=''> <br />

        <label for="proprietaire" class="mt-3">Sélectionnez un proprietaire :</label> <br> <br>
        <select class="form-control" id="proprietaire" name="proprietaire" style="width: 400px" required>
          <?php
          foreach ($conducteurs as $cond) {
            printf("<option value='%d'>%s %s</option>", 
            $cond->getId(), 
            $cond->getNom(), 
            $cond->getPrenom()
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