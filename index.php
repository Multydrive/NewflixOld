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

        <!-- Slider -->
        <div class="container">

	        <input type="radio" id="i1" name="images" checked/>
	        <input type="radio" id="i2" name="images"/>
	        <input type="radio" id="i3" name="images"/>
	        <input type="radio" id="i4" name="images"/>


	        <div class="slide_img" id="one">
              <a href="film.php?id=10"> <img src="img/Avengers1_Affiche.png"></a>
              <label class="prev" for="i4"><span></span></label>
              <label class="next" for="i2"><span></span></label>
	          </div>

		        <div class="slide_img" id="two">
               <a href="film.php?id=5"> <img src="img/StarWars5_Affiche.jpg" ></a>
	              <label class="prev" for="i1"><span></span></label>
	              <label class="next" for="i3"><span></span></label>
		        </div>

		        <div class="slide_img" id="three">
                <a href="film.php?id=13"><img src="img/Avengers4-Affiche.jpg">  </a>
                <label class="prev" for="i2"><span></span></label>
                <label class="next" for="i4"><span></span></label>
		        </div>

		        <div class="slide_img" id="four">
                <a href="film.php?id=9"> <img src="img/StarWars9-Affiche.png">  </a>
                <label class="prev" for="i3"><span></span></label>
                <label class="next" for="i1"><span></span></label>
		        </div>

		        <div id="nav_slide">
                <label for="i1" class="dots" id="dot1"></label>
                <label for="i2" class="dots" id="dot2"></label>
                <label for="i3" class="dots" id="dot3"></label>
                <label for="i4" class="dots" id="dot4"></label>
		        </div>
					</div>

         <!-- Miniatures -->

		<section class= "Films_global">
        <?php
                    $req=$bd->prepare ("SELECT * FROM serie_de_films ");
                    $req->execute();

                    echo '<h2 class = "H1_Pages_Principales">'."Nouveau dans le catalague".'</h2>';
                    echo '<ul class="carousel-items">' ;

                        $req2=$bd->prepare ("SELECT * FROM films ORDER BY `DateAjout` DESC LIMIT 20; ");
                        $req2->execute();

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

                    while ($result=$req->fetch(PDO::FETCH_OBJ) )
                    {
                        echo '<h2 class = "H1_Pages_Principales">'.$result->Description.'</h2>';
                        echo '<ul class="carousel-items">' ;

                            if ($result->Id_serie == 1) {
                                $req2=$bd->prepare ("SELECT * FROM films WHERE Id_Serie = 1 ");
                                $req2->execute();
                            }
                            elseif ($result->Id_serie == 2) {
                               $req2=$bd->prepare ("SELECT * FROM films WHERE Id_Serie = 2 ");
                                $req2->execute();
                            }
                            elseif ($result->Id_serie == 3) {
                                $req2=$bd->prepare ("SELECT * FROM films WHERE Id_Serie = 3 ");
                                $req2->execute();
                            }
                            else {
                                $req2=$bd->prepare ("SELECT * FROM films WHERE Id_Serie = 4 ");
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
									<script src="newflix.js"></script>

									<script>
									onload  = start;

									function start()
									{
									    var i = 1;
									    function Move()
									    {
									        i = (i%4)+1; // car 4 images dans le slider
									        document.getElementById("i"+i).checked = true;
									    }
									    setInterval(Move,7500); //change img toutes les 7,5 sec
									}
									</script> ' ;


					}
					else
					{
						header('Location:login.php');
					}

        ?>


	</body>
</html>
