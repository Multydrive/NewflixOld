<?php
session_start();
if (isset($_SESSION['pseudo']) )
 {


 ?>
<!DOCTYPE html>
<html lang = "fr">

	<head>
			<?php
				// Infos communés a toutes les pages pour le head HTML
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
        <input type="password" class="mdp-input" name="password_de2" placeholder="Confirmation du mot de passe"  required />
        <input type="submit" name="submit" value="Supprimer" class="box-button" />
      </form>
    </section>

		<?php
			// Ferme acollade du while
			}
      // MODIFICATION DU MOT DE PASSE
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
