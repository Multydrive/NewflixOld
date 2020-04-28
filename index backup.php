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
        
        <!-- Slider -->

        <div class="container">
        
        <input type="radio" id="i1" name="images" checked/>
        <input type="radio" id="i2" name="images" />
        <input type="radio" id="i3" name="images" />
        <input type="radio" id="i4" name="images"  />
        
        
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
			
			<h1 class = "H1_Pages_Principales">Star Wars</h1>
			<ul class="carousel-items">
               
                <li class="carousel-item">
                    <div class="card">
                         <a href="film.php?id=1"><img src="img/episode1-h.jpg" width="300" height="175" alt="Star Wars 1" 
                         	title="Star Wars 1"/></a>
                    </div>
                </li>
                <li class="carousel-item">
                    <div class="card">
                        <a href="film.php?id=2"> <img src="img/episode2-h.jpg" width="300" height="175" alt="Star Wars 2"
                        	title="Star Wars 2"/></a>
                    </div>
                </li>
                <li class="carousel-item">
                    <div class="card">
                        <a href="film.php?id=3"> <img src="img/episode3-h.jpg" width="300" height="175"alt="Star Wars 3" 
                        	title="Star Wars 3"/></a>
                    </div>
                </li>
                <li class="carousel-item">
                    <div class="card">
                        <a href="film.php?id=4"> <img src="img/episode4-h.jpg" width="300" height="175" alt="Star Wars 4" 
                        	title="Star Wars 4"/></a>
                    </div>
                </li>
                <li class="carousel-item">
                    <div class="card">
                        <a href="film.php?id=5"> <img src="img/episode5-h.jpg" width="300" height="175" alt="Star Wars 5" 
                        	title="Star Wars 5"/></a>
                    </div>
                </li>
                <li class="carousel-item">

                        <a href="film.php?id=6"> <img src="img/episode6-h.jpg" width="300" height="175" alt="Star Wars 6" title="Star Wars 6"/></a>
                    </div>
                </li>
                <li class="carousel-item">
                    <div class="card">
                       <a href="film.php?id=7"> <img src="img/episode7-h.jpg" width="300" height="175" alt="Star Wars 7" title="Star Wars 7"/></a>
                    </div>
                </li>
                <li class="carousel-item">
                    <div class="card">
                        <a href="film.php?id=8"> <img src="img/episode8-h.jpg" width="300" height="175" alt="Star Wars 8" title="Star Wars 8"/></a>
                    </div>
                </li>
                <li class="carousel-item">
                    <div class="card">
                        <a href="film.php?id=9"> <img src="img/episode9-h.jpg" width="300" height="175" alt="Star Wars 9" title="Star Wars 9"/></a>
                    </div>
                </li> 
            </ul>
		
			<h2 class = "H1_Pages_Principales">Avengers</h2>
			<ul class="carousel-items">
               
                <li class="carousel-item">
                    <div class="card">
                        <a href="film.php?id=10"><img src="img/avengers1-h.jpg" width="300" height="175" alt="Avengers " title="Avengers "/></a>
                    </div>
                </li>
                <li class="carousel-item">
                    <div class="card">
                         <a href="film.php?id=11"><img src="img/avengers2-h.jpg" width="300" height="175" alt="Avengers 2" title="Avengers 2"/></a>
                    </div>
                </li>
                <li class="carousel-item">
                    <div class="card">
                        <a href="film.php?id=12"><img src="img/avengers3-h.jpg" width="300" height="175" alt="Avengers 3" title="Avengers 3"/></a>
                    </div>
                </li>
                <li class="carousel-item">
                    <div class="card">
                         <a href="film.php?id=13"><img src="img/avengers4-h.jpg" width="300" height="175" alt="Avengers 4" title="Avengers 4"/></a>
                    </div>
                </li>

            </ul>

		
			<h2 class = "H1_Pages_Principales">Retour vers le futur</h2>
			<ul class="carousel-items">
               
                <li class="carousel-item">
                    <div class="card">
                       <a href="film.php?id=14"> <img src="img/retour_futur1-h.png" width="300" height="175" alt="Retour vers le futur 1" title="Retour vers le futur 1"/> </a>
                    </div>
                </li>
                <li class="carousel-item">
                    <div class="card">
                        <a href="film.php?id=15"><img src="img/retour_futur2-h.png" width="300" height="175" alt="Retour vers le futur 2" title="Retour vers le futur 2"/> </a>
                    </div>
                </li>
                <li class="carousel-item">
                    <div class="card">
                       <a href="film.php?id=16"> <img src="img/retour_futur3-h.png" width="300" height="175" alt="Retour vers le futur 3" title="Retour vers le futur 3"/> </a>
                    </div>
                </li>

            </ul>

            <h2 class = "H1_Pages_Principales">Science-fiction</h2>
            <ul class="carousel-items">
               
                <li class="carousel-item">
                    <div class="card">
                        <a href="film.php?id=17"><img src="img/Ready_player.jpg" width="300" height="175" alt="Ready player one" title="Ready player one"/> </a>
                    </div>
                </li>
                <li class="carousel-item">
                    <div class="card">
                       <a href="film.php?id=18"> <img src="img/interstellar-h.jpg" width="300" height="175" alt="Interstellar" title="Interstellar"/> </a>
                    </div>
                </li>
                <li class="carousel-item">
                    <div class="card">
                       <a href="film.php?id=19"> <img src="img/Gardiens_galax.jpg" width="300" height="175" alt="Gardiens de la galaxie" title="Gardiens de la galaxie" /> </a>
                    </div>
                </li>

            </ul>
		</section>

        <?php 
            require_once('footer.php');
        ?>

        <script type="text/javascript">
            onload  = start;

            function start(){   
                var i = 1;
                function Move(){    
                    i = (i%4)+1; // car il y a 4 images dans le slider
                    document.getElementById('i'+i).checked = true;
                }
                setInterval(Move,7500); //change img toutes les 7,5 sec
            }
        </script>
		
	</body>
</html>	