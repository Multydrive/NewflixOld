onload  = start;

function start()
{
    var i = 1;
    function Move()
    {
        i = (i%4)+1; // car 4 images dans le slider
        document.getElementById('i'+i).checked = true;
    }
    setInterval(Move,7500); //change img toutes les 7,5 sec
}

// flèche
$(window).scroll(function() {
    if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
        $("#fleche_haut").fadeIn(200);    // Fade in the arrow
    } else {
        $("#fleche_haut").fadeOut(200);   // Else fade out the arrow
    }
});
$(document).ready(function()
{
  $("#fleche_haut").click(function(event)
  {
      event.preventDefault();
      $("html, body").animate({ scrollTop: 0 }, "slow");
      return false;
  });

});
