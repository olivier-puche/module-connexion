<?php
session_start();

$baseddonnees = new PDO('mysql:host=localhost;dbname=moduleconnexion', 'root', '');  

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="XXX.css">
    <title>Accueil : Vivre autrement</title>
</head>

<body>

    <header>
        <h1>VIVRE AUTREMENT</h1>
    </header>

    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <?php 
                if (isset ($_SESSION['id'])) 
                    {?> 
                    <li class="active"><a href="profil.php">Modifier profil</a></li>
                    <li class="active"><a href="deconnexion.php">Déconnexion</a></li>
                    <?php }  
                else 
                    { ?>
                    <li class="active"><a href="inscription.php">Formulaire Inscription</a></li>
                    <li class="active"><a href="connexion.php">Connexion</a></li> 
                    <?php }
            ?> 
        </ul>
    </nav>

    <main>

<!-- PRÉSENTATION DU SITE, accès depuis la page connexion, avec un utilisateur existant -->

    </main>

    <footer>
        <p>© Copyright interdit. Tous droits réservés.</p>
    </footer>

</body>

</html>
