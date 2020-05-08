<!DOCTYPE html>
<html lang = "fr">
	<head>
		<?php
       require_once('head.php');
    ?>
	</head>

	<body>

   	<?php
       require_once('connexion.php');
    ?>

    <nav id="navtop">
			<a href="index.php"><img class="logo" src = "img/Logo_Newflix.png" alt = "Logo officiel du site"></a>
			<a href="login.php" class="login" >Connexion</a>
      <a href="inscription.php">Inscription</a>
		</nav>

		<div id="txtOk" height="120px"></div>

		<?php

		$checkMail = false ;

		if (isset($_REQUEST['email'], $_REQUEST['password']))
		{
			// Fonctions qui nettoye le résultat récupéré
			function valid_donnees ($donnees)
			{
				$donnees = trim($donnees);
        $donnees = stripslashes($donnees);
        $donnees = htmlspecialchars($donnees);
        return $donnees;
			}


			// récupérer l'email et appeller la fct valid_donneese
 		  $email = valid_donnees ($_REQUEST['email']);
			// On récupère le mail et le mdp dans la DB
			$reponse=$bd->prepare("SELECT * FROM users WHERE Adresse_mail = '$email'  ");
			$reponse->execute();
			while ($donnees = $reponse->fetch())
			{
				$mail_DB = $donnees['Adresse_mail'];
				$mdp_DB = $donnees['Mot_de_passe'];
			}
			$reponse->closeCursor();

			// Si le résultat n'est pas vide, cet email existe
			if (!empty ($mail_DB) )
			{
				$checkMail = true ;
			}

			// récupérer le mot de passe et appeller la fct valid_donnees
		  $mdp = valid_donnees ($_REQUEST['password']) ;
			// Comparaison du mdp envoyé via le formulaire avec celui stocké en DB
			if (isset($mdp_DB))
			{
				$isPasswordCorrect = password_verify($mdp, $mdp_DB);
			}



			//Connexion si le mail est présent en DB , si le hash du mdp de passe est le meme et si lex deux champs ne sont pas vides
			if ($checkMail == true and $isPasswordCorrect == true and !empty($email) and !empty($mdp)  )
			{
				echo "<div class='sucess'>
 								<h3>Vous êtes connecté avec succès !</h3>
 						</div>";

				session_start();
				$_SESSION['pseudo'] = $email ;
				header('Location:index.php');
			}
			elseif ($checkMail == true and $isPasswordCorrect == false  and !empty($email) and !empty($mdp) )
			{
				echo "<div class='sucess'>
 								<h3>ATTENTION : Mot de passe incorrect !</h3>
 								<p><a href='login.php'>Cliquez ici pour recommencer</a></p>
 						</div>";
			}
			elseif ($checkMail == false and $isPasswordCorrect== true and !empty($email) and !empty($mdp) )
			{
				echo "<div class='sucess'>
 								<h3>ATTENTION : L'adressse e-mail entrée est incorrecte !</h3>
 								<p><a href='login.php'>Cliquez ici pour recommencer</a></p>
 						</div>";
			}
			elseif ($checkMail == false  and $isPasswordCorrect == false and !empty($email) and !empty($mdp) )
			{
				echo "<div class='sucess'>
 								<h3>ATTENTION : L'adressse e-mail et le mot de passe entrés sont incorrects  !</h3>
 								<p><a href='login.php'>Cliquez ici pour recommencer</a></p>
 						</div>";
			}

		}

		else
		{
		?>



				<form class="box" action="" method="post">
			    <h1 class="box-title">Se connecter</h1>

			    <input type="text" class="box-input" name="email"
			  placeholder="Email" value="<?php if (isset($email)) {echo $email ;} ?>"required />

			    <input type="password" class="box-input" name="password"
			  placeholder="Mot de passe" value="<?php if (isset($mdp)) {echo $mdp ;} ?>" required />

			    <input type="submit" name="submit"
			  value="Se connecter" class="box-button" />

			    <p class="box-register">Première visite sur Newflix ?
				  <a href="inscription.php">Inscrivez-vous.</a></p>
				</form>

	<?php
		}
		require_once('footer.php');
	?>

	</body>
</html>
