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

      // Déclaration les variables en tant que vides
      $TitreErr = $ResumeErr = $Date_sortieErr = $DureeErr = $VideoErr = $RealisateurErr = $Serie_FilmsErr = $GenreErr = $ActeurErr =  $ActeursErr2 = "";
      $Titre = $Resume = $Date_sortie = $Duree = $Video = $Realisateur = $Serie_Films = $Genre = $Acteur = $Acteurs2 =   "";

      // Fonction de filtrage des valeurs
      function valid_donnees($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["Titre"])) {
          $TitreErr = "Titre obligatoire";
        }
        else {
          $Titre = valid_donnees($_POST["Titre"]);
          // check si les caractères entrés sont bien des lettres, des chiffres ou des espaces
          if (!preg_match("/^[ A-Za-z0-9\\n\\r\-'éèêïîàçô.,;:\?!]*$/",$Titre)) {
            $TitreErr = "Seul les lettres, les chiffres, les espaces, les caractères de ponctuation et quelques caractères spéciaux sont autorisés ( - ' é è ê ï î à ç ô ) sont autorisés";
          }
        }

        if (empty($_POST["Resume"])) {
          $ResumeErr = "Résumé du film obligatoire";
        }
        else {
          $Resume = valid_donnees($_POST["Resume"]);
          // check si les caractères entrés sont bien des lettres, des chiffres ou des espaces
          if (!preg_match("/^[ A-Za-z0-9\\n\\r\-'éèêïîàçô.,;:\?!]*$/",$Resume)) {
            $ResumeErr = "Seul les lettres, les chiffres, les espaces, les caractères de ponctuation et quelques caractères spéciaux sont autorisés ( - ' é è ê ï î à ç ô ) sont autorisés";
          }
          else if (strlen($Resume)>1000) {
            $ResumeErr = "Le résumé entré dépasse les 1000 caractères";
          }
        }

        if (empty($_POST["Date_sortie"])) {
          $Date_sortieErr = "Date de sortie obligatoire";
        }
        else {
          $Date_sortie = valid_donnees($_POST["Date_sortie"]);
          // check si les caractères entrés sont bien des chiffres ou des tirets
          if (preg_match("/^([0-2][0-9]|(3)[0-1])(-)(((0)[0-9])|((1)[0-2]))(-)\d{4}$/",$Resume)) {
            $Date_sortieErr = "Seul les chiffres et les tirets sont autorisés";
          }
          else if (strlen($Date_sortie)>10) {
            $ResumeErr = "Le nombre de caractères dépasse les 10 caractères";
          }
        }

        // check si les caractères entrés sont bien des chiffres
        if (!preg_match("/^[0-9]*$/",$Duree)) {
          $DureeErr = "Seul les chiffres sont autorisés";
        }
        else {
          $Duree = valid_donnees($_POST["Duree"]);
        }


        if ($_POST["Realisateur"] == "REALISATEUR") {
          $RealisateurErr = "Veuillez sélectionner un réalisateur";
        }
        else {
          $Realisateur = valid_donnees($_POST["Realisateur"]);
        }

        if ($_POST["Serie_Films"] == "UNIVERS CINEMATOGRAPHIQUE") {
          $Serie_FilmsErr = "Veuillez sélectionner un univers cinematographique";
        }
        else {
          $Serie_Films = valid_donnees($_POST["Serie_Films"]);
        }

        if ($_POST["Genre"] == "GENRE") {
          $GenreErr = "Veuillez sélectionner un genre de films";
        }
        else {
          $Genre = valid_donnees($_POST["Genre"]);
        }

        if ($_POST["Acteur"]  == "ACTEUR PRINCIPAL"  ) {
          $ActeurErr = "Veuillez sélectionner un acteur principal";
        }
        else if ($_POST["Acteur"] == $_POST["Acteurs2"]){
          $ActeurErr = "Veuillez choisir un acteur différent que l'acteur secondaire";
        }
        else {
          $Acteur = valid_donnees($_POST["Acteur"]);
        }

        if ($_POST["Acteurs2"]  == "ACTEUR SECONDAIRE"  ) {
          $ActeursErr2 = "Veuillez sélectionner un acteur secondaire";
        }
        else if ($_POST["Acteur"] == $_POST["Acteurs2"]){
          $ActeursErr2 = "Veuillez choisir un acteur différent que l'acteur principal";
        }
        else {
          $Acteurs2 = valid_donnees($_POST["Acteurs2"]);
        }

        if (empty($_POST["Video"])) {
          $VideoErr = "Lien de la vidéo obligatoire";
        }
        else {
          $Video = valid_donnees($_POST["Video"]);
          if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$Video)) {
            $VideoErr = "L'URL de la bande annonce n'est pas valide ( elle s'obtient sur Youtube en faisant un clic droit => copier le code
            d'intégration => copier ici le lien de type https://www.youtube.com/embed/XXXXXXXXXXX )";
          }
        }

      // If principal
      }

      ?>

      <h2 class="box-title">Ajouter un film</h2>
      <p><span class="error">* champs obligatoire</span></p>
      <form method="post" class="box_sans_border" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input type="text" name="Titre" class="box-input" placeholder="Titre" value="<?php echo $Titre;?>">
        <span class="error">* <?php echo $TitreErr;?></span>
        <br><br>
        <textarea name="Resume" rows="5" class="box-input" placeholder="Résumé" cols="40"><?php echo $Resume;?></textarea>
        <span class="error">* <?php echo $ResumeErr;?></span>
        <br><br>
        <input type="text" name="Date_sortie" class="box-input" placeholder="Date de sortie" value="<?php echo $Date_sortie;?>">
        <span class="error">* <?php echo $Date_sortieErr;?></span>
        <br><br>
        <input type="text" name="Duree" class="box-input" placeholder="Durée" value="<?php echo $Duree;?>">
        <span class="error">* <?php echo $DureeErr;?></span>
        <br><br>
        <SELECT name="Realisateur" size="1" class="box-input">
          <option selected>REALISATEUR</option>
          <?php
          $req=$bd->prepare ("SELECT * FROM realisateurs ORDER BY `realisateurs`.`Prenom` ASC");
          $req->execute();

          while ($result=$req->fetch(PDO::FETCH_OBJ) )
          {
            if (isset($Realisateur))
            {
              $tmp = $result->Prenom." ".$result->Nom;
              if ($tmp  == $Realisateur)
              {
                echo "<option selected>$result->Prenom $result->Nom</option>" ;
              }
              else {
                echo "<option>$result->Prenom $result->Nom</option>" ;
              }
            }
            else {
              echo "<option>$result->Prenom $result->Nom</option>" ;
            }
          }

          ?>
        </SELECT>
        <span class="error">* <?php echo $RealisateurErr;?></span>
        <br><br>
        <SELECT name="Serie_Films" size="1" class="box-input" value="<?php echo $Serie_Films;?>" >
          <option >UNIVERS CINEMATOGRAPHIQUE</option>
          <?php
          $req=$bd->prepare ("SELECT * FROM serie_de_films");
          $req->execute();

          while ($result=$req->fetch(PDO::FETCH_OBJ) )
          {
            if (isset($Serie_Films))
            {
              $tmp = $result->Description;
              if ($tmp  == $Serie_Films)
              {
                echo "<option selected>$result->Description</option>" ;
              }
              else {
                echo "<option>$result->Description</option>" ;
              }
            }
            else {
              echo "<option>$result->Description</option>" ;
            }
          }
          ?>
        </SELECT>
        <span class="error">* <?php echo $Serie_FilmsErr;?></span>
        <br><br>
        <SELECT name="Genre" size="1" class="box-input" value="<?php echo $Genre;?>" >
          <option >GENRE</option>
          <?php
          $req=$bd->prepare ("SELECT * FROM genre ORDER BY `genre`.`Genre` ASC");
          $req->execute();

          while ($result=$req->fetch(PDO::FETCH_OBJ) )
          {
            if (isset($Genre))
            {
              $tmp = $result->Genre;
              if ($tmp  == $Genre)
              {
                echo "<option selected>$result->Genre</option>" ;
              }
              else {
                echo "<option>$result->Genre</option>" ;
              }
            }
            else {
              echo "<option>$result->Genre</option>" ;
            }
          }
          ?>
        </SELECT>
        <span class="error">* <?php echo $GenreErr;?></span>
        <br><br>
        <SELECT name="Acteur" size="1" class="box-input" value="<?php echo $Acteur;?>" >
          <option >ACTEUR PRINCIPAL</option>
          <?php
          $req=$bd->prepare ("SELECT * FROM acteurs ORDER BY `acteurs`.`Prenom` ASC");
          $req->execute();

          while ($result=$req->fetch(PDO::FETCH_OBJ) )
          {
            if (isset($Acteur))
            {
              $tmp = $result->Prenom." ".$result->Nom;
              if ($tmp  == $Acteur)
              {
                echo "<option selected>$result->Prenom $result->Nom</option>" ;
              }
              else {
                echo "<option>$result->Prenom $result->Nom</option>" ;
              }
            }
            else {
              echo "<option>$result->Prenom $result->Nom</option>" ;
            }
          }
          ?>
        </SELECT>
        <span class="error">* <?php echo $ActeurErr;?></span>
        <br><br>
        <SELECT name="Acteurs2" size="1" class="box-input" value="<?php echo $Acteurs2;?>" >
          <option >ACTEUR SECONDAIRE</option>
          <?php
          $req=$bd->prepare ("SELECT * FROM acteurs ORDER BY `acteurs`.`Prenom` ASC");
          $req->execute();

          while ($result=$req->fetch(PDO::FETCH_OBJ) )
          {
            if (isset($Acteurs2))
            {
              $tmp = $result->Prenom." ".$result->Nom;
              if ($tmp  == $Acteurs2)
              {
                echo "<option selected>$result->Prenom $result->Nom</option>" ;
              }
              else {
                echo "<option>$result->Prenom $result->Nom</option>" ;
              }
            }
            else {
              echo "<option>$result->Prenom $result->Nom</option>" ;
            }
          }
          ?>
        </SELECT>
        <span class="error">* <?php echo $ActeursErr2;?></span>
        <br><br>
        <input type="text" name="Video" class="box-input" placeholder="Lien de la bande annonce" value="<?php echo $Video;?>">
        <span class="error">* <?php echo $VideoErr;?></span>
        <br><br>


        <input type="submit" name="Ajouter" value="Ajouter" class="box-button">
      </form>


		<?php
        require_once('footer.php');
			}
			else
			{
				header('Location:login.php');
			}
    ?>

	</body>
</html>
