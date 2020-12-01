<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="XXX.css">
    <title>Page administrateur</title>
</head>

<body>

    <header>
        <h1>VIVRE AUTREMENT</h1>
    </header>

    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="inscription.php">Formulaire d'inscription</a></li>
            <li><a href="connexion.php">Connexion</a></li>
            <li><a href="profil.php">Modifier profil</a></li>
            <li><a href="deconnexion.php">Déconnexion</a></li>
        </ul>
    </nav>
   
    <main>
        <div align="center">    
            <h2>Tableau de données</h2>
        </div>     
    </main>
    
<?php

if(!isset($_SESSION['login']))
{
    header('location: connexion.php');
    exit();
}

$baseddonnees = new PDO('mysql:host=localhost;dbname=moduleconnexion', 'root', '');  
$dataquery = $baseddonnees -> prepare ("SELECT * FROM utilisateurs");
$dataquery->execute();

$i=0;

echo "<div class=\"table\"><table>";

while ($result = $dataquery-> fetch(PDO::FETCH_ASSOC))
{
  if ($i == 0)
  {
    foreach ($result as $key => $value)
    {
      echo "<th>$key</th>";
    }
    $i++;
  }
  echo "<tr>";
  foreach ($result as $key => $value) 
  {
    echo "<td>$value</td>";
  }
  echo "</tr>";
}

echo "</div></table>";

?>

    <footer>
        <p>© Copyright interdit. Tous droits réservés.</p>
    </footer>

</body>

</html>

<?php $baseddonnees = null ?>