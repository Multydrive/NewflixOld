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

                            $req2=$bd->prepare ("SELECT * 
                                                FROM acteurs" );
                            $req2->execute();
                            
                                echo 
                                '<div class="photoActeur">
                                    <div><span>'.$result->Nom." ".$result->Prenom.'</span> </div>
                                    <div> <a href="acteurs_infos.php?id='.$result->Id_Acteur .' "><img src="'.$result->Photo.'"width="120px" 
                                    height="160px" alt=" '.$result->Nom." ".$result->Prenom.' " title="'.$result->Nom." ".$result->Prenom.'" /> </a> </div>
                                 </div>' ;

                    }

                    echo '</div>';
                    $req->closeCursor();   
                    $req2->closeCursor();                           
                 ?>

		</section>

		<?php 
            require_once('footer.php');
        ?>
        
	</body>
</html>	