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

		<section class= "Films_global">

			<?php
          $req=$bd->prepare ("SELECT * FROM acteurs ");
          $req->execute();

          echo '<div id="acteur" width:120px >';
          while ($result=$req->fetch(PDO::FETCH_OBJ) )
          {
                      echo
                      '<div class="photoActeur">
                          <div><span>'.$result->Prenom." ".$result->Nom.'</span> </div>
                          <div> <a href="acteurs_infos.php?id='.$result->Id_Acteur .' "><img src="'.$result->Photo.' "width="120px"
                          height="160px" alt=" '.$result->Prenom." ".$result->Nom.' " title="'.$result->Prenom." ".$result->Nom.'" /> </a> </div>
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
