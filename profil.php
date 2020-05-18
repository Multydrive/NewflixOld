<?php
session_start();
if (isset($_SESSION['pseudo']) )
 {

 ?>
<!DOCTYPE html>
<html lang = "fr">

	<head>
			<?php
				// Infos communes a toutes les pages pour le head HTML
        require_once('head.php');
      ?>
	</head>
	<body>

		   <?php
		   		// Connexion à la base de données et menu du site
          if ($_SESSION['pseudo']=='admin@heh.be')
          {
            require_once('connexion.php');
          }
          else
          {
            require_once('connexion_user_lambda.php');
          }
          require_once('menu.php');
       ?>

		<div id = "txtOk"> </div>

		<?php
      $mail = $_SESSION['pseudo'];
			// On récupère tout le contenu de la table users
			$reponse=$bd->prepare("SELECT * FROM users WHERE Adresse_mail = '$mail' ");
			$reponse->execute();
			// On affiche les infos sur l'utilisateur courant
			while ($donnees = $reponse->fetch())
			{
		?>
		<br>
    <div id="main">
    <?php
    if ($_SESSION['pseudo']=='admin@heh.be')
    {
    ?>

    <div id="navleft">
      <a href="profil.php?c=1">PROFIL</a>
      <a href="profil.php?c=2">CONTENU</a>
      <a href="profil.php?c=4">UTILISATEURS</a>
    </div>

    <?php
    }
    else {
     ?>

   <div id="navleft">
     <a href="profil.php?c=1">PROFIL</a>
     <a href="profil.php?c=2">CONTENU</a>
     <a href="profil.php?c=3">MESSAGES</a>
   </div>

 <?php
    }
    if (isset($_GET['c']))
		{
			if ($_GET['c'] == 1)
			{
  ?>

		<section class="Infos">
				<?php
					echo '<img src='.$donnees['Photo'].'width="120px" height="160px"
					alt=" '.$donnees['Nom']." ".$donnees['Prenom'].' " title="'.$donnees['Nom']." ".$donnees['Prenom'].'" />'
				?>
				<h1>
					<?php
						echo $donnees['Prenom']." ".$donnees['Nom'] ;
					?>
				</h1>
        <div>
          <?php
            echo "<p> Membre depuis : ".$donnees['Inscrit_Depuis']."</p>" ;
           ?>
        </div>
		</section>
    <section>
      <form class="mdp-profil" action="" method="post">
        <h2 class="box-title">Modifier mon mot de passe </h1>
        <input type="password" class="mdp-input" name="password" placeholder="Nouveau mot de passe"  required />
        <input type="password" class="mdp-input" name="password2" placeholder="Confirmation du mot de passe"  required />
        <input type="submit" name="submit" value="Modifier" class="box-button" />
      </form>
    </section>
    <section>
      <form class="mdp-profil" action="" method="post">
        <h2 class="box-title">Supprimer mon compte </h1>
        <input type="password" class="mdp-input" name="password_de" placeholder="Mot de passe actuel"  required />
        <input type="password" class="mdp-input" name="password_de2" placeholder="Confirmation du mot de passe actuel"  required />
        <input type="submit" name="submit" value="Supprimer" class="box-button" />
      </form>
    </section>

    <?php
      // Ferme acollade du prmier if
      }
      elseif ($_GET['c'] == 2)
			{
    ?>
      <h2> TEST CONTENU </h2>

    <?php
      // Ferme acollade du deuxieme if
      }
      elseif ($_GET['c'] == 3)
			{
        if (!$_SESSION['pseudo']=='admin@heh.be')
        {
          if (isset($_REQUEST['objet'], $_REQUEST['corps'] ))
          {
            // Fonctions qui nettoye le résultat récupéré
            function valid_donnees ($donnees)
            {
              $donnees = trim($donnees);
              $donnees = stripslashes($donnees);
              $donnees = htmlspecialchars($donnees);
              return $donnees;
            }
            // récupére l'objet, le message et appelle la fct valid_donnees
            $destination = "altino22@gmail.com";
            $obj = valid_donnees ($_REQUEST['objet']) ;
            $msg = valid_donnees($_REQUEST['corps']) ;
            // Envoyer le mail à l'administrateur
            mail($destination, $obj, $msg) ;
            if (mail($destination, $obj, $msg))
            {
              header('Location:profil.php?c=1');
            }
            else
            {
              echo "<div class='sucess'>
                      <h2>Une erreur s'est produite lors de l'envoi du message. Veuillez réessayer.</h2>
                    </div>";
            }
          }
          else
          {
            echo '<form class="mdp-profil" action="" method="post">
              <h2 class="box-title">Envoyer un message à l\'administrateur :</h1>
              <input type="textarea" class="mdp-input" name="objet" placeholder="Objet du message"  required />
              <input type="textarea" class="mdp-input" name="corps" placeholder="Message"  required />
              <input type="submit" name="submit" value="Envoyer" class="box-button" />
            </form>';
          }
        }
        else
        {
          header('Location:profil.php?c=1');
        }

    ?>

    <?php
      // Ferme acollade du troisieme if
      }
      elseif ($_GET['c'] == 4)
			{
        if ($_SESSION['pseudo']=='admin@heh.be')
        {
          // On récupère tout le contenu de la table users
    			$reponse=$bd->prepare('SELECT * FROM users');
    			$reponse->execute();

          echo "<section class='Films_global'>";
          echo "<div id='acteur'>";
          // On affiche toutes les infos sur les utilisateurs
          while ($donnees = $reponse->fetch())
          {
          echo "<div class='photoActeur'>";
          echo '<div><span>'.$donnees['Adresse_mail'].'</span> </div>';
					echo '<div><a href="users_infos.php?mail='.$donnees['Adresse_mail'].' "> <img src='.$donnees['Photo'].' width="120px" height="160px"
					alt=" '.$donnees['Nom']." ".$donnees['Prenom'].' " title="'.$donnees['Nom']." ".$donnees['Prenom'].'" /></a></div></div>';
				  ?>

        <?php
        }
        ?>
          </div>
        </section>

          <?php
        }
        else
        {
          echo "<div class='sucess'>
  								 <h2>Vous n'avez pas l'autorisation d'accéder à cette page !</h2>
  						 </div>";
        }

      }

    // accolade du isset
    }
    ?>

		<?php

			// Ferme acollade du while
			}

      // ----------------------- MODIFICATION DU MOT DE PASSE ------------------------------
      if (isset($_REQUEST['password'], $_REQUEST['password2'] ))
      {
        $checkPassword = false ;
        // Fonctions qui nettoye le résultat récupéré
        function valid_donnees ($donnees)
        {
          $donnees = trim($donnees);
          $donnees = stripslashes($donnees);
          $donnees = htmlspecialchars($donnees);
          return $donnees;
        }

        // récupérer le mot de passe, appelle la fct valid_donnees et le hasher
  		  $mdp = valid_donnees ($_REQUEST['password']) ;
  			$mdp2 = valid_donnees($_REQUEST['password2']) ;

  			if ($mdp == $mdp2)
  			{
  				$checkPassword = true ;
  				$password = password_hash($mdp, PASSWORD_DEFAULT);
  			}

        if ($checkPassword == true and !empty($mdp) and !empty($mdp2) )
  			{
			     $bd->exec( " UPDATE `users` SET `Mot_de_passe` = '$password' WHERE `users`.`Adresse_mail` = '$mail' " ) ;
			     echo "<div class='sucess'>
								   <h3>Mot de passe modifié avec succès.</h3>
						     </div>";
  			}
  			elseif ($checkPassword == false and !empty($mdp) and !empty($mdp2))
  			{
  				echo "<div class='sucess'>
   								<h3>Erreur : Les deux mots de passes ne correspondent pas !</h3>
   						</div>";
  			}
      }

      // SUPPRESION DE COMPTE
      if (isset($_REQUEST['password_de'], $_REQUEST['password_de2'] ))
      {
        $mail = $_SESSION['pseudo'];
        $checkPassword_de = false ;
        // Fonctions qui nettoye le résultat récupéré
        function valid_donnees ($donnees)
        {
          $donnees = trim($donnees);
          $donnees = stripslashes($donnees);
          $donnees = htmlspecialchars($donnees);
          return $donnees;
        }
        // récupérer mot de passe DB
        $reponse=$bd->prepare("SELECT Mot_de_passe FROM users WHERE Adresse_mail = '$email'  ");
  			$reponse->execute();
  			while ($donnees = $reponse->fetch())
  			{
  				$mdp_DB = $donnees['Mot_de_passe'];
  			}
  			$reponse->closeCursor();

        // récupérer le mot de passe entré, appelle la fct valid_donnees et le hasher
  		  $mdp = valid_donnees ($_REQUEST['password_de']) ;
  			$mdp2 = valid_donnees($_REQUEST['password_de2']) ;

  			if ($mdp == $mdp2)
  			{
  				$checkPassword_de = true ;
          // Comparaison du mdp envoyé via le formulaire avec celui stocké en DB
    			if (isset($mdp_DB))
    			{
    				$isPasswordCorrect = password_verify($mdp, $mdp_DB);
    			}
  			}

        if ($checkPassword_de == true and !empty($mdp) and !empty($mdp2) )
  			{
  			     $bd->exec( " DELETE FROM `users` WHERE `users`.`Adresse_mail` = '$mail' " ) ;
             header('Location:login.php?supprimer=1');
  			}
  			elseif ($checkPassword_de == false and !empty($mdp) and !empty($mdp2))
  			{
  				echo "<div class='sucess'>
   								<h3>Erreur : Les deux mots de passes ne correspondent pas !</h3>
   						</div>";
  			}
      }
      ?>
      </div>

      <?php
			$reponse->closeCursor();
			require_once('footer.php');
			echo '<script src="jquery-3.4.1.min.js"> </script>
						<script src="newflix.js"></script>' ;

			} // Si pas de var de session, formulaire de login
			else
			{
				header('Location:login.php');
			}
		?>

	</body>
</html>
