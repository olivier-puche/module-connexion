<?php
session_start();
 
$baseddonnees = new PDO('mysql:host=localhost;dbname=moduleconnexion', 'root', ''); 
 
if(isset($_SESSION['id'])) 
{
   $requser = $baseddonnees->prepare("SELECT * FROM utilisateurs WHERE id = ?");
   $requser->execute(array($_SESSION['id']));
   $user = $requser->fetch();

   if(isset($_POST['newsurname']) AND !empty($_POST['newsurname']) AND $_POST['newsurname'] != $user['surname']) 
   {
      $newsurname = htmlspecialchars($_POST['newsurname']);
      $insertsurname = $baseddonnees->prepare("UPDATE utilisateurs SET surname = ? WHERE id = ?");
      $insertsurname->execute(array($newsurname, $_SESSION['id']));
   }
   
   if(isset($_POST['newname']) AND !empty($_POST['newname']) AND $_POST['newname'] != $user['name']) 
   {
      $newname = htmlspecialchars($_POST['newname']);
      $insertname = $baseddonnees->prepare("UPDATE utilisateurs SET name = ? WHERE id = ?");
      $insertname->execute(array($newname, $_SESSION['id']));
   }

   if(isset($_POST['newemail']) AND !empty($_POST['newemail']) AND $_POST['newemail'] != $user['email']) 
   {
      $newemail = htmlspecialchars($_POST['newemail']);
      $insertemail = $baseddonnees->prepare("UPDATE utilisateurs SET email = ? WHERE id = ?");
      $insertemail->execute(array($newemail, $_SESSION['id']));
   }

   if(isset($_POST['newlogin']) AND !empty($_POST['newlogin']) AND $_POST['newlogin'] != $user['login']) 
   {
      $newlogin = htmlspecialchars($_POST['newlogin']);
      $insertlogin = $baseddonnees->prepare("UPDATE utilisateurs SET login = ? WHERE id = ?");
      $insertlogin->execute(array($newlogin, $_SESSION['id']));
   }

   if(isset($_POST['newpassword1']) AND !empty($_POST['newpassword1']) AND isset($_POST['newpassword2']) AND !empty($_POST['password2']) != $user['password']) 
   {
      $password1 = sha1($_POST['newpassword1']);
      $password2 = sha1($_POST['newpassword2']);

      // echo ('test'); A permis de contrôler que la boucle MOT DE PASSE fonctionne

      //var_dump ($password1); A permis de contrôler que les mots de passes fonctionnent
      //var_dump ($password2);
      
      if($password1 == $password2) 
      {
         $insertpassword = $baseddonnees->prepare("UPDATE utilisateurs SET password = ? WHERE id = ?");
         $insertpassword->execute(array($password1, $_SESSION['id']));
      } 
      else 
      {
         $msg = "Vos deux mots de passes ne correspondent pas !";
      }
   }

   // var_dump($_POST); Affichage du Post
   // var_dump($_SESSION); Affichage de la session
   
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="XXX.css">
    <title>Mon profil</title>
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
                    <li class="active"><a href="connexion.php">Connexion</a></li>
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
   <body>

      <main>  
        <div align="center">
            <h2>Edition de mon profil</h2>
                <form method="post" action="profil.php">
                <label>Prénom</label>
                <input type="text" name="newsurname" placeholder="surname" value="<?php echo $_POST['newsurname'];?>"><br><br>

                  <!-- A permis de contôler que les changements sont pris en compte -->

                <label>Nom</label>
                <input type="text" name="newname" placeholder="name" value="<?php echo $user['name']; ?>" /><br /><br />
                <label>Mail</label>
                <input type="text" name="newemail" placeholder="mail" value="<?php echo $user['email']; ?>" /><br /><br />
                <label>Login</label>
                <input type="text" name="newlogin" placeholder="login" value="<?php echo $user['login']; ?>" /><br /><br />
                <label>Password</label>
                <input type="password" name="newpassword1" placeholder="Mot de passe"/><br /><br />
                <label>Confirmer password</label>
                <input type="password" name="newpassword2" placeholder="Confirmer mot de passe" /><br /><br />
                <button type="submit">Mettre à jour mon profil !</button>
                </form>
                <?php 
                
                if(isset($msg)) 
                  {echo $msg; } 
                
                ?>
        </div>
     </main>

     <footer>
        <p>© Copyright interdit. Tous droits réservés.</p>
    </footer>
   </body>

</html>

<?php
}
?>