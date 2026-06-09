<?php require($root . '/app/view/fragment/fragmentHeader.html'); ?>

<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.php';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        ?>

        <div class="alert mt-4 border-0">
            <h2 class="alert-heading text-success">
                L'Éco-Compteur BlaBlaCar
            </h2>
            <p class="lead">Récompenser et visualiser l'impact écologique des utilisateurs.</p>
            <hr>

            <div class="row text-center my-4">
                <div class="col-md-6">
                    <h4 class="text-muted">CO2 Économisé</h4>
                    <span class="display-4 font-weight-bold text-success">145 kg</span>
                </div>
                <div class="col-md-6">
                    <h4 class="text-muted">Trajets Partagés</h4>
                    <span class="display-4 font-weight-bold text-success">12</span>
                </div>
            </div>

            <hr>

            <h4>En pratique :</h4>
            <ul>
                <li><strong>Calcul des distances :</strong> En utilisant les clés étrangères de la table <code>trajet</code>, l'application calcule le kilométrage soit via une table de distances préétablie, soit via une API cartographique telle que Open Street Maps.</li>
                <li><strong>Exploitation des données :</strong> On croise ce kilométrage avec le nombre de passagers présents dans la table <code>reservation</code>. Au lieu de faire chacun des trajets séparés, ces utilisateurs n'utilisent qu'une seule voiture, ce qui nous permet de déduire le CO2 économisé.</li>
                <li><strong>Valeur ajoutée :</strong> Afficher ce compteur permet de "gamifier" l'interface et par le même temps le rendre plus ludique. De plus, c'est une information qu'il devient intéressant de mentionner dans le contexte climatique actuel.</li>
            </ul>
        </div>
    </div>

    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>