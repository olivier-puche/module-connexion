<?php
session_start();

$baseddonnees = new PDO('mysql:host=localhost;dbname=moduleconnexion', 'root', '');  

/* Utilisation de PDO, plutôt que mysqli, pour se préparer aux prochains projets et surtout, 
plus simple d'un point de vue littéral et de meilleurs tutos */

if(isset($_POST['forminscription'])) /* Les actions doivent se déclencher à partir du bouton s'inscrire */
{
    $surname = htmlspecialchars($_POST['surname']);
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $email2 = htmlspecialchars($_POST['email2']);
    $login = htmlspecialchars($_POST['login']);
    $password = sha1($_POST['password']);
    $password2 = sha1($_POST['password2']);

    if(!empty($_POST['surname']) AND !empty($_POST['name']) AND !empty($_POST['email']) AND !empty($_POST['email2']) AND !empty($_POST['login']) AND !empty($_POST['password'])AND !empty($_POST['password2']))
    /* Cette condition fait doublon avec required dans html, il faudra choisir, dans les prochains jobs */
    {  
        $namelength = strlen($name);
        
        if($namelength <= 255)
        /* Voir Laurie pour approfondir les conditions sur l'ensemble des critères, faire des if supplémentaires */
       {
          if($email == $email2) 
          {
             if(filter_var($email, FILTER_VALIDATE_EMAIL)) 
             {
                $reqmail = $baseddonnees->prepare("SELECT * FROM utilisateurs WHERE email = ?");
                $reqmail->execute(array($email));
                $mailexist = $reqmail->rowCount();
                
                if($mailexist == 0) 
                {
                   if($password == $password2) 
                   {
                      $insertuser = $baseddonnees->prepare("INSERT INTO utilisateurs(surname, name, email, login, password) VALUES(?, ?, ?, ?, ?)");
                      $insertuser->execute(array($surname, $name, $email, $login, $password));
                      $erreur = "Votre compte a bien été créé ! <a href=\"connexion.php\">Me connecter</a>";
                   } 
                   else 
                   {
                      $erreur = "Votre mots de passes ne correspondent pas !";
                   }
                } 
                else 
                {
                   $erreur = "L'adresse mail est déjà utilisée !";
                }
             } 
             else 
             {
                $erreur = "Votre adresse mail n'est pas valide !";
             }
          } 
          else 
          {
             $erreur = "Vos adresses mail ne correspondent pas !";
          }
       } 
       else 
       {
          $erreur = "Votre nom ne doit pas dépasser 255 caractères !";
       }
    } 
    else 
    {
        $erreur = "Tous les champs doivent être complétés !";
    }

 } 
 ?>

<!DOCTYPE html> <!--/ Attention doit renvoyer vers la page connexion //-->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="XXX.css">
    <title>Inscription</title>
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
    <div align="center">    
         <h2>Inscription</h2>

        <form method="post" action="inscription.php">
            <div>
            <label for="surname">Prénom</label>
            <input type="text" id="surname" name="surname" required>
            <br><br>
            </div>
            <div>
            <label for="name">Nom</label>
            <input type="text" id="name" name="name" required>
            <br><br>
            </div>
            <div>
            <label for="email">Adresse e-mail</label>
            <input id="email" type="email" name="email"  placeholder="Saisir une adresse email valide" size="30" maxLength="64" required>
            <br><br>
            </div>
         
         <!-- À complèter lors d'un prochain travail : placeholder="nomutilisateur@beststartupever.com" pattern=".+@beststartupever.com" 
         title="Merci de fournir uniquement une adresse Best Startup Ever" -->

            <div>
            <label for="email2">Confirmez e-mail</label>
            <input id="email2" type="email" name="email2" size="30" maxLength="64" required>
            <br><br>
            </div>
            <div>
            <label for="name">Login</label>
            <input type="text" id="login" name="login" placeholder="Saisir un pseudo unique" required>
            <br><br>
            </div>
            <div>
            <label for="name">Password</label>
            <input type="password" id="password" name="password" placeholder="10 caractères minimum"  required>
            <br><br>
            </div>
            <div>
            <label for="name">Confirmer Password</label>
            <input type="password" id="password2" name="password2" required>
            <br><br>
            </div>
            <div>
            <input type="submit" name="forminscription" value="Je m'inscris"/>
            </div>
        </form>

<?php

    if(isset($erreur))
     
      {echo '<font color="red">'.$erreur."</font>";}

?>

    </div>
    </main>

    <footer>
        <p>© Copyright interdit. Tous droits réservés.</p>
    </footer>

</body>

 <!--  Code pour paramétrer un mot de passe avec majuscule, chiffre, caractère spécial, à tester plus tard

if(preg_match((?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$), $_POST['password']) 
{ echo 'OK';

else
echo 'Saisir au moins, 1 majusucle, 1 chiffre et un caractère spécial}; -->

</html>

