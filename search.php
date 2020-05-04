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
         require_once('menu.php');
       ?>

		   <section class= "Films_global" id="Recherche">

  			<?php
            $titre = $_GET['Titre'];
            if ($titre=="")
            {
                $req=$bd->prepare ("SELECT * FROM `films` ORDER BY `films`.`DateAjout` DESC ");
            }
            else
            {
                $req=$bd->prepare ("SELECT * FROM `films` WHERE `Titre` LIKE '%$titre%' ");
            }
            $req->execute();

            echo '<div id="Recherche" width:320px >';
            while ($result=$req->fetch(PDO::FETCH_OBJ) )
            {
                echo
                '<div class="carousel-item">
                    <div><span>'.$result->Titre.'</span> </div>
                    <div class = "card search"> <a href="film.php?id='.$result->Id_Film.' "><img src='.$result->Img_Film.' width="300px"
                    height="175px" alt=" '.$result->Titre.' " title="'.$result->Titre.'" /> </a> </div>
                 </div>' ;
            }

            echo '</div>';
            $req->closeCursor();

        ?>

		</section>

		<?php
        require_once('footer.php');
    ?>

	</body>
</html>
