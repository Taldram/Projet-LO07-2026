<?php require($root . '/app/view/fragment/fragmentHeader.html'); ?>

<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.php';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        ?>

        <div class="alert alert-info mt-4 shadow-sm border-0">
            <h2 class="alert-heading text-info">
                Optimisation Globale de l'Architecture MVC
            </h2>
            <p class="lead">Réduire la redondance et simplifier la relecture.</p>
            <hr>

            <h4>Une arborescence claire, mais un code répétitif</h4>
            <p>
                L'architecture MVC étudiée en cours offre une excellente lisibilité des dossiers. Cependant, elle induit la répétition systématique de deux éléments majeurs :
            </p>
            <ul>
                <li><strong>Côté Contrôleur :</strong> La construction fastidieuse du chemin absolu (avec "root") et l'inclusion de la vue à chaque fin de méthode.</li>
                <li><strong>Côté Vue :</strong> L'inclusion systématique des 4 fragments (Header, Menu, Jumbotron, Footer) dans absolument tous les fichiers d'affichage.</li>
            </ul>

            <hr>

            <div class="row mt-4">
                <h4 class="text-primary">1. Le "Base Controller"</h4>
                <p>
                    L'idée est de créer une classe parente <code>Controller</code> possédant une méthode universelle <code>render()</code>. Tous les autres contrôleurs du projet en héritent. C'est le même principe que <code>getInstance()</code> qui est utilisée dans tous les modèles.
                </p>

                <h4 class="text-primary">2. Le "Layout Global"</h4>
                <p>
                    Création d'un fichier <code>layout.php</code> unique contenant toute la structure de la page (HTML, Header, Footer). Les vues spécifiques n'injectent plus que leur contenu au centre.
                </p>
            </div>

            <hr>

            <h4>La Valeur Ajoutée</h4>
            <p>
                En combinant ces deux optimisations, le code devient non seulement plus léger à lire, mais surtout infiniment plus facile à maintenir. Si le design global du site (le menu ou le footer) doit évoluer, il n'y a plus qu'un seul fichier à modifier au lieu d'une vingtaine de vues.
            </p>
        </div>

    </div>
    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>