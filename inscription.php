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

			$req=$bd->prepare('SELECT * FROM users');
			$req->execute();
			while ($result=$req->fetch(PDO::FETCH_OBJ) ) 
			{
				$users_t[] = $result;
			}
			$req->closeCursor();



		if (isset($_REQUEST['name'], $_REQUEST['email'], $_REQUEST['password'], $_REQUEST['prenom'])){
		  
		  // récupérer le nom de l'utilisateur 
		  $name    = $_REQUEST['name'];

		  // récupérer le prénom utilisateur 
		  $prenom   = $_REQUEST['prenom'];
		  
		  // récupérer l'email
		  	$email = $_REQUEST['email']; 
		  

		  // récupérer le mot de passe et le hasher
		  $mdp = $_REQUEST['password'] ;
		  $password = password_hash($mdp, PASSWORD_DEFAULT);
		  

		  if (in_array ($email,$users_t)) {
		  	$email = $_REQUEST['email']; 
		  }
		  else {
		  	echo "Un compte a déjà été crée avec cette adresse mail";
		  }


		  $bd->exec( "INSERT into `users` (Adresse_mail, Nom, Prenom, Mot_de_passe)
		        VALUES ('$name', '$email','$prenom' , '$password')" ) ;
		 
		    if($bd){
		       echo "<div class='sucess'>
		             <h3>Vous êtes inscrit avec succès.</h3>
		             <p>Cliquez ici pour vous <a href='login.php'>connecter</a></p>
		       </div>";
		    }
		}else{
		?>


				<form class="box" action="" method="post">
				  
				    <h1 class="box-title">S'inscrire</h1>
				  <input type="text" class="box-input" name="name" 
				  placeholder="Nom " required />

				  <input type="text" class="box-input" name="prenom" 
				  placeholder="Prénom" required />
				  
				    <input type="text" class="box-input" name="email" 
				  placeholder="Email" required />
				  
				    <input type="password" class="box-input" name="password" 
				  placeholder="Mot de passe" required />

				  <input type="password" class="box-input" name="password1" 
				  placeholder="Confirmation du mot de passe" required />
				  
				    <input type="submit" name="submit" 
				  value="S'inscrire" class="box-button" />
				  
				    <p class="box-register">Déjà inscrit? 
				  <a href="login.php">Connectez-vous ici</a></p>
				</form>

			
		<?php } ?>

		
	</body>
</html>	