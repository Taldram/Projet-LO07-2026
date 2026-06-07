<?php require ($root . '/app/view/fragment/fragmentHeader.html'); ?>
<body>
  <div class="container">
    <?php
      include $root . '/app/view/fragment/fragmentMenu.php';
      include $root . '/app/view/fragment/fragmentJumbotron.html';
    ?>
    
    <div class="alert alert-danger" role="alert">
        <h4>Erreur : La réservation a échoué.</h4>
        <hr>
        <?php 
            if (isset($_SESSION['reservation_error'])) {
                echo $_SESSION['reservation_error'];
                // On efface l'erreur une fois qu'elle est affichée
                unset($_SESSION['reservation_error']);
            } else {
                echo "Erreur inconnue (Aucun message reçu).";
            }
        ?>
    </div>
    
  </div>
  <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>