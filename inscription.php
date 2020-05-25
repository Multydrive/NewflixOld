<!DOCTYPE html>
<html lang = "fr">
	<head>
		<?php
       require_once('head.php');
    ?>
	</head>

	<body>

   	<?php
       require_once('connexion_user_lambda.php');
    ?>

    <nav id="navtop">
			<a href="index.php"><img class="logo" src = "img/Logo_Newflix.png" alt = "Logo officiel du site"></a>
			<a href="login.php" class="login a_menu" >Connexion</a>
      <a href="inscription.php" class="a_menu">Inscription</a>
		</nav>

		<div id="txtOk" height="120px"></div>

		<?php

		$checkPassword = false ;
		$checkMail = false ;

		if (isset($_REQUEST['name'],$_REQUEST['prenom'], $_REQUEST['email'], $_REQUEST['password'], $_REQUEST['password2'] ))
		{

			// Fonctions qui nettoye le résultat récupéré
			function valid_donnees ($donnees)
			{
				$donnees = trim($donnees);
        $donnees = stripslashes($donnees);
        $donnees = htmlspecialchars($donnees);
        return $donnees;
			}

			/* Re remplir le formulaire si mal remplit
			function remplissage ($name, $prenom,$email, $mdp, $mdp2)
			{
				if (!empty($name))
				{

				}
			}
			*/

		  // récupérer le nom de l'utilisateur et appelle la fct valid_donnees
		  $name = valid_donnees ($_REQUEST['name']) ;

		  // récupérer le prénom utilisateur et appelle la fct valid_donnees
		  $prenom = valid_donnees ($_REQUEST['prenom']) ;

		  // récupérer l'email, check si existe dans la db et appelle la fct valid_donneese
		  $email = valid_donnees ($_REQUEST['email']);

			$req=$bd->prepare("SELECT Adresse_mail FROM users WHERE Adresse_mail = '$email' ");
			$req->execute();
			while ($result=$req->fetch(PDO::FETCH_OBJ) )
			{
				$mail_dans_db = $result;
			}
			$req->closeCursor();

			if (empty ($mail_dans_db) )
			{
				$checkMail = true ;
			}

		  // récupérer le mot de passe, le hasher et appelle la fct valid_donnees
		  $mdp = valid_donnees ($_REQUEST['password']) ;
			$mdp2 = valid_donnees($_REQUEST['password2']) ;

			if ($mdp == $mdp2)
			{
				$checkPassword = true ;
				$password = password_hash($mdp, PASSWORD_DEFAULT);
			}


			//Stockage en DB si le mail n'existe pas et si les deux mots de passe sont les memes
			if ($checkMail == true and $checkPassword == true and !empty($email) and !empty($mdp) and !empty($mdp2) )
			{
				$bd->exec( "INSERT into `users` (Adresse_mail, Nom, Prenom, Mot_de_passe)
						 VALUES ('$email','$name','$prenom' , '$password')" ) ;

			 echo "<div class='sucess'>
								<h3>Vous êtes inscrit avec succès.</h3>
								<p><a href='login.php'>Cliquez ici pour vous connecter</a></p>
						</div>";
			}
			elseif ($checkMail == true and $checkPassword == false and !empty($email) and !empty($mdp) and !empty($mdp2))
			{
				echo "<div class='sucess'>
 								<h3>ERREUR : Les deux mots de passes ne correspondent pas !</h3>
 								<p><a href='inscription.php'>Cliquez ici pour recommencer</a></p>
 						</div>";
			}
			elseif ($checkMail == false and $checkPassword == true and !empty($email) and !empty($mdp) and !empty($mdp2))
			{
				echo "<div class='sucess'>
 								<h3>ERREUR : Un compte est déjà lié à cet e-mail !</h3>
 								<p><a href='inscription.php'>Cliquez ici pour recommencer</a></p>
 						</div>";
			}
			elseif ($checkMail == false and $checkPassword == false and !empty($email) and !empty($mdp) and !empty($mdp2))
			{
				echo "<div class='sucess'>
 								<h3>ERREUR : Les deux mots de passes ne correspondent pas et un compte est déjà lié à cet e-mail !</h3>
 								<p><a href='inscription.php'>Cliquez ici pour recommencer</a></p>
 						</div>";
			}

		}

		else
		{
		?>

				<form class="box" action="" method="post">

				    <h1 class="box-title">S'inscrire</h1>
				  <input type="text" class="box-input" name="name"
				  placeholder="Nom " value="<?php  if (isset($name)) {echo $name ;} ?>" required />

				  <input type="text" class="box-input" name="prenom"
				  placeholder="Prénom" value="<?php if (isset($prenom)) {echo $prenom ;} ?>" required />

				    <input type="text" class="box-input" name="email"
				  placeholder="Email" value="<?php if (isset($email)) {echo $email ;} ?>"required />

				    <input type="password" class="box-input" name="password"
				  placeholder="Mot de passe"  required />

				  <input type="password" class="box-input" name="password2"
				  placeholder="Confirmation du mot de passe" value="<?php if (isset($mdp2)) {echo $mdp2 ;} ?>" required />

				    <input type="submit" name="submit" value="S'inscrire" class="box-button" />

				    <p class="box-register">Déjà inscrit?
				  <a href="login.php">Connectez-vous.</a></p>
				</form>

		<?php
			}
			require_once('footer.php');

		?>

	</body>
</html>
