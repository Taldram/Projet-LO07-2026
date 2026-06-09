<?php require ($root . '/app/view/fragment/fragmentHeader.html'); ?>
<body>
  <div class="container">
    <?php
      include $root . '/app/view/fragment/fragmentMenu.php';
      include $root . '/app/view/fragment/fragmentJumbotron.html';
    ?>
    
    <div class="alert mt-4" role="alert">
        <p>La réservation a été effectuée avec succès ! </p> <br>
        <a href="router1.php?action=reservationReadMine" class="btn btn-primary mt-3">Voir mes réservations</a>
    </div>
    
  </div>
  <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>