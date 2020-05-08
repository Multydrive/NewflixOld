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
