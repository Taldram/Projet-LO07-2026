<?php 
require ($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
  <div class="container">
    <?php
      include $root . '/app/view/fragment/fragmentMenu.html';
      include $root . '/app/view/fragment/fragmentJumbotron.html';
    ?> 

    <form role="form" method='get' action='router1.php'>
      <div class="form-group">
        <input type="hidden" name='action' value='utilisateurCreated'><br/>
        <label class='w-25' for="nom" class="form-label" >Nom : </label><input type="text" name='nom' size='75' value=''> <br/>
        <input type="hidden" name='action' value='utilisateurCreated'><br>
        <label class='w-25' for="prenom" class="form-label" >Prénom : </label><input type="text" name='prenom' size='75' value=''> <br/>
        <input type="hidden" name='action' value='utilisateurCreated'><br>
        <label class='w-25' for="role" class="form-label" >Rôle : </label><input type="text" name='role' size='75' value=''> <br/> 
        <input type="hidden" name='action' value='utilisateurCreated'><br>
        <label class='w-25' for="login" class="form-label" >Login : </label><input type="text" name='login' size='75' value=''> <br/> 
        <input type="hidden" name='action' value='utilisateurCreated'><br>
        <label class='w-25' for="password" class="form-label" >Password : </label><input type="text" name='password' size='75' value=''> <br/> 
        <input type="hidden" name='action' value='utilisateurCreated'><br>
        <label class='w-25' for="solde" class="form-label" >Solde : </label><input type="text" name='solde' size='75' value=''> <br/> 
      </div>
      <p/>
       <br/> 
      <button class="btn btn-primary" type="submit">Ajouter</button>
    </form>
    <p/>
  </div>
  <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>