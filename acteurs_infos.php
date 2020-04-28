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
               require_once('connexion.php');
               require_once('menu.php');
            ?>

		<div id = "txtOk"> </div>

		<?php 
			// On récupère tout le contenu de la table films 
			$reponse=$bd->prepare('SELECT * FROM acteurs WHERE Id_Acteur = :id ');
			$reponse->execute(array('id' => $_GET['id']));
			// On affiche toutes les infos sur le film
			while ($donnees = $reponse->fetch())
			{

		?>
		

		
	
		<br>

		<section class="Infos">
				<?php 
					echo '<img src="'.$donnees['Photo'].'"width="120px" height="160px"
					alt=" '.$donnees['Nom']." ".$donnees['Prenom'].' " title="'.$donnees['Nom']." ".$donnees['Prenom'].'" />'
				?>

				<h1>
					<?php 
						echo $donnees['Prenom']." ".$donnees['Nom'] ; 	 
					?>			
				</h1>
			
				<p > A joué dans : 
					<?php

						$req=$bd->prepare("SELECT Titre , Id_Film
						FROM films
						WHERE Id_Film in ( SELECT Num_Film
						                      FROM filmographie
						                      WHERE Num_Acteur IN ( SELECT Id_Acteur
						                                         from acteurs
						                                         WHERE Id_Acteur = :id ) )");
						$req->execute(array('id' => $_GET['id']));						
							while ($result=$req->fetch(PDO::FETCH_OBJ) ) 
							{								
								echo '<a href="film.php?id='.$result->Id_Film .' ">'.$result->Titre.' ,</a>  ' ;																				
							}
																		
						$req->closeCursor();
					?> 
				</p>

				<p>
					<ul id="ListeInfo"> 
						
						<li> Date de naissance : 
							<?php 								
								echo $donnees['Date_Nais']; 							
							?>						 						
					</ul>
				</p>

		</section>

		<?php 
			// Ferme acollade du while principal et le traitement de la requête
			} 
			$req->closeCursor(); 			
		?>

		<footer id = "Footer">
			<nav id="navbot">
			<a href="index.php">Accueil</a>
			<a href="genres.php">Genres</a>
			<a href="acteurs.php"> Acteurs </a>
			<a href="login.php">Se connecter</a>
            <a href="inscription.php">Inscription</a>   
			</nav>		
		</footer>
						
	</body>
	
</html>	