<?php 
require ($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
  <div class="container">
    <?php
      include $root . '/app/view/fragment/fragmentMenu.php';
      include $root . '/app/view/fragment/fragmentJumbotron.html';
    ?> 

    <form role="form" method='post' action='router1.php'>
      <div class="form-group">
        <input type="hidden" name='action' value='utilisateurCreated'><br/>
        <label class='w-25' for="nom" class="form-label" >Nom : </label><input type="text" name='nom' size='75' value=''> <br/>
        <input type="hidden" name='action' value='utilisateurCreated'><br>
        <label class='w-25' for="prenom" class="form-label" >Prénom : </label><input type="text" name='prenom' size='75' value=''> <br/>
        <input type="hidden" name='action' value='utilisateurCreated'><br>
        <label class='w-25' for="solde" class="form-label" >Solde initial : </label><input type="number" min="0" step="1" name='solde' size='75' value='0'> <br/> 
        <input type="hidden" name='action' value='utilisateurCreated'>
        <input type="hidden" name='role' value='<?php echo htmlspecialchars($role); ?>'>
      </div>
      <p/>
       <br/> 
      <button class="btn btn-primary" type="submit">Ajouter un <?php echo htmlspecialchars($role); ?></button>
    </form>
    <p/>
  </div>
  <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?></output>
