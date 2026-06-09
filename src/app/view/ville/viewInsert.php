<?php 
require ($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
  <div class="container">
    <?php
      include $root . '/app/view/fragment/fragmentMenu.php';
      include $root . '/app/view/fragment/fragmentJumbotron.html';
    ?> 

    <h3>
      Ajout d'une ville
    </h3>
    <p class="lead">Veuillez remplir le formulaire ci-dessous.</p>
    <hr>

    <form role="form" method='post' action='router1.php'>
      <div class="form-group">
        <input type="hidden" name='action' value='villeCreated'>        
        <label class='w-25' for="id">nom : </label><input type="text" name='nom' size='75' value=''> <br/>                                 
      </div>
      <p/>
       <br/> 
      <button class="btn btn-success" type="submit">Ajouter la ville</button>
    </form>
    <p/>
  </div>
  <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>