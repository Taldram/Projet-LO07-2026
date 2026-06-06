<?php 
require ($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
  <div class="container">
    <?php
      include $root . '/app/view/fragment/fragmentMenu.php';
      include $root . '/app/view/fragment/fragmentJumbotron.html';
    ?> 

    <form role="form" method='get' action='router1.php'>
      <div class="form-group">
        <input type="hidden" name='action' value='vehiculeCreated'><br/>
        <label class='w-25' for="marque" class="form-label" >Marque : </label><input type="text" name='marque' size='75' value=''> <br/>
        <input type="hidden" name='action' value='vehiculeCreated'><br>
        <label class='w-25' for="modele" class="form-label" >Modèle : </label><input type="text" name='modele' size='75' value=''> <br/>
        <input type="hidden" name='action' value='vehiculeCreated'><br>
        <label class='w-25' for="annee" class="form-label" >Année : </label><input type="text" name='annee' size='75' value=''> <br/> 
        <input type="hidden" name='action' value='vehiculeCreated'><br>
        <label class='w-25' for="immatriculation" class="form-label" >Immatriculation : </label><input type="text" name='immatriculation' size='75' value=''> <br/> 
      </div>
      <p/>
       <br/> 
      <button class="btn btn-primary" type="submit">Ajouter</button>
    </form>
    <p/>
  </div>
  <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>