!DOCTYPE html>
<html lang = "fr">
	<head>
		<?php
       require_once('head.php');
    ?>
	</head>

	<body>

   	<?php
       require_once('connexion.php');
       session_start();
    ?>

    <nav id="navtop">
			<a href="index.php"><img class="logo" src = "img/Logo_Newflix.png" alt = "Logo officiel du site"></a>
			<a href="login.php" class="login" >Connexion</a>
      <a href="inscription.php">Inscription</a>
		</nav>

		<div id="txtOk" height="120px"></div>

		<?php
    // Suppression des variables de session et de la session
    session_destroy();

    echo "<div class='sucess'>
            <h3>Déconnexion réussie !</h3>
            <p><a href='login.php'>Cliquez ici pour vous reconnecter</a></p>
          </div>";
    ?>

  </body>
</html>
