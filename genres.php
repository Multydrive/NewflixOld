<?php
session_start();
if (isset($_SESSION['pseudo']) )
 {


 ?>
<!DOCTYPE html>

<html lang = "fr">
	<head>
            <?php
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

		<section class= "Films_global">

            <?php
                    $req=$bd->prepare ("SELECT * FROM genre ");
                    $req->execute();
                    while ($result=$req->fetch(PDO::FETCH_OBJ) )
                    {

                        echo '<h2 class = "H1_Pages_Principales">'.$result->Genre.'</h2>';
                        echo '<ul class="carousel-items">' ;

                            if ($result->Id_Genre == 1) {
                                $req2=$bd->prepare ("SELECT * FROM films WHERE Id_Genre = 1 ");
                                $req2->execute();
                            }
                            elseif ($result->Id_Genre == 2) {
                               $req2=$bd->prepare ("SELECT * FROM films WHERE Id_Genre = 2 ");
                                $req2->execute();
                            }
                            else {
                                $req2=$bd->prepare ("SELECT * FROM films WHERE Id_Genre = 3 ");
                                $req2->execute();
                            }

                            while ($result2=$req2->fetch(PDO::FETCH_OBJ) )
                            {
                                echo '<li class="carousel-item">';
                                echo '<div class="card">' ;

                                echo '<a href="film.php?id='.$result2->Id_Film .' "><img src='.$result2->Img_Film.'width="300"
                                height="175" alt=" '.$result2->Titre.' " title="'.$result2->Titre.'" /> </a>' ;

                                echo '</div>';
                                echo '</li>' ;

                        }
                            echo '</ul>';

                    }
                    $req->closeCursor();
                    $req2->closeCursor();
                 ?>

		</section>

		<?php
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
