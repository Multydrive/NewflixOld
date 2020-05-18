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
			// On récupère tout le contenu de la table films
			$reponse=$bd->prepare('SELECT * FROM films WHERE Id_Film = :id ');
			$reponse->execute(array('id' => $_GET['id']));
			// On affiche toutes les infos sur le film
			while ($donnees = $reponse->fetch())
			{

		?>

		<div class="video-responsive" >

	 		<iframe width="1000" height="506" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen

				<?php
					echo 'src=" ',$donnees['LienVidéo'],' " ';
				?>  >

			 </iframe>
		</div>

		<br>

		<section class="Infos">
				<h1>
					<?php
						echo $donnees['Titre'];
					?>
				</h1>

				<div>
					<p>
						<?php
							if ($donnees['Résumé']!=NULL)
							{
								echo $donnees['Résumé'];
							}
							else
							{
								echo "Résumé non disponible";
							}
						?>
					</p>
				</div>
				<p > Acteurs principaux :
					<?php

						$req=$bd->prepare("SELECT *
						FROM acteurs
						WHERE id_Acteur in ( SELECT Num_Acteur
						                      FROM filmographie
						                      WHERE Num_Film IN ( SELECT Id_Film
						                                         from films
						                                         WHERE Id_Film = :id ) )");
						$req->execute(array('id' => $_GET['id']));
							while ($result=$req->fetch(PDO::FETCH_OBJ) )
							{
								echo '<a href="acteurs_infos.php?id='.$result->Id_Acteur.' ">'.$result->Prenom." ".$result->Nom.',</a> ' ;
							}

						$req->closeCursor();
					?>
				</p>

				<p>
					<ul id="ListeInfo">
						<li> Réalisé par :
							<?php
								$req=$bd->prepare
								("SELECT Nom, Prenom FROM realisateurs WHERE Id_Real in
								( SELECT Num_Real from films WHERE Id_film = :id )");
								$req->execute(array('id' => $_GET['id']));
								while ($result=$req->fetch(PDO::FETCH_OBJ) )
								{
									echo $result->Prenom." ".$result->Nom;
								}
								$req->closeCursor();
							?>
						<li> Date de sortie :
							<?php
								echo $donnees['Date_Sortie'];
							?>
						<li> Durée :
							<?php
								if ($donnees['Durée']!=NULL)
								{
									echo $donnees['Durée'],' min';
								}
								else
								{
									echo "Non précisé";
								}
							?>
						<li> Genre :
							<?php
								$req=$bd->prepare
								("SELECT Genre FROM genre WHERE Id_Genre in
								( SELECT Id_Genre from films WHERE Id_film = :id )");
								$req->execute(array('id' => $_GET['id']));
								while ($result=$req->fetch(PDO::FETCH_OBJ) )
								{
									echo $result->Genre;
								}
								$req->closeCursor();
						 	?>
					</ul>
				</p>

		</section>

		<?php
			// Ferme acollade du while principal et le traitement de la requête
			}
			$req->closeCursor();
			require_once('footer.php');
			echo '<script src="jquery-3.4.1.min.js"> </script>
						<script src="newflix.js"></script>' ;

			}
			else
			{
				header('Location:login.php');
			}


		?>



	</body>

</html>
