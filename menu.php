<?php
echo '  <nav id="navtop">
			<a href="index.php"><img class="logo" src = "img/Logo_Newflix.png" alt = "Logo officiel du site"></a>
			<a href="index.php">Accueil</a>
			<a href="genres.php">Genres</a>
			<a href="acteurs.php"> Acteurs </a>
            <form id="FormRecherche" method="get" action="search.php">
                <div id="DivRecherche">
                    <input type="search" id="maRecherche" name="Titre"
                     placeholder="Rechercher">
                </div>
								<button type="submit" ></button>
            </form>

			<a href="login.php" >Connexion</a>
            <a href="inscription.php">Inscription</a>
        </nav>

        <div id="txtOk">

        </div>' ;

?>
