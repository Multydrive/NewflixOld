<?php
echo '
<nav id="navtop">
	<a href="index.php"><img class="logo" src = "img/Logo_Newflix.png" alt = "Logo officiel du site"></a>
	<a href="index.php" class="a_menu">Accueil</a>
	<a href="genres.php" class="a_menu">Genres</a>
	<a href="acteurs.php" class="a_menu"> Acteurs </a>
        <form id="FormRecherche" method="get" action="search.php">
            <div id="DivRecherche">
                <input type="search" id="maRecherche" name="Titre"
                 placeholder="Rechercher">
            </div>
						<button type="submit" ></button>
        </form>
	<a href="profil.php?c=1" class="a_menu">Mon compte </a>
	<a href="logout.php" class="a_menu">Déconnexion</a>
</nav>

<div id="txtOk">
</div>

<!-- Back to top -->
<img id="fleche_haut" src="img/arrow_top.png" class="disparition arrow" alt="flèche pour remonter en haut de la page">

 ' ;

?>
