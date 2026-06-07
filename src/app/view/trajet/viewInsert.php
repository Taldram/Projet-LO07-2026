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
        <input type="hidden" name='action' value='trajetCreated'><br/>
        <label for="proprietaire" class="mt-3">Ville de départ :</label> <br> <br>
        <select class="form-control" id="ville_depart" name="ville_depart" style="width: 400px" required>
          <?php
          foreach ($ville as $ville) {
            printf("<option value='%d'>%s %s</option>",  
            $ville->getNom(), 
        );
          }
          ?>
        </select>
        <label class='w-25' for="ville_arrivee" class="form-label" >Ville d'arrivée : </label><input type="text" name='ville_arrivee' size='75' value=''> <br/>
        <label class='w-25' for="vehicule_id" class="form-label" >Sélection du véhicule : </label><input type="selection" min="0" step="1" name='vehicule_id' size='75' value='0'> <br/>
        <label class='w-25' for="prix" class="form-label" >Prix du trajet : </label><input type="number" min="0" step="0.01" name='prix' size='75' value=''> <br/>
        <label class='w-25' for="date" class="form-label" >Date du trajet : </label><input type="date" name='date' size='75' value=''> <br/> 
        <label class='w-25' for="heure" class="form-label" >Heure du trajet : </label><input type="time" name='heure' size='75' value=''> <br/> 
        <input type="hidden" name='role' value='<?php echo htmlspecialchars($role); ?>'>
      </div>
      <p/>
       <br/> 
      <button class="btn btn-primary" type="submit">Ajouter un <?php echo htmlspecialchars($role); ?></button>
    </form>
    <p/>
  </div>
  <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?></output>
