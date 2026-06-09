<?php
require($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
  <div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentMenu.php';
    include $root . '/app/view/fragment/fragmentJumbotron.html';

    if (htmlspecialchars($role) == "conducteur") {
      echo "<h3>Ajouter un conducteur</h3>";
      } else {
        echo "<h3>Ajouter un passager</h3>";
      }
    ?>
    <p class="lead">Veuillez remplir le formulaire ci-dessous.</p>
    <hr>

    

    <form role="form" method='post' action='router1.php'>
      <div class="form-group">
        <input type="hidden" name='action' value='utilisateurCreated'><br />
        <label class='w-25 fw-bold' for="nom">Nom : </label><input type="text" name='nom' size='75' value='' class="form-control"> <br />
        <input type="hidden" name='action' value='utilisateurCreated'><br>
        <label class='w-25 fw-bold' for="prenom">Prénom : </label><input type="text" name='prenom' size='75' value='' class="form-control"> <br />
        <input type="hidden" name='action' value='utilisateurCreated'><br>
        <label class='w-25 fw-bold' for="solde">Solde initial : </label><input type="number" min="0" step="1" name='solde' value='0' class="form-control"> <br />
        <input type="hidden" name='action' value='utilisateurCreated'>
        <input type="hidden" name='role' value='<?php echo htmlspecialchars($role); ?>'>
      </div>
      <p />
      <br />
      <button class="btn btn-primary" type="submit">Ajouter un <?php echo htmlspecialchars($role); ?></button>
    </form>
    <p />
  </div>
  <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?></output>