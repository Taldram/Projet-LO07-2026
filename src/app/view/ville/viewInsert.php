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
        <input type="hidden" name='action' value='villeCreated'>        
        <label class='w-25' for="id">nom : </label><input type="text" name='nom' size='75' value='troyes'> <br/>                                 
      </div>
      <p/>
       <br/> 
      <button class="btn btn-primary" type="submit">Ajouter</button>
    </form>
    <p/>
  </div>
  <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>