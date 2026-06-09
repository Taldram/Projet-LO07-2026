<?php require($root . '/app/view/fragment/fragmentHeader.html'); ?>
<body>
  <div class="container">
    <?php
      include $root . '/app/view/fragment/fragmentMenu.php';
      include $root . '/app/view/fragment/fragmentJumbotron.html';
    ?>
    <h3>10 nouvelles réservations aléatoires</h3> 
    <hr>
    
    <ol>
      <?php
      if (!empty($messages)) {
          foreach ($messages as $msg) {
              echo "<li>" . htmlspecialchars($msg) . "</li>";
          }
      } else {
          echo "<li>Aucune réservation n'a pu être générée.</li>";
      }
      ?>
    </ol>

  </div>
  <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>