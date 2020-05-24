<?php
session_start();
if (isset($_SESSION['pseudo']) && $_SESSION['pseudo']=='admin@heh.be' )
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
			// On récupère tout le contenu de la table users
			$reponse=$bd->prepare('SELECT * FROM users WHERE Adresse_mail = :mail ');
			$reponse->execute(array('mail' => $_GET['mail']));
			// On affiche toutes les infos sur l'utilisateur choisit
			while ($donnees = $reponse->fetch())
			{

		?>
    <div id="main">
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
        <h3 class="box-title">Modifier le mot de passe de l'utilisateur </h3>
        <input type="password" class="mdp-input" name="password" placeholder="Nouveau mot de passe"  required />
        <input type="password" class="mdp-input" name="password2" placeholder="Confirmation du mot de passe"  required />
        <input type="submit" name="submit" value="Modifier" class="box-button" />
      </form>
    </section>
    <section>
      <form class="mdp-profil" action="" method="post">
        <h3 class="box-title">Supprimer l'utilisateur </h3>
        <input type="password" class="mdp-input" name="password_de" placeholder="Mot de passe actuel"  required />
        <input type="password" class="mdp-input" name="password_de2" placeholder="Confirmation du mot de passe actuel"  required />
        <input type="submit" name="submit" value="Supprimer" class="box-button" />
      </form>
    </section>

		<?php
			// Ferme acollade du while principal
			}
      // ----------------------- MODIFICATION DU MOT DE PASSE ------------------------------
      if (isset($_POST['password'], $_POST['password2'] ))
      {
        $mail = $_GET['mail'];
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
  		  $mdp = valid_donnees ($_POST['password']) ;
  			$mdp2 = valid_donnees($_POST['password2']) ;

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

      // ----------------------- SUPPRESION DE COMPTE ------------------------------
      if (isset($_POST['password_de'], $_POST['password_de2'] ))
      {
        $mail = $_GET['mail'];
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
        $reponse=$bd->prepare("SELECT Mot_de_passe FROM users WHERE Adresse_mail = 'admin@heh.be'  ");
  			$reponse->execute();
  			while ($donnees = $reponse->fetch())
  			{
  				$mdp_DB = $donnees['Mot_de_passe'];
  			}
  			$reponse->closeCursor();

        // récupérer le mot de passe entré, appelle la fct valid_donnees
  		  $mdp = valid_donnees ($_POST['password_de']) ;
  			$mdp2 = valid_donnees($_POST['password_de2']) ;

        $isPasswordCorrect = false ;
  			if ($mdp == $mdp2)
  			{
          $checkPassword_de = true ;
          // Comparaison du mdp envoyé via le formulaire avec celui stocké en DB
    			if (isset($mdp_DB))
    			{
    				$isPasswordCorrect = password_verify($mdp, $mdp_DB);

            if ($isPasswordCorrect == true and !empty($mdp) and !empty($mdp2) )
      			{
      			     $bd->exec( " DELETE FROM `users` WHERE `users`.`Adresse_mail` = '$mail' " ) ;
                 header('Location:login.php?supprimer=1');
      			}
      			elseif ($isPasswordCorrect == false and !empty($mdp) and !empty($mdp2))
      			{
      				echo "<div class='sucess'>
       								<h3>Erreur : Mot de passe incorrect !</h3>
       						</div>";
      			}
    			}
  			}
        else
        {
          echo "<div class='sucess'>
                  <h3>ERREUR : Les deux mots de passes ne correspondent pas !</h3>
              </div>";
        }


      }
      ?>
      <!-- Fermeture de main -->
      </div>

      <?php

			require_once('footer.php');
			echo '<script src="jquery-3.4.1.min.js"> </script>
						<script src="newflix.js"></script>' ;
			}
			else
			{
				header('Location:index.php');
			}

		?>
    <!-- Fermeture de main -->
    </div>

	</body>
</html>
