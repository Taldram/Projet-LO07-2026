<?php
require ($root . '/app/controller/config.php');
require ($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
  <div class="container">
    <?php
      include $root . '/app/view/fragment/fragmentMenu.php';
      include $root . '/app/view/fragment/fragmentJumbotron.html';
    ?> 

    <h3>Connectez-vous à votre compte</h3>
    <hr>

    <form role="form" method='post' action='router1.php'>
      <div class="form-group">
        <input type="hidden" name='action' value='utilisateurLoginVerif'><br/>
        <label class='w-25' for="login" class="form-label" >Identifiant : </label><input type="text" name='login' size='75' value=''> <br/>
        <label class='w-25' for="password" class="form-label" >Mot de passe: </label><input type="password" name='password' size='75' value=''> <br/>
      </div>
      <p/>
       <br/> 
      <button class="btn btn-success" type="submit">Se connecter</button>
    </form>
    <p/>
  </div>
  <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>