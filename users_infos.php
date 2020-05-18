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
			// On récupère tout le contenu de la table films
			$reponse=$bd->prepare('SELECT * FROM users WHERE Adresse_mail = :mail ');
			$reponse->execute(array('mail' => $_GET['mail']));
			// On affiche toutes les infos sur le film
			while ($donnees = $reponse->fetch())
			{

		?>

		<br>

		<section class="Infos">
				<?php
					echo '<img src='.$donnees['Photo'].' width="120px" height="160px"
					alt=" '.$donnees['Nom']." ".$donnees['Prenom'].' " title="'.$donnees['Nom']." ".$donnees['Prenom'].'" />'
				?>

				<h1>
					<?php
						echo $donnees['Prenom']." ".$donnees['Nom'] ;
					?>
				</h1>

				<p> Inscrit depuis :
						<?php
							echo $donnees['Inscrit_Depuis'];
						?>
				</p>


		</section>

		<?php
			// Ferme acollade du while principal
			}

			require_once('footer.php');
			echo '<script src="jquery-3.4.1.min.js"> </script>
						<script src="newflix.js"></script>' ;
			}
			else
			{
				header('Location:index.php');
			}

		?>

	</body>
</html>
